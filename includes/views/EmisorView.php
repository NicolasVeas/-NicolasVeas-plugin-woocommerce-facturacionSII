<?php

class EmisorView {

    public function renderForm($emisor = null) {
        ?>
        <form action="?page=sii-facturacion-emisor&action=save" method="post">
            <label for="rut">RUT:</label>
            <input type="text" name="rut" value="<?php echo $emisor ? $emisor->rut : ''; ?>" required><br>
            
            <label for="rut">Direccion:</label>
            <input type="text" name="direccion_origen" value="<?php echo $emisor ? $emisor->direccion_origen : ''; ?>" required><br>
            
            <label for="rut">Ciudad:</label>
            <input type="text" name="ciudad_origen" value="<?php echo $emisor ? $emisor->ciudad_origen : ''; ?>" required><br>
            
            <label for="rut">Comuna:</label>
            <input type="text" name="comuna_origen" value="<?php echo $emisor ? $emisor->comuna_origen : ''; ?>" required><br>
            
            <label for="rut">Razón Social:</label>
            <input type="text" name="razon_social" value="<?php echo $emisor ? $emisor->razon_social : ''; ?>" required><br>

            <label for="rut">Giro:</label>
            <input type="text" name="giro" value="<?php echo $emisor ? $emisor->giro : ''; ?>" required><br>
            
            <label for="rut">Sucursal:</label>
            <input type="text" name="sucursal" value="<?php echo $emisor ? $emisor->giro : ''; ?>" required><br>
            
            <label for="rut">Actecos:</label>
            <input type="text" name="actecos" value="<?php echo $emisor ? $emisor->actecos : ''; ?>" required><br>

            <!-- ... Añade otros campos de forma similar ... -->
            <input type="submit" value="Guardar">
        </form>
        <?php
    }

    public function renderDetails($emisor) {
        if ($emisor) {
            echo "RUT: " . $emisor->rut . "<br>";
            echo "Razón Social: " . $emisor->razon_social . "<br>";
            echo "Direccion: " . $emisor->direccion_origen . "<br>";
            echo "Ciudad: " . $emisor->ciudad_origen . "<br>";
            echo "Comuna: " . $emisor->comuna_origen . "<br>";
            echo "Giro: " . $emisor->giro . "<br>";
            echo "Sucursal: " . $emisor->sucursal . "<br>";
            echo "Actecos: " . $emisor->actecos . "<br>";
        } else {
            echo "Emisor no encontrado.";
        }
    }

    public function renderList($emisor) {
        if ($emisor) {
            echo '<h2>Datos del Emisor</h2>';
            echo "RUT: " . $emisor->rut . "<br>";
            echo "Razón Social: " . $emisor->razon_social . "<br>";
            echo "Direccion: " . $emisor->direccion_origen . "<br>";
            echo "Ciudad: " . $emisor->ciudad_origen . "<br>";
            echo "Comuna: " . $emisor->comuna_origen . "<br>";
            echo "Giro: " . $emisor->giro . "<br>";
            echo "Sucursal: " . $emisor->sucursal . "<br>";
            echo "Actecos: " . $emisor->actecos . "<br>";
            // ... Muestra otros campos de forma similar ...
            echo '<a href="?page=sii-facturacion-emisor&action=edit">Editar datos</a>';
        } else {
            echo '<h2>No hay datos de emisor registrados</h2>';
            echo '<a href="?page=sii-facturacion-emisor&action=create">Registrar Emisor</a>';
        }
    }
}

