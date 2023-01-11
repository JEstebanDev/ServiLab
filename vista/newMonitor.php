<?php 
include_once("modelo/administration.php");
class VistaMonitor
{
    public static function monitor()
    {
        $m_administration = new ModeloAdministration();
        $Monitores = $m_administration->Consulta_Nuevo_Horario_Monitor();
        
        echo "
        <main>
            <h1>Nuevo Monitor</h1>
            <div>
                <div class='centered-content block'>
                    <form id='crear-monitor' method='POST' action='index.php?accion=guardar_monitor'>
                        <span class='form-title'>
                            <a href='index.php?accion=monitores' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a tabla monitor
                        </span>

                        <span class='message obligatory'>Los campos marcados con (*) son obligatorios</span>

                        <label>Monitor<span class='obligatory'>(*)</span></label>
                        <select name='monitor'>
                        ";
                        foreach ($Monitores as $Monitor) {
                            echo "<option value='".$Monitor['id_usuarios']."'>".$Monitor['apellido']." ".$Monitor['nombres']."</option>";
                        }
                        echo "</select>

                        <label>Fecha<span class='obligatory'>(*)</span></label>
                        <input type='date' name='fecha' size='25'/>

                        <label>Hora Inicio<span class='obligatory'>(*)</span></label>
                        <input type='time' name='hora_inicio' size='25'/>

						<label>Hora Fin<span class='obligatory'>(*)</span></label>
                        <input type='time' name='hora_fin' size='25'/>

                        <label>Actividad<span class='obligatory'>(*)</span></label>
                        <textarea rows='4' cols='50' name='actividad'></textarea>

                        <span class='actions'>
                            <button title='Crear nuevo horario'><i class='fas fa-plus button create'></i></button>

                        </span>
  					</form>
                </div>
            </div>
        </main>";
    }
}
?>