<?php 
include_once("baseDatos.php");

class ModeloInventory {
    private static $mbd=null;
	static function Consulta_Inventario() {
        $SentenciaInventarioSQL = "SELECT inventario.id_elemento, inventario.descripcion,inventario.marca,inventario.observaciones FROM inventario WHERE 1";
        $variable=BaseDatos::select($SentenciaInventarioSQL);
        return $variable; 
	}

    static function Consulta_TodoInventario($id) {
        self::metodo();
        $SentenciaInventarioSQL = "SELECT * FROM inventario WHERE inventario.id_elemento=".$id.";";
        $enviarSentenciaInventario = self::$mbd->prepare($SentenciaInventarioSQL); 
        $enviarSentenciaInventario->execute();
        return $arrayConsulta = $enviarSentenciaInventario->fetchAll(); 
    }

    static function Consulta_TodoEstado() {
        self::metodo();
        $SentenciaInventarioSQL = "SELECT * FROM descripcion_estados WHERE descripcion_estados.categoria='inventario';";
        $enviarSentenciaInventario = self::$mbd->prepare($SentenciaInventarioSQL); 
        $enviarSentenciaInventario->execute();
        return $arrayConsulta = $enviarSentenciaInventario->fetchAll(); 

    }

    static function Consulta_Garantia() {
        self::metodo();
        $SentenciaGarantiaSQL = "SELECT * FROM garantia WHERE 1";
        $enviarSentenciaGarantia = self::$mbd->prepare($SentenciaGarantiaSQL); 
        $enviarSentenciaGarantia->execute();
        return $arrayConsulta = $enviarSentenciaGarantia->fetchAll(); 
    }

    static function Consulta_Categorias_Inventario() {
        self::metodo();
        $SentenciaCategoriaSQL = "SELECT * FROM categorias_inventario WHERE 1 ";
        $enviarSentenciaCategoria = self::$mbd->prepare($SentenciaCategoriaSQL); 
        $enviarSentenciaCategoria->execute();
        return $arrayConsulta = $enviarSentenciaCategoria->fetchAll(); 
    }

    static function Insertar_Inventario($codigo,$descripcion,$marca,$modelo,$serie,$cc_responsable,$nombre_responsable,$rol_garantia,$observaciones,$fecha_alta,$rol_categoria) {
        $db = new BaseDatos();
        $time = time();
        $hora =date("H:i:s", $time);
        $fecha_alta=$fecha_alta.' '.$hora;

        $SentenciaSQL = "INSERT INTO gitse.inventario VALUES('".$codigo."','".$descripcion."','".$marca."','".$modelo."','".$serie."','".$cc_responsable."','".$nombre_responsable."','".$rol_garantia."','".$observaciones."','".$fecha_alta."',NULL,'".$rol_categoria."',4);";
        $db->insert($SentenciaSQL);
    }

    static function Modificar_Inventario($codigo,$descripcion,$marca,$modelo,$serie,$cc_responsable,$nombre_responsable,$rol_garantia,$observaciones,$fecha_alta,$fecha_baja,$rol_categoria,$estado) {
        $db = new BaseDatos();
        $time = time();
        $hora =date("H:i:s", $time);
        
        if ($fecha_baja!="") {
            $fecha_baja=$fecha_baja.' '.$hora;
        }else{
            $fecha_baja='NULL';
        }
        
        $SentenciaSQL = "UPDATE inventario
        SET  descripcion='".$descripcion."', marca='".$marca."', modelo='".$modelo."', serie='".$serie."', cc_responsable='".$cc_responsable."', nombre_responsable='".$nombre_responsable."', inventario.garantia='".$rol_garantia."', observaciones='".$observaciones."', fecha_alta='".$fecha_alta."', fecha_baja=$fecha_baja, categoria='".$rol_categoria."', estado='".$estado."'
        WHERE inventario.id_elemento =".$codigo.";";
        $db->update($SentenciaSQL);
    }
    
    static function Consulta_IncidenciasId($codigo){
        self::metodo();
        $SentenciaIncidenciaSQL = "SELECT incidencia.id_equipo,incidencia.fecha,incidencia.id_usuario,incidencia.observaciones,incidencia.soporte,incidencia.id_incidencia FROM incidencia WHERE incidencia.id_incidencia=".$codigo.";";
        $enviarSentenciaIncidencia = self::$mbd->prepare($SentenciaIncidenciaSQL); 
        $enviarSentenciaIncidencia->execute();
        return $arrayConsulta = $enviarSentenciaIncidencia->fetchAll(); 
    }

    static function Consulta_Incidencias($codigo){
        self::metodo();
        $SentenciaIncidenciaSQL = "SELECT incidencia.id_equipo,incidencia.fecha,incidencia.id_usuario,incidencia.observaciones,incidencia.soporte,incidencia.id_incidencia FROM incidencia WHERE incidencia.id_equipo=".$codigo.";";
        $enviarSentenciaIncidencia = self::$mbd->prepare($SentenciaIncidenciaSQL); 
        $enviarSentenciaIncidencia->execute();
        return $arrayConsulta = $enviarSentenciaIncidencia->fetchAll(); 
    }

    static function Insertar_Incidencias($codigo,$fecha,$reporto,$observaciones,$soporte) {
        $db = new BaseDatos();
        $time = time();
        $hora =date("H:i:s", $time);
        $fechaa=$fecha.' '.$hora;
        $SentenciaSQL = "INSERT INTO gitse.incidencia (id_equipo, fecha, id_usuario, observaciones,soporte) VALUES('".$codigo."','".$fechaa."','".$reporto."','".$observaciones."','".$soporte."');";
        $db->insert($SentenciaSQL);
    }

    static function Modificar_Incidencias($observaciones,$soporte,$id){
        $db = new BaseDatos();
        $SentenciaSQL = "UPDATE incidencia SET observaciones='".$observaciones."' , soporte='".$soporte."' WHERE id_incidencia=".$id.";";
        $db->update($SentenciaSQL);
    }
    static function metodo(){
        try {
            self::$mbd = new PDO('mysql:host=localhost;dbname=gitse', 'root', '');
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
?>