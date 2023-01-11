<?php 
include_once("modelo/list.php");
class VistaEditLoan
{
    public static function editloan($codigo,$programa,$id,$pg)
    {
        $m_list=new ModeloList();

        $array_datosEye=$m_list->Consulta_datosEye($id);
        $tam_datosEye = sizeof($array_datosEye,0);

        $array_elementosEye=$m_list->Consulta_elementosEyeEdit($id);
        $tam_elementosEye = sizeof($array_elementosEye,0);

        $time = time();

        $fecha =date("Y-m-d H:i:s", $time);


        echo "
        <main>

            <h1>Editar Prestamo</h1>
            <div>

                <div class='centered-content block'>
                    <form id='crear-prestamo' method='POST' action='index.php?accion=editarEquipo&id=".$id."&pg=".$pg."'>
                        <span class='form-title'>
                            <a href='index.php?accion=pagina&pg=".$pg."' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a prestamos
                        </span>

                        <label>Fecha Solicitud</label>
                        <input type='text' name='fechaS' size='25' value='".$array_datosEye[0][0]."' readonly=true/>

                        <label>Fecha Devolución</label>
                        <input type='text' name='fechaD' size='25' value='".$fecha."' readonly=true/>

                        <label>Código Solicitante</label>
                        <input type='text' name='codigoS' size='25' value='".$array_datosEye[0][2]."' readonly=true/>

                        <label>Código aprobado por</label>
                        <input type='text' name='codigoA' size='25' value='".$array_datosEye[0][3]."' readonly=true/>

                        <label>Código entregado por</label>
                        <input type='text' name='monitor' size='25' value='".$array_datosEye[0][4]."' readonly=true></input>

                        <label>Código recibido por</label>
                        <input type='text' name='codigoR' size='25' value='".$codigo."' readonly=true/>
                        
                        <label><h1>Tabla de Elementos</h1></label>
                        <table id='details' class='data'>
                            <thead>
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>CANTIDAD</th>
                                    <th>DEVOLUCIÓN</th>
                                </tr>
                            </thead>

                            <tbody>";

                                foreach ($array_elementosEye as $elemento ) {
                                    echo 
                                    "<tr>
                                        <td>".$elemento['id_elemento']."</td>
                                        <td>".$elemento['descripcion']."</td>
                                        <td>".$elemento['cantidad']."</td>
                                        <td><input type='checkbox' name='id_elementos[]' value='".$elemento['id_elemento']."'/></td>
                                    </tr>";
                                }
                                
                            echo "</tbody>

                        </table>
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