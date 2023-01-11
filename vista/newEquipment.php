<?php 
include_once("modelo/inventory.php");
class VistaEquipment
{
    public static function equipment()
    {
        $m_inventario=new ModeloInventory();
        $array=$m_inventario->Consulta_Garantia();
        $tam = sizeof($array,0);
        $array2=$m_inventario->Consulta_Categorias_Inventario();
        $tam2= sizeof($array2,0);
    	echo "
        <main>

            <h1>Nuevo Equipo</h1>
            <div>
                <div class='centered-content block'>
                    <form id='crear-prestamo' method='POST' action='index.php?accion=guardar_equipo'>
                        <span class='form-title'>
                            <a href='index.php?accion=inventario' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a inventario
                        </span>

                        <span class='message obligatory'>Los campos marcados con (*) son obligatorios</span>

                        <label>Código <span class='obligatory'>(*)</span></label>
                        <input type='text' name='codigo' size='25'/>

                        <label>Descripción <span class='obligatory'>(*)</span></label>
                        <input type='text' name='descripcion' size='25'/>

                        <label>Marca <span class='obligatory'>(*)</span></label>
                        <input type='text' name='marca' size='25'/>

                        <label>Modelo</label>
                        <input type='text' name='modelo' size='25'/>

                        <label>Serie</label>
                        <input type='text' name='serie' size='25'/>


                        <label>Cedula del responsable <span class='obligatory'>(*)</span></label>
                        <input type='text' name='cc_responsable' size='25'/>

                        <label>Nombre del responsable <span class='obligatory'>(*)</span></label>
                        <input type='text' name='nombre_responsable' size='25'/>

                        <label>Garantia <span class='obligatory'>(*)</span></label>
                        <select name='rol_garantia'>    
                            <option >-Garantia-</option>";
                            for ($i=0; $i <$tam ; $i++) {
                                echo "<option value='".$array[$i][0]."'>".$array[$i][1]."</option>";
                            }
                                
                        echo "</select>
                        
                        <label>Observaciones</label>
                        <textarea rows='4' cols='50' name='observaciones'></textarea>


                        <label>Fecha de Alta <span class='obligatory'>(*)</span></label>
                        <input type='date' name='fecha_alta'/>


                        <label>Categoria <span class='obligatory'>(*)</span></label>
                        <select name='rol_categoria'>
                        <option >-Categoria-</option>";
                            for ($i=0; $i <$tam2 ; $i++) {
                                echo "<option value='".$array2[$i][0]."'>".$array2[$i][1]."</option>";
                            }
                                
                        echo "</select>

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