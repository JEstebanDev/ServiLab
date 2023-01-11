<?php 
include_once("modelo/inventory.php");
class VistaInventory
{
    public static function inventory()
    {
		$m_inventary=new ModeloInventory();
        $arrays=$m_inventary->Consulta_Inventario();
    	echo "
    	<main>
    		<h1>Inventario</h1>
            <div>
                <div class='centered-content block'>
	                <div class='left-aligned'>
	                    
	                    <a href='index.php?accion=nuevoEquipo' title='Nuevo equipo'>
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
	            
					</br>
					</br>

					<div class='centered-content block'>
			            <table id='details' class='data'>
			                <thead>
			                    <tr>
			                        <th>CÓDIGO</th>
			                        <th>DESCRIPCIÓN</th>
			                        <th>MARCA</th>
			                        <th>OBSERVACIONES</th>
			                        <th>ACCIONES</th>
			                    </tr>
			                </thead>

			                <tbody>";
			                foreach ($arrays as $array) {
			                	echo 
			                	"<tr>
			                        <td>".$array['id_elemento']."</td>
			                        <td>".$array['descripcion']."</td>
									<td>".$array['marca']."</td>
									<td>".$array['observaciones']."</td>
									<td>
										<a href='index.php?accion=editar_inventario&id=".$array['id_elemento']."' title='Editar'>
					                        <i class='fas fa-edit action big edit'></i>
					                    </a>
					                    <a href='index.php?accion=ver_equipo&id=".$array['id_elemento']."' title='Ver'>
					                        <i class='fas fa-eye action big view'></i>
					                    </a>
					                    <a href='index.php?accion=tabla_incidencia&codigo=".$array['id_elemento']."' title='Tabla Incidencias'>
					                        <i class='fas fa-exclamation-triangle action big disable'></i>
					                    </a>
					                    <a href='index.php?accion=prestar_equipo&codigo=".$array['id_elemento']."' title='Prestar'>
					                        <i class='fas fa-plus action add'></i>
					                    </a>
									</td>
			                    </tr>";
			                }                      
			                echo 
			                "</tbody>
			            </table>
			          
		            </div>
	            </div>
            </div>
        </main>";
    }
}