<?php
/*
Plugin Name: PLUGIN WooCommerce Facturación SII
Plugin URI: https://github.com/NicolasVeas/plugin-woocommerce-facturacionSII
Description: Plugin para gestionar la facturación electrónica con el SII a través de la API de Riosoft.
Version: 1.0
Author: NicolasVeas
Author URI: https://tuweb.com/
License: BSD
*/

// Prevención de acceso directo
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Definimos constantes para las rutas de nuestro plugin
define('SII_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SII_PLUGIN_URL', plugin_dir_url(__FILE__));

// Cargamos nuestros archivos
require_once SII_PLUGIN_DIR . 'includes/db-setup.php';
require_once SII_PLUGIN_DIR . 'includes/controllers/CredentialsController.php';
require_once SII_PLUGIN_DIR . 'includes/models/Emisor.php';
require_once SII_PLUGIN_DIR . 'includes/views/EmisorView.php';
require_once SII_PLUGIN_DIR . 'includes/controllers/EmisorController.php';
require_once SII_PLUGIN_DIR . 'includes/api/RiosoftAPI.php';

// Hook de activación: Configuración de la base de datos
register_activation_hook(__FILE__, 'sii_setup_database');

// Hook de desactivación: Puedes añadir lógica si necesitas realizar acciones al desactivar el plugin
register_deactivation_hook(__FILE__, 'sii_facturacion_deactivate');
function sii_facturacion_deactivate() {
    // Lógica al desactivar el plugin (si es necesario)
}

// Agregar opciones al menú de administración
add_action('admin_menu', 'sii_facturacion_menu');

function sii_facturacion_menu() {
    // Agregamos un menú principal para el plugin
    add_menu_page(
        'PLUGIN RIOSOFT',         // Título de la página
        'PLUGIN RIOSOFT',         // Título del menú
        'manage_options',         // Capacidad requerida
        'sii-facturacion',       // Slug del menú
    );

    // Agregamos una opción de submenú para Credenciales
    add_submenu_page(
        'sii-facturacion',       // Slug del menú padre
        'Credenciales de Facturación SII', // Título de la página
        'Credenciales',          // Título del submenú
        'manage_options',         // Capacidad requerida
        'sii-facturacion-credenciales',  // Slug del submenú
        'sii_facturacion_config_page'    // Función que muestra el contenido de esta página
    );

    // Agregamos una opción de submenú para Emisor
    add_submenu_page(
        'sii-facturacion',              // Slug del menú padre
        'Información del Emisor',       // Título de la página
        'Emisor',                       // Título del submenú
        'manage_options',               // Capacidad requerida
        'sii-facturacion-emisor',       // Slug del submenú
        'sii_facturacion_emisor_page'   // Función que muestra el contenido de esta página
    );

    
}


// Función que muestra el contenido de la página de configuración
function sii_facturacion_config_page() {
    global $wpdb;
    $controller = new CredentialsController($wpdb);
    $controller->handleRequest();
}

function sii_facturacion_emisor_page() {
    global $wpdb;
    $controller = new EmisorController($wpdb);
    $controller->handleRequest();
}


