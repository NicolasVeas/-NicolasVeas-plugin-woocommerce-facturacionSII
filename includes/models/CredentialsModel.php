<?php

// CredentialsModel.php

class CredentialsModel {

    private $wpdb;
    private $table_name;

    public function __construct($wpdb) {
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'dte_credentials';
    }

    public function saveCredentials($email) {
        return $this->wpdb->insert($this->table_name, array('email' => $email));
    }

    public function getCredentials() {
        $credentials = $this->wpdb->get_row("SELECT * FROM $this->table_name LIMIT 1");
        error_log(var_export($credentials, true));
        return $credentials;

    }
}
