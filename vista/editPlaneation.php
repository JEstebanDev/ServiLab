<?php 
include_once("modelo/administration.php");
class VistaEditPlaneation
{
    public static function editplaneation($id)
    {
        $m_administration = new ModeloAdministration();
        $actividades = $m_administration->Consulta_Actividades();
        $Planeacion_Unitaria = $m_administration->Consulta_Planeacion_Unitaria($id);
        $dia = $m_administration->Consulta_Dias();
        $estado = $m_administration->Consulta_Estado_planeacion();
        $encargado = $m_administration->Consulta_Encargado();
        $aprobado = $m_administration->Consulta_Aprobado();
        echo "
        <main>
            <h1>Editar Planeación</h1>
            <div>
                <div class='centered-content block'>
                    <form id='crear-planeacion' method='POST' action='index.php?accion=modificar_administracion&id=".$Planeacion_Unitaria[0]['id_planeacion']."''>
                        <span class='form-title'>
                            <a href='index.php?accion=planeacion' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a tabla monitor
                        </span>
                        <label>Actividad</label>
                        ";
                       
                        foreach ($actividades as $actividad) {
                            if($actividad['id_actividad']==$Planeacion_Unitaria[0]['actividad']){
                                echo "<input type='text' name='actividadescrito' size='25' value=".$actividad['descripcion']." readonly=true/>
                                <input type='hidden' id='custId' name='actividad' value=".$actividad['id_actividad'].">";
                            }
                        }
                        
                        echo "</select>
                        
                        <label>Fecha</label>
                        <input type='date' name='fecha' value='";
                        $partes = explode(" ", $Planeacion_Unitaria[0]['fecha']);
                        if($Planeacion_Unitaria[0]['fecha']!=null){
                            echo $partes[0];
                        }
                        echo "'/>

                        <label>Dia</label>
                        <select name='dia'>
                        ";
                        foreach ($dia as $dias) {
                            if ($dias['id_dia']==$Planeacion_Unitaria[0]['dia']) {
                               echo "<option value='".$Planeacion_Unitaria[0]['dia']."' selected>".$dias['descripcion']."</option>";
                            }else{
                                echo "<option value='".$dias['id_dia']."'>".$dias['descripcion']."</option>";
                            }
                            
                        }
                        echo "</select>

                        <label>Asignatura</label>
                        <input type='text' name='asignatura' size='25'value='".$Planeacion_Unitaria[0]['asignatura']."' readonly=true/>

                        <label>Encargado</label>
                        <select name='encargado'>
                        ";
                        foreach ($encargado as $encargados) {
                            if ($encargados['id_usuarios']==$Planeacion_Unitaria[0]['encargado']) {
                            echo "<option value='".$Planeacion_Unitaria[0]['encargado']."' selected>".$encargados['id_usuarios']."-".$encargados['apellido']." ".$encargados['nombres']."</option>";
                            }else{
                                echo "<option value='".$encargados['id_usuarios']."'>".$encargados['id_usuarios']."-".$encargados['apellido']." ".$encargados['nombres']."</option>";
                            }
                        }
                        echo "</select>

						<label>Observaciones</label>
                        <textarea rows='4' cols='50' name='observaciones'>".$Planeacion_Unitaria[0]['observaciones']."</textarea>

                        <label>Aprobó</label>
                        ";
                        foreach ($aprobado as $aprobados) {
                            if($aprobados['id_usuarios']==$Planeacion_Unitaria[0]['aprobo']){
                                echo "<input type='text' name='aprobado' size='25' value=".$aprobados['id_usuarios']."-".$aprobados['apellido']." ".$aprobados['nombres']." readonly=true/>";
                            }
                        }
                        $hora =date($Planeacion_Unitaria[0]['hora_inicio']);
                        $hora2 =date($Planeacion_Unitaria[0]['hora_fin']);
                        echo "
                        <label>Hora Inicio</label>
                        <input type='time' name='hora_inicio' size='25' value='$hora'/>

						<label>Hora Fin</label>
                        <input type='time' name='hora_fin' size='25' value='$hora2'/>
			
                        <label>Estado</label>
                        <select name='estado'>    ";
                        foreach ($estado as $estados) {
                            if ($estados['id_estado']==$Planeacion_Unitaria[0]['estado']) {
                            echo "<option value='".$Planeacion_Unitaria[0]['estado']."' selected>".$estados['descripcion']."</option>";
                            }else{
                                echo "<option value='".$estados['id_estado']."'>".$estados['descripcion']."</option>";
                            }
                        }
                        echo "</select>
                        <span class='actions'>
                            <button name='action' value='SAVE' title='Guardar cambios'><i class='fas fa-save button save'></i></button>

                        </span>
  					</form>
                </div>
            </div>
        </main>";
    }
}
?>