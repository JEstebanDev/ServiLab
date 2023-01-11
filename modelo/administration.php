<?php 
include_once("baseDatos.php");

class ModeloAdministration {
	static function Consulta_Planeacion() {
        $SentenciaPlaneacionSQL = "SELECT planeacion.id_planeacion,actividades.descripcion 'actividad',planeacion.fecha,dia_administracion.descripcion'dia',planeacion.asignatura,usuarios.apellido,usuarios.nombres,planeacion.observaciones,planeacion.hora_inicio,planeacion.hora_fin
            FROM planeacion
            INNER JOIN usuarios,actividades,dia_administracion
            WHERE planeacion.actividad=actividades.id_actividad AND planeacion.dia=dia_administracion.id_dia AND planeacion.encargado=usuarios.id_usuarios;";
        $variable=BaseDatos::select($SentenciaPlaneacionSQL);
        return $variable; 
	}

    static function Consulta_Planeacion_Unitaria($id) {
        $SentenciaPlaneacionUSQL = "SELECT * FROM planeacion WHERE planeacion.id_planeacion=".$id.";";
        $variable=BaseDatos::select($SentenciaPlaneacionUSQL);
        return $variable; 
    }

    static function Consulta_Actividades() {

        $SentenciaActividadesSQL = "SELECT * FROM actividades WHERE 1;";
        $variable=BaseDatos::select($SentenciaActividadesSQL);
        return $variable;
    }
    static function Consulta_Dias() {

        $SentenciaDiasSQL = "SELECT * FROM dia_administracion WHERE 1;";
        $variable=BaseDatos::select($SentenciaDiasSQL);
        return $variable;
    }
    static function Consulta_Estado_planeacion() {

        $SentenciaEstadoSQL = "SELECT * FROM descripcion_estados WHERE descripcion_estados.categoria='planeacion';";
        $variable=BaseDatos::select($SentenciaEstadoSQL);
        return $variable;
    }

    static function Consulta_Encargado() {

        $SentenciaEncargadoSQL = "SELECT roles_cuentas.id_usuarios,usuarios.apellido, usuarios.nombres , roles_cuentas.id_rol FROM roles_cuentas INNER JOIN usuarios WHERE roles_cuentas.id_usuarios=usuarios.id_usuarios AND ( id_rol=5 OR id_rol=4 OR id_rol=3) ;";
        $variable=BaseDatos::select($SentenciaEncargadoSQL);
        return $variable;
    }
    static function Consulta_Aprobado() {

        $SentenciaAprobadoSQL = "SELECT roles_cuentas.id_usuarios,usuarios.apellido, usuarios.nombres , roles_cuentas.id_rol FROM roles_cuentas INNER JOIN usuarios WHERE roles_cuentas.id_usuarios=usuarios.id_usuarios AND ( id_rol=5 OR id_rol=4 OR id_rol=3 OR id_rol=2) ;";
        $variable=BaseDatos::select($SentenciaAprobadoSQL);
        return $variable;
    }

    static function Consulta_GuardarPlaneacion($actividad,$fecha,$dia,$asignatura,$encargado,$observaciones,$aprobado,$hora_inicio,$hora_fin) {
        $SentenciaGuardarPlaneacionSQL = "INSERT INTO gitse.planeacion (actividad, fecha, dia, asignatura, encargado, observaciones, aprobo, hora_inicio, hora_fin, estado) VALUES ('".$actividad."', '".$fecha."', '".$dia."', '".$asignatura."', '".$encargado."', '".$observaciones."', '".$aprobado."', '".$hora_inicio."', '".$hora_fin."',5);";
        $variable=BaseDatos::insert($SentenciaGuardarPlaneacionSQL);
        
    }
    static function Consulta_ModificarPlaneacion($id,$actividad,$fecha,$dia,$asignatura,$encargado,$observaciones,$aprobado,$hora_inicio,$hora_fin,$estado) {
        $SentenciaGuardarPlaneacionSQL = "UPDATE gitse.planeacion SET actividad='".$actividad."', fecha='".$fecha."', dia='".$dia."', asignatura='".$asignatura."', encargado='".$encargado."', observaciones='".$observaciones."', aprobo='".$aprobado."', hora_inicio='".$hora_inicio."', hora_fin='".$hora_fin."', estado='".$estado."' WHERE id_planeacion=".$id.";";
        $variable=BaseDatos::update($SentenciaGuardarPlaneacionSQL);
       
    }
/////////////////////////////////// MONITORES//////////////////////////
    static function Consulta_Horario_Monitor() {
        $SentenciaHorario_MonitorSQL = "SELECT horario_monitor.id_horario_monitor,usuarios.apellido,usuarios.nombres,horario_monitor.fecha,horario_monitor.hora_inicio,horario_monitor.hora_fin,horario_monitor.actividad
            FROM horario_monitor
            INNER JOIN usuarios
            WHERE horario_monitor.monitor=usuarios.id_usuarios;";
        $variable=BaseDatos::select($SentenciaHorario_MonitorSQL);
        return $variable;
    }
    static function Consulta_Nuevo_Horario_Monitor() {
        $SentenciaHorario_MonitorSQL = "SELECT roles_cuentas.id_usuarios,usuarios.apellido,usuarios.nombres
        FROM roles_cuentas
        INNER JOIN usuarios
        WHERE roles_cuentas.id_usuarios=usuarios.id_usuarios AND roles_cuentas.id_rol=2;";
        $variable=BaseDatos::select($SentenciaHorario_MonitorSQL);
        return $variable;
    }
    static function Consulta_Editar_Horario_Monitor($id) {
        $SentenciaHorario_MonitorSQL = "SELECT horario_monitor.id_horario_monitor,usuarios.id_usuarios,usuarios.apellido,usuarios.nombres,horario_monitor.fecha,horario_monitor.hora_inicio,horario_monitor.hora_fin,horario_monitor.actividad,horario_monitor.estado,descripcion_estados.descripcion
        FROM horario_monitor
        INNER JOIN usuarios,descripcion_estados
        WHERE horario_monitor.estado=descripcion_estados.id_estado AND horario_monitor.monitor=usuarios.id_usuarios AND horario_monitor.id_horario_monitor=".$id.";";
        $variable=BaseDatos::select($SentenciaHorario_MonitorSQL);
        return $variable;
    }
    static function Consulta_Estado_Monitor() {
        $SentenciaEstado_MonitorSQL = "SELECT * FROM descripcion_estados WHERE descripcion_estados.categoria='monitor';";
        $variable=BaseDatos::select($SentenciaEstado_MonitorSQL);
        return $variable;
    }
    static function Consulta_Guardar_Horario_Monitor($monitor,$fecha,$hora_inicio,$hora_fin,$actividad) {
        $SentenciaGuardar_Horario_MonitorSQL = "INSERT INTO gitse.horario_monitor (monitor, fecha, hora_inicio, hora_fin, actividad, estado) VALUES ('".$monitor."', '".$fecha."', '".$hora_inicio."', '".$hora_fin."', '".$actividad."',12);";
        $variable=BaseDatos::insert($SentenciaGuardar_Horario_MonitorSQL);
    }
    static function Consulta_Modificar_Horario_Monitor($id,$monitor,$fecha,$hora_inicio,$hora_fin,$actividad,$estado)
    {
        $SentenciaModificarHorarioMonitorSQL = "UPDATE gitse.horario_monitor SET monitor='".$monitor."',fecha='".$fecha."', hora_inicio='".$hora_inicio."', hora_fin='".$hora_fin."', actividad='".$actividad."', estado='".$estado."' WHERE  id_horario_monitor=".$id.";";
        $variable=BaseDatos::update($SentenciaModificarHorarioMonitorSQL);
       
    }
    

}
?>