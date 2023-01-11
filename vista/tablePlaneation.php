<?php 
include_once("modelo/administration.php");
class VistaTablePlaneation
{
    public static function tablePlaneation()
    {
    	$m_list=new ModeloAdministration();
        $Planeaciones=$m_list->Consulta_Planeacion();
    	echo "
    	<main>

    		<h1>Planeacion</h1>
            <div>
                <div class='centered-content block'>
	                <div class='left-aligned'>
	                    
	                    <a href='index.php?accion=nuevaAdministracion' title='Nuevo equipo'>
	                        <i class='fas fa-plus action add'></i>
	                    </a>
	                   
	                </div>
    				<div class='form-filter'>
	                    <form method='POST' action=''>
	                        <input type='text' size='25' name='filter[keyword]' placeholder='Search...'>
	                        <select name='filter[role]'>
	                            <option value='*' selected='selected'>-Todos los roles-</option>

	                            <option value='1'>root</option>

	                            <option value='2'>Administrador</option>

	                            <option value='4'>Asociado</option>

	                            <option value='5'>Secretario</option>

	                            <option value='7'>Cliente</option>

	                        </select>

	                        <select name='filter[status]'>

	                            <option value='*' selected='selected'>-Cualquier estado-</option>

	                            <option value='1'>Inactivo</option>

	                            <option value='2'>Activo</option>

	                            <option value='3'>Bloqueado</option>

	                        </select>

	                        <span class='actions'>
	                            <button name='action' value='SEARCH' title='Filter shift'><i class='fas fa-search action search'></i></button>
	                            <button name='action' value='CLEAR' title='Clear filter'><i class='fas fa-eraser action clear'></i></button>
	                        </span>
	                    </form>
	                </div>  	
            <table id='details' class='data'>
                <thead>
                    <tr>
                        <th>ACTIVIDAD</th>
                        <th>FECHA</th>
                        <th>DIA</th>
                        <th>ASIGNATURA</th>
                        <th>ENCARGADO</th>
                        <th>OBSERVACIONES</th>
                        <th>HORA INICIO</th>
                        <th>HORA FIN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
				<tbody>";

	                foreach ($Planeaciones as $Planeacion) {
	                	echo 
	                	"<tr>
	                        <td>".$Planeacion['actividad']."</td>
	                        <td>".$Planeacion['fecha']."</td>
	                        <td>".$Planeacion['dia']."</td>
	                        <td>".$Planeacion['asignatura']."</td>
	                        <td>".$Planeacion['apellido']." ".$Planeacion['nombres']."</td>
	                        <td>".$Planeacion['observaciones']."</td>
	                        <td>".$Planeacion['hora_inicio']."</td>
	                        <td>".$Planeacion['hora_fin']."</td>
							<td>
								<a href='index.php?accion=editar_administracion&id=".$Planeacion['id_planeacion']."' title='Editar'>
			                        <i class='fas fa-edit action big edit'></i>
			                    </a>
			                    <a href='index.php?accion=ver_administracion&id=".$Planeacion['id_planeacion']."' title='Ver'>
			                        <i class='fas fa-eye action big view'></i>
			                    </a>
			                </td>
	                    </tr>";
	                }                      
	                echo 
	                "</tbody>
            </table>
        
        </main>";
    }
}
?>