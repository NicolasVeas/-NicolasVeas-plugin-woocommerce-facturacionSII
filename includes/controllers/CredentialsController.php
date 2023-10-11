<?php

require_once SII_PLUGIN_DIR . 'includes/models/CredentialsModel.php';
require_once SII_PLUGIN_DIR . 'includes/views/CredentialsView.php';
require_once SII_PLUGIN_DIR . 'includes/api/RiosoftAPI.php';

class CredentialsController {
    protected $wpdb;
    protected $model;
    protected $view;
    protected $api;

    public function __construct($wpdb) {
        $this->wpdb = $wpdb;
        $this->model = new CredentialsModel($this->wpdb);
        $this->view = new CredentialsView();
        $this->api = new RiosoftAPI();
    }

    public function handleRequest() {
        // Si el formulario es enviado, procesa la petición
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handleLogin($_POST['email'], $_POST['password']);
        }
        
        // Muestra el formulario
        $this->view->renderForm();
    }

    protected function handleLogin($email, $password) {
        $response = $this->api->loginServiceClient($email, $password);

        if (isset($response['access_token'])) {
            // Guarda el token en la base de datos
            $this->storeToken($email, $response);
            echo "Token almacenado correctamente.";
        } else {
            // Manejar error
            echo isset($response['error']) ? $response['error'] : "No se pudo obtener el token.";
        }
    }
    

    protected function storeToken($email, $data) {
        $credentials = array(
            'email' => $email,
            'access_token' => $data['access_token'],
            'token_type' => $data['token_type'],
            'expires_in' => $data['expires_in'],
            'refresh_token' => $data['refresh_token'],
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql')
        );

        $this->model->saveCredentials($credentials);
    }
    

}


