<?php 
include_once("modelo/list.php");
class VistaLoan
{
    public static function loan($codigo,$programa,$noequipo)
    {
       
        $m_list=new ModeloList();
        $arrayInventarios=$m_list->Consulta_Inventario();
        $tam = sizeof($arrayInventarios,0);
        $arrayUsuarios=$m_list->consultaUsuarios();

        echo "
        <main>

            <h1>Nuevo Prestamo</h1>
            <div>

                <div class='centered-content block'>
                    <form id='crear-prestamo' method='POST' action='index.php?accion=crear'>
                        <span class='form-title'>
                            <a href='index.php' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a prestamos
                        </span>

                        <span class='message obligatory'>Los campos marcados con (*) son obligatorios</span>

                        <label>Fecha Solicitud <span class='obligatory'>(*)</span></label>
                        
                        <input type='date' name='fecha'/>

                        <label>Código Solicitante <span class='obligatory'>(*)</span></label>
               
                        <select name='codigo' class='myselect'>
                        <option >-Codigos-</option>
                        ";
                        foreach ($arrayUsuarios as $arrayUsuario) {
                            echo "<option value='".$arrayUsuario['id_usuarios']."'>".$arrayUsuario['id_usuarios']."</option>";
                        }
                        echo "</select>

                        <label>Monitor que entrega</label>
                        <input type='text' name='monitor' size='25' value='".$codigo." - ".$programa."' readonly=true></input>
                        
                        <label><h1>Tabla de Elementos</h1></label>
                        <table id='details' class='data'>
                            <thead>
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>CANTIDAD</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <select name='rol1' class='myselect'>
                                        <option value='0' ></option>";
                                            for ($i=0; $i <$tam ; $i++) {
                                                
                                                if ($noequipo==$arrayInventarios[$i][0]) {
                                                   echo "<option value='".$arrayInventarios[$i][0]."' selected='selected'>".$arrayInventarios[$i][1]."</option>"; 
                                                }else{
                                                    echo "<option value='".$arrayInventarios[$i][0]."'>".$arrayInventarios[$i][0]." ".$arrayInventarios[$i][1]."</option>";
                                                }
                                            }
                                            
                                        echo "</select>
                                    </td>
                                    <td class='income'>
                                        <input type='text' name='username1' size='25'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name='rol2' class='myselect'>
                                        <option value='0' selected='selected'></option>";
                                            for ($i=0; $i <$tam ; $i++) {
                                                echo "<option value='".$arrayInventarios[$i][0]."'>".$arrayInventarios[$i][0]." ".$arrayInventarios[$i][1]."</option>";
                                            }
                                        echo "</select>
                                    </td>
                                    <td class='income'>
                                        <input type='text' name='username2' size='25'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name='rol3' class='myselect'>
                                        <option value='0' selected='selected'></option>";
                                            for ($i=0; $i <$tam ; $i++) {
                                                echo "<option value='".$arrayInventarios[$i][0]."'>".$arrayInventarios[$i][0]." ".$arrayInventarios[$i][1]."</option>";
                                            }
                                        echo "</select>
                                    </td>
                                    <td class='income'>
                                        <input type='text' name='username3' size='25'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name='rol4' class='myselect'>
                                        <option value='0' selected='selected'></option>";
                                            for ($i=0; $i <$tam ; $i++) {
                                                echo "<option value='".$arrayInventarios[$i][0]."'>".$arrayInventarios[$i][0]." ".$arrayInventarios[$i][1]."</option>";
                                            }  
                                        echo "</select>
                                    </td>
                                    <td class='income'>
                                        <input type='text' name='username4' size='25'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name='rol5' class='myselect'>
                                        <option value='0' selected='selected'></option>";
                                            for ($i=0; $i <$tam ; $i++) {
                                                echo "<option value='".$arrayInventarios[$i][0]."'>".$arrayInventarios[$i][0]." ".$arrayInventarios[$i][1]."</option>";
                                            } 
                                        echo "</select>
                                    </td>
                                    <td class='income'>
                                        <input type='text' name='username5' size='25'>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
