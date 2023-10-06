<?php

class Emisor {

    public $rut;
    // ... Define otros campos aquí ...

    public static function get() {
        // Esta función devuelve el único emisor que tienes en la base de datos.
        // Por simplicidad, estoy asumiendo que siempre habrá solo una fila.
        global $wpdb;

        $table_name = $wpdb->prefix . 'dte_emisores';
        $result = $wpdb->get_row("SELECT * FROM $table_name LIMIT 1");

        if ($result) {
            $emisor = new self();
            $emisor->rut = $result->rut;
            $emisor->razon_social = $result->razon_social;
            $emisor->direccion_origen = $result->direccion_origen;
            $emisor->comuna_origen = $result->comuna_origen;
            $emisor->giro = $result->giro;
            $emisor->rut = $result->rut;
            $emisor->sucursal = $result->sucursal;
            $emisor->ciudad_origen = $result->ciudad_origen;
            $emisor->actecos = $result->actecos;
            $emisor->rut = $result->created_at;
            $emisor->rut = $result->updated_at;
            // ... Asigna otros campos aquí ...

            return $emisor;
        }

        return null;
    }

    public function save() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'dte_emisores';
        $data = array(
            'rut' => $this->rut,
            'razon_social' => $this->razon_social,
            'direccion_origen' => $this->direccion_origen,
            'comuna_origen' => $this->comuna_origen,
            'giro' => $this->giro,
            'sucursal' => $this->sucursal,
            'ciudad_origen' => $this->ciudad_origen,
            'actecos' => $this->actecos,
            'created_at' => $this->create_at,
            'updated_at' => $this->updated_at,
            // ... Añade otros campos aquí ...
        );


        // Verificamos si ya existe un emisor en la base de datos
        $existing = Emisor::get();

        if ($existing) {
            $wpdb->update($table_name, $data, array('id' => $existing->id));
        } else {
            $wpdb->insert($table_name, $data);
        }
    }
}
