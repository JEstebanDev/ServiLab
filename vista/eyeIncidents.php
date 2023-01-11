<?php 
include_once("modelo/inventory.php");
class VistaEyeIncidents
{
    public static function eyeincidents($id)
    {
        $m_inventario=new ModeloInventory();
        $array=$m_inventario->Consulta_IncidenciasId($id);
        $tam = sizeof($array,0);
    	echo "
        <main>

            <h1>Editar Tabla Incidencias</h1>
            <div>
                <div class='centered-content block'>
                    <form id='crear-prestamo' method='POST' action='index.php?accion=modificar_incidencia'>
                        <span class='form-title'>
                            <a href='index.php?accion=ver_equipo&id=".$array[0][0]."' title='Ver'>
                            <i class='fas fa-chevron-left action back'></i></a>
                            Volver a equipo
                        </span>

                        <label>Código Equipo</label>
                        <input type='text' name='codigo' size='25' value='".$array[0][0]."' readonly=true/>

                        <label>Fecha</label>
                        <input type='text' name='fecha' size='25'value='".$array[0][1]."' readonly=true/>

                        <label>Reportó </label>
                        <input type='text' name='reporto' size='25' value='".$array[0][2]."' readonly=true/>
                        
                        <label>Observaciones</label>
                        <textarea rows='4' cols='50' name='observaciones' readonly=true>".$array[0][3]."</textarea>

                        <label>Soporte</label>
                        <textarea rows='4' cols='50' name='soporte' readonly=true>".$array[0][4]."</textarea>

                        <input type='hidden' name='id' value='".$array[0][5]."' readonly=true/>

                        
  					</form>
                </div>
            </div>
        </main>";
    }
}
?>