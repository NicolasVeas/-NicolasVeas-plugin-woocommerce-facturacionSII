<?php

// views/CrentialsView.php

class CredentialsView {

    public function renderForm() {
        ?>
        <form method="post" action="">
            Email: <input type="text" name="email" required>
            Password: <input type="password" name="password" required>
            <input type="submit" value="Obtener Token">
        </form>
        <?php
    }

    // Si deseas agregar otros métodos de renderizado para otras partes de la interfaz, puedes hacerlo aquí.

}
