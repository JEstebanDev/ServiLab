<?php 
include_once("modelo/administration.php");
class VistaTableMonitor
{
    public static function tableMonitor()
    {
    	$m_list=new ModeloAdministration();
        $array=$m_list->Consulta_Horario_Monitor();
    	echo "
    	<main>

    		<h1>Horario Monitor</h1>
            <div>
                <div class='centered-content block'>
	                <div class='left-aligned'>
	                    
	                    <a href='index.php?accion=nuevoHorarioMonitor' title='Nuevo equipo'>
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
                        <th>MONITOR</th>
                        <th>FECHA</th>
                        <th>HORA INICIO</th>
                        <th>HORA FIN</th>
                        <th>ACTIVIDAD</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
				<tbody>";

	                foreach ($array as $arrays) {
	                	echo 
	                	"<tr>
	                        <td>".$arrays['apellido']." ".$arrays['nombres']."</td>
	                        <td>".$arrays['fecha']."</td>
							<td>".$arrays['hora_inicio']."</td>
							<td>".$arrays['hora_fin']."</td>
							<td>".$arrays['actividad']."</td>
							<td>
								<a href='index.php?accion=editar_monitor&id=".$arrays['id_horario_monitor']."' title='Editar'>
			                        <i class='fas fa-edit action big edit'></i>
			                    </a>
			                    <a href='index.php?accion=ver_monitor&id=".$arrays['id_horario_monitor']."' title='Ver'>
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