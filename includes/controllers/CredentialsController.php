<?php

require_once SII_PLUGIN_DIR . 'includes/models/CredentialsModel.php';
require_once SII_PLUGIN_DIR . 'includes/views/CredentialsView.php';

class CredentialsController {
    protected $wpdb;
    protected $view;

    public function __construct($wpdb) {
        $this->wpdb = $wpdb;
        $this->view = new CredentialsView();
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
        $apiUrl = "https://apibeta.riosoft.cl/enterprise/v1/authorization/login/service_clients";
        
        // Solicita el token usando las credenciales proporcionadas
        $response = wp_remote_get($apiUrl, array(
            'headers' => array(
                'email' => $email,
                'password' => $password
            )
        ));

        if (is_wp_error($response)) {
            // Manejar error
            echo "Error: " . $response->get_error_message();
            return;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (isset($data['access_token'])) {
            // Guarda el token en la base de datos
            $this->storeToken($email, $data);
            echo "Token almacenado correctamente.";
        } else {
            // Manejar error
            echo "No se pudo obtener el token.";
        }
    }

    protected function storeToken($email, $data) {
        $table_name = $this->wpdb->prefix . "dte_credentials";
        $this->wpdb->insert($table_name, array(
            'email' => $email,
            'access_token' => $data['access_token'],
            'token_type' => $data['token_type'],
            'expires_in' => $data['expires_in'],
            'refresh_token' => $data['refresh_token'],
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql')
        ));
    }

    protected function renderForm() {
        // Incluir la vista del formulario
        include SII_PLUGIN_DIR . 'includes/views/credentials_form.php';
    }
    

}


