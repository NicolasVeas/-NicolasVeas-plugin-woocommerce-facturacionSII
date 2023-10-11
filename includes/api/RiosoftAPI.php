<?php

class RiosoftAPI {

    private $base_url = "https://apibeta.riosoft.cl";
    private $product = "ERP";
    private $token = ""; // Aquí almacenaremos el token cuando lo obtengamos

    public function __construct($token = "") {
        $this->token = $token;
    }

    public function setAccessToken($token) {
        $this->token = $token;
    }

    private function callAPI($method, $endpoint, $data = [], $headers = []) {
        $url = $this->base_url . $endpoint;
        
        $defaultHeaders = [
            'product' => $this->product,
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
        
        $args = [
            'method' => $method,
            'headers' => array_merge($defaultHeaders, $headers),
            'body' => !empty($data) ? json_encode($data) : '',
            'timeout' => 45
        ];
    
        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            throw new Exception('Error en la llamada a la API: ' . $response->get_error_message());
        }

        $body = wp_remote_retrieve_body($response);
        $decodedResponse = json_decode($body, true);

        // Puedes agregar una verificación aquí si la API devuelve algún tipo de estructura de error
        if (isset($decodedResponse['error'])) {
            throw new Exception($decodedResponse['error']['message']);
        }
        
        return $decodedResponse;
    }
    
    //Crendeciales - Login
    public function loginServiceClient($email, $password) {
        $endpoint = '/enterprise/v1/authorization/login/service_clients';
        $headers = [
            'email' => $email,
            'password' => $password
        ];
        
        return $this->callAPI('GET', $endpoint, [], $headers);
    }


    // 1) Crea DTE
    public function createDTE($dteData) {
        return $this->callAPI('/dtemanager/v1/manager/sync/dte/sign/simple/electronic-bill', 'POST', $dteData);
    }

    // 2) Envía DTE grupales para ser firmados
    public function sendGroupDTE($headerData, $dteGroupData) {
        $headers = [
            'rut_emisor' => $headerData['rut_emisor'],
            'rut_receptor' => $headerData['rut_receptor'],
            'resolucion_date' => $headerData['resolucion_date'],
            'resolution_number' => $headerData['resolution_number']
        ];
        return $this->callAPI('/dtemanager/v1/manager/sync/dte/sign/sending/group', 'POST', $dteGroupData, $headers);
    }

    // 3)  Consulta el estado de envío
    public function checkSendingStatus($page = 1) {
        return $this->callAPI('/dtemanager/v1/manager/sendings/status/summarized?page=' . $page, 'GET');
    }

    // 4) Envía los datos al SII
    public function sendToSII($folio, $token) {
        $headers = ['token' => $token];
        return $this->callAPI('/dtemanager/v1/manager/sync/dte/sendings/sii/upload/' . $folio, 'PUT', [], $headers);
    }

    // 5) Consulta el estado del envío en el SII
    public function checkSIIStatus($trackId) {
        return $this->callAPI('/dtemanager/v1/manager/sendings/status/sii/' . $trackId, 'GET');
    }

}

?>
