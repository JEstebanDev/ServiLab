<?php 
class VistaNewIncidents
{
    public static function newincidents($id)
    {
    	echo "
        <main>

            <h1>Crear Incidencia</h1>
            <div>
                <div class='centered-content block'>
                    <form id='crear-prestamo' method='POST' action='index.php?accion=crear_incidencia&id=".$id."'>
                        <span class='form-title'>
                           <a href='index.php?accion=inventario' title='Ir atras'><i class='fas fa-chevron-left action back'></i></a>
                            Volver a inventario
                            
                        </span>

                        <label>Código Equipo</label>
                        <input type='text' name='codigo' size='25'value='".$id."' readonly=true/>

                        <label>Fecha</label>
                        <input type='date' name='fecha' size='25'/>

                        <label>Reportó </label>
                        <input type='text' name='reporto' size='25'/>
                        
                        <label>Observaciones</label>
                        <textarea rows='4' cols='50' name='observaciones'></textarea>

                        <label>Soporte</label>
                        <textarea rows='4' cols='50' name='soporte'></textarea>

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