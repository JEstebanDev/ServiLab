<?php
include_once("modelo/list.php");
class VistaEye
{
    public static function eye($id,$pg)
    {
        $m_list=new ModeloList();
        
        $array_datosEye=$m_list->Consulta_datosEye($id);
        $tam_datosEye = sizeof($array_datosEye,0);

        $array_elementosEye=$m_list->Consulta_elementosEye($id);
        $tam_elementosEye = sizeof($array_elementosEye,0);

        echo "
        <main>

            <h1>Prestamo Individual</h1>
            <div>

                <div class='centered-content block'>
                    <form id='crear-prestamo' method='POST' action='index.php?accion=crear'>
                        <span class='form-title'>
                            <a href='index.php?accion=pagina&pg=".$pg."' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a prestamos
                        </span>

                        <label>Fecha Solicitud</label>
                        <input type='text' name='fechaS' size='25' value='".$array_datosEye[0][0]."' readonly=true/>

                        <label>Fecha Devolución</label>
                        <input type='text' name='fechaD' size='25' value='";
                        if($array_datosEye[0][1]!=null){
                            echo $array_datosEye[0][1];
                        }else{
                            echo "Fecha sin registrar";
                        }

                        echo "' readonly=true/>

                        <label>Código Solicitante</label>
                        <input type='text' name='codigoS' size='25' value='".$array_datosEye[0][2]."' readonly=true/>

                        <label>Código aprobado por</label>
                        <input type='text' name='codigoA' size='25' value='".$array_datosEye[0][3]."' readonly=true/>

                        <label>Código entregado por</label>
                        <input type='text' name='monitor' size='25' value='".$array_datosEye[0][4]."' readonly=true></input>

                        <label>Código recibido por</label>
                        <input type='text' name='codigoR' size='25' value='";
                        if($array_datosEye[0][5]!=null){
                            echo $array_datosEye[0][5];
                        }else{
                            echo "Aún sin entregar";
                        }
                        echo "' readonly=true/>
                        
                        <label><h1>Tabla de Elementos</h1></label>
                        <table id='details' class='data'>
                            <thead>
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>CANTIDAD</th>
                                </tr>
                            </thead>

                            <tbody>";

                                for ($i=0; $i < $tam_elementosEye; $i++) { 
                                    echo 
                                    "
                                    <tr>
                                        <td><label>".$array_elementosEye[$i][0]."</label></td>
                                        <td><label>".$array_elementosEye[$i][1]."</label></td>
                                        <td><label>".$array_elementosEye[$i][2]."</label></td>
                                    </tr>";
                                }
                                
                            echo "</tbody>

                        </table>
                    </form>
                </div>
            </div>
        </main>";
    }
}
?>