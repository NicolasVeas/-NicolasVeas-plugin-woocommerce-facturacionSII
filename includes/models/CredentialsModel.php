<?php

// CredentialsModel.php

class CredentialsModel {

    private $wpdb;
    private $table_name;

    public function __construct($wpdb) {
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'dte_credentials';
    }

    public function saveCredentials($credentials) {
        // Asegurarse de que solo se mantiene una fila en la tabla (esto es según tu código original)
        $this->wpdb->query("DELETE FROM $this->table_name");

        // Insertar las nuevas credenciales
        return $this->wpdb->insert($this->table_name, $credentials);
    }

    public function getCredentials() {
        $credentials = $this->wpdb->get_row("SELECT * FROM $this->table_name LIMIT 1");
        return $credentials;
    }
}
