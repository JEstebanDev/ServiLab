<?php 
include_once("modelo/administration.php");
class VistaPlaneation
{
    public static function planeation()
    {
        $m_administration = new ModeloAdministration();
        $actividades = $m_administration->Consulta_Actividades();
        $dia = $m_administration->Consulta_Dias();
        $estado = $m_administration->Consulta_Estado_planeacion();
        $encargado = $m_administration->Consulta_Encargado();
        $aprobado = $m_administration->Consulta_Aprobado();
        echo "
        <main>
            <h1>Nueva Planeación</h1>
            <div>
                <div class='centered-content block'>
                    <form id='crear-planeacion' method='POST' action='index.php?accion=guardar_administracion'>
                        <span class='form-title'>
                            <a href='index.php?accion=planeacion' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a tabla planeacion
                        </span>

                        <span class='message obligatory'>Los campos marcados con (*) son obligatorios</span>

                        <label>Actividad<span class='obligatory'>(*)</span></label>
                        <select name='actividad'>
                        <option >-actividad-</option>
                        ";
                        foreach ($actividades as $actividad) {
                            echo "<option value='".$actividad['id_actividad']."'>".$actividad['descripcion']."</option>";
                        }
                        echo "</select>

                        <label>Fecha</label>
                        <input type='date' name='fecha' size='25'/>

                        <label>Dia</label>
                        <select name='dia'>
                        ";
                        foreach ($dia as $dias) {
                            echo "<option value='".$dias['id_dia']."'>".$dias['descripcion']."</option>";
                        }
                        echo "</select>

                        <label>Asignatura<span class='obligatory'>(*)</span></label>
                        <input type='text' name='asignatura' size='25'/>

                        <label>Encargado<span class='obligatory'>(*)</span></label>
                        <select name='encargado'>
                        ";
                        foreach ($encargado as $encargados) {
                            echo "<option value='".$encargados['id_usuarios']."'>".$encargados['id_usuarios']."-".$encargados['apellido']." ".$encargados['nombres']."</option>";
                        }
                        echo "</select>

						<label>Observaciones</label>
                        <textarea rows='4' cols='50' name='observaciones'></textarea>

                        <label>Aprobó<span class='obligatory'>(*)</span></label>
                        <select name='aprobado'>
                        ";
                        foreach ($aprobado as $aprobados) {
                            echo "<option value='".$aprobados['id_usuarios']."'>".$aprobados['id_usuarios']."-".$aprobados['apellido']." ".$aprobados['nombres']."</option>";
                        }
                        echo "</select>

                        <label>Hora Inicio<span class='obligatory'>(*)</span></label>
                        <input type='time' name='hora_inicio' size='25'/>

						<label>Hora Fin<span class='obligatory'>(*)</span></label>
                        <input type='time' name='hora_fin' size='25'/>

                        <span class='actions'>
                            <button title='Guardar cambios'><i class='fas fa-plus button create'></i></button>

                        </span>
  					</form>
                </div>
            </div>
        </main>";
    }
}
?>