<?php 
include_once("modelo/list.php");
class VistaLista {

    public static function lista($pg) {

        $m_list=new ModeloList();
        $page = 1;//inicializamos la variable $page a 1 por default
        if(array_key_exists('pg', $_GET)){
              $page = $_GET['pg']; 
        }
        $aUsuariosIconos=$m_list->Consulta_Usuarios_e_Iconos();
        $aSuperiorTarjeta=$m_list->Consulta_Parte_Sup_Tarjeta($page);
        $aInferiorTarjeta=$m_list->Consulta_Parte_Inf_Tarjeta();

        $aTotalPrestamos=$m_list->consultaTotalPrestamos();
        $aInventario=$m_list->Consulta_Inventario();
        $aPaginacion=$m_list->consultaPaginacion($page);
        
        $aEstadosFiltros=$m_list->consultaDescripcionEstados();

        echo "

        <main>
            <h1>Prestamos</h1>
            <div>
                <div class='left-aligned'>
                    <a href='index.php?accion=nuevoPrestamo' title='Formulario 1'>
                        <i class='fas fa-plus action add'></i>
                    </a>
                </div>
                <div class='form-filter'>
                    <form method='POST' action=''>
                        <input type='date' size='25' name='filter[keyword]'>
                        <input type='date' size='25' name='filter[keyword]'>
                        <select name='estados'>
                        <option >-estados-</option>
                        ";
                        foreach ($aEstadosFiltros as $aEstadosFiltro) {
                            echo "<option value='".$aEstadosFiltro['id_estado']."'>".$aEstadosFiltro['descripcion']."</option>";
                        }
                        /*SELECT prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.entregado_por,usuarios.nombres,prestamos.recibido_por, prestamos.solicitante, prestamos.id_prestamo, prestamos.estado
FROM prestamos,usuarios
WHERE usuarios.id_usuarios=prestamos.entregado_por AND estado=3 AND prestamos.fecha_devolucion BETWEEN '20190823' AND '20190824';*/
                        echo "</select>
                        

                        <span class='actions'>
                            <button name='index.php?accion=filtroPretamo' value='SEARCH' title='Filter shift'><i class='fas fa-search action search'></i></button>
                            <button name='action' value='CLEAR' title='Clear filter'><i class='fas fa-eraser action clear'></i></button>
                        </span>
                    </form>
                </div>";
                echo "<div class='card-list'> ";

                $num_paginador =ceil(($aTotalPrestamos[0]['total'])/3);
                
                for ($i=0; $i <sizeof($aSuperiorTarjeta, 0); $i++) { 
                     
                    echo "
                    <div class='card'>
                        <span class='card-title'>";
                            
                            for($h=0 ; $h<sizeof($aUsuariosIconos, 0); $h++)
                            {
                                if($aSuperiorTarjeta[$i][5]==$aUsuariosIconos[$h][0])
                                {
                                    echo "<h1 class='black' class='status enabled' title='Registro activo'><i class='{$aUsuariosIconos[$h][2]}'></i> ".$aSuperiorTarjeta[$i][5]." - ".$aUsuariosIconos[$h][1]."</h1>" ;
                                }
                            }

                            echo "<h2 class='black' title='Registro activo'><i class='far fa-calendar-minus'></i> ".$aSuperiorTarjeta[$i][0]."</h2>";
                            $tam = sizeof($aInferiorTarjeta,0);
                            $color="yellow";
                            if($aSuperiorTarjeta[$i][1]===null)
                            {
                                $color="red";
                            }else{
                                for ($m=0; $m < $tam; $m++) { 
                                    if ($aInferiorTarjeta[$m][0]==$aSuperiorTarjeta[$i][6]) {
                                        if($aInferiorTarjeta[$m][3]==1){
                                            $color="yellow";
                                            break;
                                        }
                                        else{
                                            $color="green";
                                        }
                                    }
                                }
                            }
                            echo "<h2 class='$color' title='Registro activo'><i class='far fa-calendar-check'></i> ".$aSuperiorTarjeta[$i][1]."</h2>";
                            echo "<h2 class='black' title='Registro activo'><i class='fas fa-sign-out-alt'></i> " .$aSuperiorTarjeta[$i][2]." - ".$aSuperiorTarjeta[$i][3] ."</h2>";
                                $devolucion=0;
                                for($h=0 ; $h<sizeof($aUsuariosIconos, 0); $h++)
                                {
                                    if($aSuperiorTarjeta[$i][4]==$aUsuariosIconos[$h][0])
                                    {
                                        $devolucion=1;

                                        echo "<h2 class='$color' title='Registro activo'><i class='fas fa-sign-in-alt'></i> "
                                        .$aSuperiorTarjeta[$i][4]." - ".$aUsuariosIconos[$h][1] ."</h2>";
                                    }
                                }
                                if ($devolucion!=1) {
                                    echo "<h2 class='red' title='Registro activo'><i class='fas fa-sign-in-alt'></i></h2>";
                                }
                            echo " 
                            </span>
                            <span class='card-line'>
                            <table id='details' class='data small'>
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Cant</th>
                                    <th>Select<input type='checkbox' /></th>
                                </tr>
                            </thead> <tbody>";
                            $totalCant=0;$contValidador=0;
                            $tam = sizeof($aInferiorTarjeta,0);
                            for ($h=0; $h < $tam ; $h++) { 

                                if($contValidador<5)
                                {
                                    if ($aSuperiorTarjeta[$i][6] == $aInferiorTarjeta[$h][0] ) {
                                        if($aInferiorTarjeta[$h][3]==1)
                                        {
                                            echo "
                                            <tr>
                                            <td>".$aInferiorTarjeta[$h][1]."</td>
                                            <td >";

                                            for ($k=0; $k < sizeof($aInventario,0); $k++) 
                                            { 
                                                if($aInferiorTarjeta[$h][1] == $aInventario[$k][0])
                                                {
                                                    echo $aInventario[$k][1];
                                                }
                                            }
                                            $totalCant += $aInferiorTarjeta[$h][2];
                                            echo"</td>
                                            <td class='income'>".$aInferiorTarjeta[$h][2]."</td>
                                            <td ><input type='checkbox'/></td>
                                            </tr>";
                                            $contValidador++;
                                        }
                                    }
                                    
                                }
                            }

                            $contValidador = 5 - $contValidador;

                            for ($h=0; $h < $contValidador; $h++) { 
                                echo "<tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class='income'>-</td>
                                        <td>-</td>
                                    </tr>";
                            }

                                echo "</tbody>
                                <tfoot>
                                    <tr class='totals'>
                                        <td>TOTAL</td>
                                        <td></td>
                                        <td class='income'>".$totalCant."</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </span>

                        <span class='card-actions'>
                            <a href='index.php?accion=edit&codigo=".$aSuperiorTarjeta[$i][6]."&pg=".$page."'>
                                <i class='fas fa-edit action big edit'></i>
                            </a>

                            <a href='index.php?accion=ver&codigo=".$aSuperiorTarjeta[$i][6]."&pg=".$page."'>
                                <i class='fas fa-eye action big view'></i>
                            </a>
                        </span>   
                    </div>"; 
                        
                }
                
                for($i=0; $i<$num_paginador;$i++){
                    echo '<a name="paginador" href="index.php?accion=pagina&pg='.($i+1).'">'.($i+1).'</a> | ';
                }
            echo "</div>
            </div>
        </main>
    </body>
</html>";
                
  }
  public static function cabecera($nombre, $rol){
    echo "<!DOCTYPE html>
    <html lang='es-CO'>
        <head>
            <meta http-equiv='content-type' content='text/html; charset=UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0'>

            <title>Lista</title>
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css' integrity='sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns' crossorigin='anonymous'>

            <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>

        </head>

        <body id='myPage'>

             <header>
            <span id='crumbs'>
                <a id='home' href='index.php' title='Go to start page'>
                    <i class='fas fa-list logo'></i> SERVILAB
                </a>
            </span>

            <span id='info'>
                <!--<a id='notifications'> <i class='fas fa-bell action notifications'>25</i> </a>-->
                <a>
                    <span id='user'>$nombre</span>
                    <span id='role'>$rol</span>
                </a>

                <a href='index.php?accion=logout'><i class='fas fa-sign-out-alt action logout'></i></a>
            </span>
        </header>

            <nav>
                <span class='menu-toggle'><i class='fas fa-bars' title='Toggle menu'></i></span>
                <div class='menu-items'>
                    <a class='menu-item' href='index.php' title=''>
                        <i class='fas fa-th-list'></i>
                        Prestamos
                    </a>

                    <a class='menu-item' href='index.php?accion=nuevoPrestamo' title=''>
                        <i class='fas fa-plus'></i>
                        Nuevo Prestamo
                    </a>

                    <a class='menu-item' href='index.php?accion=inventario' title=''>
                        <i class='fas fa-boxes'></i>
                        Inventario
                    </a>
                    <a class='menu-item' href='index.php?accion=nuevoEquipo' title=''>
                        <i class='fas fa-plus'></i>
                        Nuevo Inventario
                    </a>
                    <a class='menu-item' href='index.php?accion=planeacion' title=''>
                        <i class='fas fa-calendar'></i>
                        Planeación
                    </a>
                    <a class='menu-item' href='index.php?accion=nuevaAdministracion' title=''>
                        <i class='fas fa-plus'></i>
                        Nueva Planeación
                    </a>
                    <a class='menu-item' href='index.php?accion=monitores' title=''>
                        <i class='fas fa-user-edit'></i>
                        Monitores
                    </a>
                    <a class='menu-item' href='index.php?accion=nuevoHorarioMonitor' title=''>
                        <i class='fas fa-plus'></i>
                        Nuevo Monitores
                    </a>
                </div>
            </nav>";
  }
}
?>