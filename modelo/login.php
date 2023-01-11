<?php

include_once("baseDatos.php");

class ModeloLogin {

    public static function login($user, $password) {

        $error = 0;
        $db = new BaseDatos();
        $datos = $db->select(
            "
                SELECT usuarios.id_usuarios, usuarios.programa_o_tipo, usuarios.nombres,usuarios.apellido,cuentas.username,cuentas.password FROM usuarios, cuentas WHERE usuarios.id_usuarios=$user AND cuentas.id_usuarios=usuarios.id_usuarios;
            "
        );
        

        if ($datos != null) {

           if (($password) == $datos[0]['password']) {

                $_SESSION['appname']['authorized'] = true;
                $_SESSION['appname']['id_usuarios'] = $datos[0]['id_usuarios'];
                $_SESSION['appname']['tipo'] = $datos[0]['programa_o_tipo'];
                $_SESSION['appname']['nombre'] = $datos[0]['nombres']." ".$datos[0]['apellido'];
                $_SESSION['appname']['username'] = $datos[0]['username'];
                $_SESSION['appname']['password'] = $datos[0]['password'];
            }
            else {
                $_SESSION['appname']['error'] = 'Contraseña incorrecta';
            }
        }
        else {
            $_SESSION['appname']['error'] = 'Usuario no registrado';
        }
    }

    public static function logout() {

        unset($_SESSION['authorized']);
        unset($_SESSION['usuario']);
        session_destroy();
    }
}
?>
