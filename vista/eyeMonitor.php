<?php 
include_once("modelo/administration.php");
class VistaEyeMonitor
{
    public static function eyemonitor($id)
    {
        $m_administration = new ModeloAdministration();
        $Monitores = $m_administration->Consulta_Editar_Horario_Monitor($id);
        $Estados = $m_administration->Consulta_Estado_Monitor();
        echo "
        <main>
            <h1>Editar Monitor</h1>
            <div>
                <div class='centered-content block'>
                    <form id='modificarmonitor'>
                        <span class='form-title'>
                            <a href='index.php?accion=monitores' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a tabla monitor
                        </span>

                        <label>Monitor</label>
                        <input type='text' name='monitorEscrito' size='25'value='".$Monitores[0]['id_usuarios']." ".$Monitores[0]['apellido']." ".$Monitores[0]['nombres']."' readonly=true/>
                        <input type='hidden' id='custId' name='monitor' value=".$Monitores[0]['id_usuarios'].">


                        <label>Fecha</label>
                        <input type='date' name='fecha' value='";
                        $partes = explode(" ", $Monitores[0]['fecha']);
                        if($Monitores[0]['fecha']!=null){
                            echo $partes[0];
                        }
                        $hora =date($Monitores[0]['hora_inicio']);
                        $hora2 =date($Monitores[0]['hora_fin']);
                        echo "' readonly=true/>

                        <label>Hora Inicio</label>
                        <input type='time' name='hora_inicio' size='25'value='$hora' readonly=true/>

						<label>Hora Fin</label>
                        <input type='time' name='hora_fin' size='25'value='$hora2' readonly=true/>

                        <label>Actividad</label>
                        <textarea rows='4' cols='50' name='actividad' readonly=true>".$Monitores[0]['actividad']."</textarea>

                        <label>Estado</label>
                        <select name='estado' disabled>
                        ";
                        foreach ($Estados as $Estado) {
                            if ($Estado['id_estado']==$Monitores[0]['estado']) {
                                echo "<option value='".$Monitores[0]['estado']."' selected>".$Estado['descripcion']."</option>";
                            }else{
                                echo "<option value='".$Estado['id_estado']."'>".$Estado['descripcion']."</option>";
                            }
                            
                        }
                        echo "</select>
  					</form>
                </div>
            </div>
        </main>";
    }
}
?>