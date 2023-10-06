<?php

function sii_setup_database() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // Tabla dte_credentials
    $sql_credentials = "CREATE TABLE {$wpdb->prefix}dte_credentials (
        id INT NOT NULL AUTO_INCREMENT,
        email TEXT NOT NULL,
        token TEXT NOT NULL,
        token_type TEXT DEFAULT NULL,
        expires_in TEXT DEFAULT NULL,
        issued_at TEXT DEFAULT NULL,
        client_id TEXT DEFAULT NULL,
        refresh_token TEXT DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Tabla dte_emisores
        $sql_emisores = "CREATE TABLE {$wpdb->prefix}dte_emisores (
            id INT NOT NULL AUTO_INCREMENT,
            rut TEXT NOT NULL,
            razon_social TEXT NOT NULL,
            direccion_origen TEXT NOT NULL,
            comuna_origen TEXT NOT NULL,
            giro TEXT NOT NULL,
            sucursal TEXT NOT NULL,
            ciudad_origen TEXT NOT NULL,
            actecos TEXT DEFAULT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";

    // Tabla dte_receptores
    $sql_receptores = "CREATE TABLE {$wpdb->prefix}dte_receptores (
        id INT NOT NULL AUTO_INCREMENT,
        rut TEXT NOT NULL,
        nombre TEXT NOT NULL,
        direccion TEXT NOT NULL,
        ciudad TEXT NOT NULL,
        email TEXT DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Tabla dtes
    $sql_dtes = "CREATE TABLE {$wpdb->prefix}dtes (
        id INT NOT NULL AUTO_INCREMENT,
        document_id TEXT NOT NULL,
        document_type TEXT NOT NULL,
        document_number TEXT NOT NULL,
        status TEXT DEFAULT NULL,
        document_date DATETIME NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Tabla dte_envios
    $sql_envios = "CREATE TABLE {$wpdb->prefix}dte_envios (
        id INT NOT NULL AUTO_INCREMENT,
        folio TEXT NOT NULL,
        sending_status TEXT DEFAULT NULL,
        effective_status TEXT DEFAULT NULL,
        effective_date DATETIME DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Ejecutamos la creación de las tablas
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_credentials);
    dbDelta($sql_emisores);
    dbDelta($sql_receptores);
    dbDelta($sql_dtes);
    dbDelta($sql_envios);
}


?>
