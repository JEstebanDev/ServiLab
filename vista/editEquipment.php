<?php 
include_once("modelo/inventory.php");
class VistaEditEquipment
{
    public static function editequipment($id)
    {
        $m_inventario=new ModeloInventory();
        $array=$m_inventario->Consulta_Garantia();
        $tam = sizeof($array,0);
        $array2=$m_inventario->Consulta_Categorias_Inventario();
        $tam2= sizeof($array2,0);
        $array3=$m_inventario->Consulta_TodoInventario($id);
        $tam3= sizeof($array3,0);
        $array4=$m_inventario->Consulta_TodoEstado();
        $tam4= sizeof($array4,0);
    	echo "
        <main>

            <h1>Editar Equipo</h1>
            <div>
                <div class='centered-content block'>
                    <form id='crear-prestamo' method='POST' action='index.php?accion=modificar_equipo'>
                        <span class='form-title'>
                            <a href='index.php?accion=inventario' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a inventario
                        </span>

                        <label>Código </label>
                        <input type='text' name='codigo' size='25' value='".$array3[0][0]."' readonly=true/>

                        <label>Descripción </label>
                        <input type='text' name='descripcion' size='25' value='".$array3[0][1]."'/>

                        <label>Marca </label>
                        <input type='text' name='marca' size='25' value='".$array3[0][2]."'/>

                        <label>Modelo</label>
                        <input type='text' name='modelo' size='25' value='".$array3[0][3]."'/>

                        <label>Serie</label>
                        <input type='text' name='serie' size='25' value='".$array3[0][4]."'/>

                        <label>Cedula del responsable</label>
                        <input type='text' name='cc_responsable' size='25' value='".$array3[0][5]."'readonly=true/>

                        <label>Nombre del responsable </label>
                        <input type='text' name='nombre_responsable' size='25' value='".$array3[0][6]."'readonly=true/>

                        <label>Garantia </label>
                        <select name='rol_garantia'>";
                        for ($i=0; $i <$tam ; $i++) {
                            if ($array3[0][7]==$array[$i][0]) {
                                echo "<option value='".$array3[0][7]."' selected>".$array[$i][1]."</option>";
                            }else{
                                echo "<option value='".$array[$i][0]."'>".$array[$i][1]."</option>";
                            }
                           
                        }
                                
                        echo "</select>
                        
                        <label>Observaciones</label>
                        <textarea rows='4' cols='50' name='observaciones'>".$array3[0][8]."</textarea>


                        <label>Fecha de Alta</label>
                        <input type='text' name='fecha_alta' size='25'value='".$array3[0][9]."' readonly=true/>";

                        $partes = explode(" ", $array3[0][10]);

                        echo "
                        <label>Fecha de Baja</label>
                        <input type='date' name='fecha_baja' value='";
                        if($array3[0][10]!=null){
                            echo $partes[0];
                        }
                        echo "'/>


                        <label>Categoria </label>
                        <select name='rol_categoria'>";
                        for ($i=0; $i <$tam2 ; $i++) {
                            if ($array3[0][11]==$array2[$i][0]) {
                                echo "<option value='".$array3[0][11]."' selected>".$array2[$i][1]."</option>";
                            }else{
                                echo "<option value='".$array2[$i][0]."'>".$array2[$i][1]."</option>";
                            }
                           
                        }
                                
                        echo "</select>

                        <label>Estado </label>
                        <select name='estado'>";
                        for ($i=0; $i <$tam4 ; $i++) {
                            if ($array3[0][12]==$array4[$i][0]) {
                                echo "<option value='".$array3[0][12]."' selected>".$array4[$i][1]."</option>";
                            }else{
                                echo "<option value='".$array4[$i][0]."'>".$array4[$i][1]."</option>";
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