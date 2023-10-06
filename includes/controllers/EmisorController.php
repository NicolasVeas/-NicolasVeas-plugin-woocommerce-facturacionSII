<?php

require_once SII_PLUGIN_DIR . 'includes/models/Emisor.php';

class EmisorController {

    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        error_log('Action: ' . $action);

        switch ($action) {
            case 'save':
                $this->saveEmisor();
                break;
            case 'edit':
                $this->editEmisor();
                break;
            case 'create':
                $this->createEmisor();
                break;
            default:
                $this->showEmisor();
        }
    }

    

    public function createEmisor() {
        $view = new EmisorView();
        $view->renderForm(); // No necesitas pasar ningún argumento ya que es un nuevo registro
    }    

    public function saveEmisor() {
        $emisor = new Emisor();
        
        $emisor->rut = $_POST['rut'];
        $emisor->razon_social = $_POST['razon_social'];
        $emisor->direccion_origen = $_POST['direccion_origen'];
        $emisor->comuna_origen = $_POST['comuna_origen'];
        $emisor->giro = $_POST['giro'];
        $emisor->sucursal = $_POST['sucursal'];
        $emisor->ciudad_origen = $_POST['ciudad_origen'];
        $emisor->actecos = $_POST['actecos'];
        $emisor->created_at = current_time('mysql');
        $emisor->updated_at = current_time('mysql');
        // Continuar para el resto de los campos...

        // Validaciones (como la del RUT) aquí...

        $emisor->save();
        echo "Emisor guardado correctamente!";
    }

    public function editEmisor() {
        $emisor = Emisor::get();
        $view = new EmisorView();
        $view->renderForm($emisor);
    }

    public function showEmisor() {
        $emisor = Emisor::get();
        $view = new EmisorView();
        $view->renderList($emisor);
    }
}

