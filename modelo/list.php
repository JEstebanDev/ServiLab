<?php 
include_once("baseDatos.php");

class ModeloList {
 private static $mbd=null;

    static function consultaDescripcionEstados(){
        $SentenciaDescripcionEstadosSQL = "SELECT descripcion_estados.id_estado,descripcion_estados.descripcion FROM descripcion_estados WHERE descripcion_estados.categoria='prestamo';";
        $variable=BaseDatos::select($SentenciaDescripcionEstadosSQL);
        return $variable;
    }

    static function consultaUsuarios(){
        $SentenciaconsultaUsuariosSQL = "SELECT usuarios.id_usuarios  FROM gitse.usuarios;";
        $variable=BaseDatos::select($SentenciaconsultaUsuariosSQL);
        return $variable;
    }
    static function consultaPaginacion($page){
        $SentenciaPaginacionSQL = "SELECT *  FROM prestamos LIMIT ".(($page-1)*3).", 3 ;";
        $variable=BaseDatos::select($SentenciaPaginacionSQL);
        return $variable;
    }
    static function consultaTotalPrestamos(){
        $SentenciaTotalPrestamosSQL = "SELECT COUNT(*) AS total FROM prestamos;";
        $variable=BaseDatos::select($SentenciaTotalPrestamosSQL);
        return $variable;
    }

	static function Consulta_Usuarios_e_Iconos() {
        self::conexionBD();
        $SentenciaUserSQL = "SELECT usuarios.id_usuarios,usuarios.nombres,roles.icono
        FROM usuarios,roles,roles_cuentas WHERE roles.id_rol=roles_cuentas.id_rol AND roles_cuentas.id_usuarios=usuarios.id_usuarios";
        $enviarSentencia1 = self::$mbd->prepare($SentenciaUserSQL); 
        $enviarSentencia1->execute();
        return $arrayConsutaUserBD = $enviarSentencia1->fetchAll(); 

	}
	static function Consulta_Parte_Sup_Tarjeta($page) {
       self::conexionBD();
        $SentenciaMedioSQL = "SELECT  prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.entregado_por,usuarios.nombres ,prestamos.recibido_por, prestamos.solicitante, prestamos.id_prestamo FROM prestamos,usuarios WHERE usuarios.id_usuarios=prestamos.entregado_por LIMIT ".(($page-1)*3).", 3";
        $enviarSentencia2 = self::$mbd->prepare($SentenciaMedioSQL); 
        $enviarSentencia2->execute();
        return $arrayConsutaMedioBD = $enviarSentencia2->fetchAll();
	}
	static function Consulta_Parte_Inf_Tarjeta() {
        self::conexionBD();
        $SentenciaElementosSQL = "SELECT elementos_prestados.id_prestamo, elementos_prestados.id_elemento,elementos_prestados.cantidad,elementos_prestados.estado FROM elementos_prestados WHERE 1;";
        $enviarSentencia4 = self::$mbd->prepare($SentenciaElementosSQL); 
        $enviarSentencia4->execute();
        return $arrayConsutaElementosBD = $enviarSentencia4->fetchAll();
	}
	static function Consulta_Inventario() {
        self::conexionBD();
        $SentenciaInventarioSQL = "SELECT inventario.id_elemento,inventario.descripcion FROM inventario WHERE 1";
        //$SentenciaInventarioSQL = "SELECT inventario.id_elemento,inventario.descripcion FROM inventario WHERE estado='7'";
        $enviarSentencia5 = self::$mbd->prepare($SentenciaInventarioSQL); 
        $enviarSentencia5->execute();
        return $arrayConsutaInventarioBD = $enviarSentencia5->fetchAll();
	}

    static function Consulta_datosEye($codigo) {
        self::conexionBD();
        $SentenciaDatosEyeSQL = "SELECT prestamos.fecha_prestamo,prestamos.fecha_devolucion,prestamos.solicitante, prestamos.aprobado_por, prestamos.entregado_por, prestamos.recibido_por FROM prestamos WHERE prestamos.id_prestamo=".$codigo.";";
        $enviarSentencia = self::$mbd->prepare($SentenciaDatosEyeSQL); 
        $enviarSentencia->execute();
        return $arrayConsutado = $enviarSentencia->fetchAll();
    }

    static function Consulta_elementosEye($codigo) {
        self::conexionBD();
        $SentenciaElementosEyeSQL = "SELECT inventario.id_elemento,inventario.descripcion, elementos_prestados.cantidad FROM elementos_prestados, inventario WHERE elementos_prestados.id_prestamo=".$codigo." AND elementos_prestados.id_elemento=inventario.id_elemento;";
        $enviarSentencia = self::$mbd->prepare($SentenciaElementosEyeSQL); 
        $enviarSentencia->execute();
        return $arrayConsutado = $enviarSentencia->fetchAll();
    }

    static function Consulta_elementosEyeEdit($codigo) {
        self::conexionBD();
        $SentenciaElementosEyeSQL = "SELECT inventario.id_elemento,inventario.descripcion, elementos_prestados.cantidad FROM elementos_prestados, inventario WHERE elementos_prestados.id_prestamo=".$codigo." AND elementos_prestados.id_elemento=inventario.id_elemento AND elementos_prestados.estado='1';";
        $enviarSentencia = self::$mbd->prepare($SentenciaElementosEyeSQL); 
        $enviarSentencia->execute();
        return $arrayConsutado = $enviarSentencia->fetchAll();
    }

    static function Modificar_prestamo($id,$id_elementos,$fechaD,$codigoR,$page) {

        $SentenciaModificarPrestamoSQL = "UPDATE gitse.prestamos
            SET  fecha_devolucion='".$fechaD."', recibido_por='".$codigoR."'  
            WHERE  prestamos.id_prestamo=".$id.";";
            $variable=BaseDatos::update($SentenciaModificarPrestamoSQL);

        foreach ($id_elementos as $id_elemento) {
            $SentenciaModificarElementos_PrestadosSQL = "UPDATE gitse.elementos_prestados
            SET fecha_devolucion='".$fechaD."', estado='3' WHERE  id_prestamo=".$id." AND elementos_prestados.id_elemento=".$id_elemento.";";
            $variable=BaseDatos::update($SentenciaModificarElementos_PrestadosSQL);
        }

        $aSuperiorTarjeta=self::Consulta_Parte_Sup_Tarjeta($page);
        $aInferiorTarjeta=self::Consulta_Parte_Inf_Tarjeta();
        $tam2 = sizeof($aSuperiorTarjeta,0);
        $tam = sizeof($aInferiorTarjeta,0);
        $estado=2;
        for ($i=0; $i < $tam2 ; $i++) { 
            if($aSuperiorTarjeta[$i][6]==$id)
            {
                print_r($aSuperiorTarjeta[$i][1]." = null");
                if($aSuperiorTarjeta[$i][1]==null)
                {
                    $estado=1;
                }else{
                    for ($m=0; $m < $tam; $m++) { 
                        if ($aInferiorTarjeta[$m][0]==$aSuperiorTarjeta[$i][6]) {
                            if($aInferiorTarjeta[$m][3]==1){
                                $estado=2;
                                break;
                            }
                            else{
                                $estado=3;
                            }
                        }
                    }
                }
            }
            
        }
        
        $SentenciaModificarPrestamoEstadoSQL = "UPDATE gitse.prestamos
            SET  estado='".$estado."' WHERE  prestamos.id_prestamo=".$id.";";
        $variable=BaseDatos::update($SentenciaModificarPrestamoEstadoSQL);
    }

    static function Nuevo_prestamo($fecha,$codigo,$monitor,$rol1,$rol2,$rol3,$rol4,$rol5,$username1
        ,$username2,$username3,$username4,$username5){
        self::conexionBD();
        

        $SentenciaInventarioSQL = "SELECT inventario.id_elemento,inventario.descripcion FROM inventario WHERE 1";
        $enviarSentencia5 = self::$mbd->prepare($SentenciaInventarioSQL); 
        $enviarSentencia5->execute();
        $inventario = $enviarSentencia5->fetchAll();
        
        $time = time();

        $hora =date("H:i:s", $time);

        $fecha=$fecha.' '.$hora;
        $db = new BaseDatos();
        
        $SentenciaNuevoPrestamoSQL = "INSERT INTO gitse.prestamos(fecha_prestamo, fecha_devolucion, solicitante, aprobado_por, entregado_por, recibido_por, actividad, observaciones, estado) VALUES('".$fecha."',NULL,".$codigo.",".$monitor.",".$monitor.",NULL,1,'',1);";
        $db->insert($SentenciaNuevoPrestamoSQL); 

        $SentenciaPrestamosSQL = "SELECT MAX(prestamos.id_prestamo) FROM prestamos ";
        $enviarSentencia5 = self::$mbd->prepare($SentenciaPrestamosSQL); 
        $enviarSentencia5->execute();
        $id = $enviarSentencia5->fetchAll();

        if($rol1!=0)
        {
            self::pregunta($rol1,$inventario,$id[0][0],$username1,$fecha,$db);
        }
        
        if($rol2!=0)
        {
            self::pregunta($rol2,$inventario,$id[0][0],$username2,$fecha,$db);
        }

        if($rol3!=0)
        {
            self::pregunta($rol3,$inventario,$id[0][0],$username3,$fecha,$db);
        }

        if($rol4!=0)
        {
            self::pregunta($rol4,$inventario,$id[0][0],$username4,$fecha,$db);
        }

        if($rol5!=0)
        {
            self::pregunta($rol5,$inventario,$id[0][0],$username5,$fecha,$db);
        }
    }

    static function pregunta($rol,$inventario,$id,$cantidad,$fecha,$db){
        for ($i=0; $i <sizeof($inventario, 0) ; $i++) { 
            if ($rol==$inventario[$i][0]) {
                $SentenciaElementosSQL = "INSERT INTO gitse.elementos_prestados  VALUES('".$id."',".$inventario[$i][0].",".$cantidad.",'".$fecha."',NULL,'',1);";
                $db->insert($SentenciaElementosSQL);

                $SentenciaInventarioEstadoSQL = "UPDATE gitse.inventario SET estado='4' WHERE  id_elemento=".$inventario[$i][0].";";
                $db->update($SentenciaInventarioEstadoSQL);

            }
        }

    }

    static function consulta_codigo_usuarios(){
        self::conexionBD();
        $Sentenciaconsulta_codigo_usuariosSQL = "SELECT usuarios.id_usuarios FROM usuarios;";
        $enviarSentencia = self::$mbd->prepare($Sentenciaconsulta_codigo_usuariosSQL); 
        $enviarSentencia->execute();
        return $arrayConsutado = $enviarSentencia->fetchAll();
    }
    static function conexionBD(){
        try {
            self::$mbd = new PDO('mysql:host=localhost;dbname=gitse', 'root', '');
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
?>  