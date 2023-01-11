<?php
class Controlador {

    public function __construct() {
        include_once("modelo/login.php");
        include_once("modelo/list.php");


        include_once("vista/login.php");
        include_once("vista/list.php");
        include_once("vista/newLoan.php");
        include_once("vista/editLoan.php");

        include_once("vista/inventory.php");
        include_once("vista/newEquipment.php");
        include_once("vista/editEquipment.php");
        include_once("vista/eye.php");
        include_once("vista/eyeEquipment.php");

        include_once("vista/editIncidents.php");
        include_once("vista/newIncidents.php");
        include_once("vista/eyeIncidents.php");

        
        include_once("vista/tablePlaneation.php");
        include_once("vista/newPlaneation.php");
        include_once("vista/editPlaneation.php");
        include_once("vista/eyePlaneation.php");
        
        
        include_once("vista/tableMonitor.php");
        include_once("vista/newMonitor.php");
        include_once("vista/editMonitor.php");
        include_once("vista/eyeMonitor.php");

        if (!isset($_SESSION['appname']['authorized'])) {
            //Si se solicita un inicio de sesion
            if (isset($_POST['user']) && isset($_POST['pass'])) {
                //Validar el inicio de sesion
                ModeloLogin::login($_POST['user'], $_POST['pass']);
                //Inicia el index
                header("Location: index.php");
            }
            else {
                //Cargar la pagina de login
                VistaLogin::login();
            }
        }
        else {
            $accion = isset($_GET['accion']) ? $_GET['accion'] : null;

            VistaLista::cabecera($_SESSION['appname']['nombre'], $_SESSION['appname']['tipo']);

            if ($accion == 'logout') {
                ModeloLogin::logout();
                header("Location: index.php");
            }

            if ($accion==null) {
                VistaLista::lista(1);
            }
///////////////////////////////////ESTAS SON LAS ACCIONES DEL PRESTAMOS
            if ($accion =='pagina') {
                $pg=$_GET["pg"];
                VistaLista::lista($pg);
            }
            if ($accion =='crear') {
                if (isset($_POST['fecha']) && isset($_POST['codigo'])) {
                    //print_r($_POST);
                    ModeloList::Nuevo_prestamo($_POST['fecha'],$_POST['codigo'],$_SESSION['appname']['id_usuarios'],$_POST['rol1'],$_POST['rol2'],$_POST['rol3'],$_POST['rol4'],$_POST['rol5'],$_POST['username1'],$_POST['username2'],$_POST['username3'],$_POST['username4'],$_POST['username5']);
                }
                header("Location: index.php");
            }
            if ($accion =='nuevoPrestamo') {
                   VistaLoan::loan($_SESSION['appname']['id_usuarios'], $_SESSION['appname']['tipo'],null);
            }
            if($accion=="ver"){
                $pg=$_GET["pg"];
                $id=$_GET["codigo"];
                VistaEye::eye($id,$pg);
            }

            if($accion=="edit")
            {
                $pg=$_GET["pg"];
                $id=$_GET["codigo"];
                VistaEditLoan::editloan($_SESSION['appname']['id_usuarios'], $_SESSION['appname']['tipo'],$id,$pg);
            }

            if($accion=="editarEquipo"){
                $id=$_GET["id"];
                $pg=$_GET["pg"];
                    //print_r($_POST);
                    ModeloList::Modificar_prestamo($id,$_POST['id_elementos'],$_POST['fechaD'],$_POST['codigoR'],$pg);
                    
                header("Location: index.php");
            }

            if ($accion=="filtroPretamo") {
                print_r($_POST);
                
            }

///////////////////////////////////ESTAS SON LAS ACCIONES DEL INVENTARIO
            if($accion=="inventario"){
                VistaInventory::inventory();
            }

            if($accion=="nuevoEquipo"){
                VistaEquipment::equipment();
            }
            if($accion=="guardar_equipo"){
                if (isset($_POST['codigo'])) {
                    //print_r($_POST);
                    ModeloInventory::Insertar_Inventario($_POST['codigo'],$_POST['descripcion'],$_POST['marca'],$_POST['modelo'],$_POST['serie'],$_POST['cc_responsable'],$_POST['nombre_responsable'],$_POST['rol_garantia'],$_POST['observaciones'],$_POST['fecha_alta'],$_POST['rol_categoria']);
                }
                VistaInventory::inventory();
            }
            if($accion=="tabla_incidencia"){
                $codigo=$_GET["codigo"];
                VistaNewIncidents::newincidents($codigo);
            }


            if($accion=="editar_inventario"){
                $id=$_GET["id"];
                VistaEditEquipment::editequipment($id);
            }

            if($accion=="modificar_equipo"){
                if (isset($_POST['codigo'])) {
                    //print_r($_POST);
                    ModeloInventory::Modificar_Inventario($_POST['codigo'],$_POST['descripcion'],$_POST['marca'],$_POST['modelo'],$_POST['serie'],$_POST['cc_responsable'],$_POST['nombre_responsable'],$_POST['rol_garantia'],$_POST['observaciones'],$_POST['fecha_alta'],$_POST['fecha_baja'],$_POST['rol_categoria'],$_POST['estado']);
                }
                VistaInventory::inventory();
            }

            if($accion=="ver_equipo"){
                $id=$_GET["id"];
                VistaEyeEquipment::eyequipment($id);
            }

            if($accion=="prestar_equipo"){
                $id=$_GET["codigo"];
                VistaLoan::loan($_SESSION['appname']['id_usuarios'], $_SESSION['appname']['tipo'],$id);
            }
///////////////////////////////////ESTAS SON LAS ACCIONES DE TABLA INCIDENCIAS
            if($accion=="editar_tablaincidencia"){
                $id=$_GET["id"];
                VistaEditIncidents::editincidents($id);
            }
            if($accion=="crear_incidencia"){
                $id=$_GET["id"];
                if (isset($_POST['codigo'])) {
                ModeloInventory::Insertar_Incidencias($_POST['codigo'],$_POST['fecha'],$_POST['reporto'],$_POST['observaciones'],$_POST['soporte']);
                }
                VistaInventory::inventory();
            }
            if($accion=="modificar_incidencia"){
                if (isset($_POST['codigo'])) {
                ModeloInventory::Modificar_Incidencias($_POST['observaciones'],$_POST['soporte'],$_POST['id']);
                }
                 VistaInventory::inventory();
                
            }
            if($accion=="ver_tablaincidencia"){
                $id=$_GET["id"];
                VistaEyeIncidents::eyeincidents($id);
            }
//////////////////////////////////////ESTAS SON LAS ACCIONES DE PLANEACION

            if ($accion=="planeacion") {
                VistaTablePlaneation::tablePlaneation();
            }
            
            if ($accion=="nuevaAdministracion") {
                VistaPlaneation::planeation();
            }
            if ($accion=="guardar_administracion") {
                if (isset($_POST['actividad'])) {
                    //print_r($_POST);
                    ModeloAdministration::Consulta_GuardarPlaneacion($_POST['actividad'],$_POST['fecha'],$_POST['dia'],$_POST['asignatura'],$_POST['encargado'],$_POST['observaciones'],$_POST['aprobado'],$_POST['hora_inicio'],$_POST['hora_fin']);
                }
                VistaTablePlaneation::tablePlaneation();
            }
            if ($accion=="modificar_administracion") {
                if (isset($_POST['actividad'])) {
                    $id=$_GET["id"];
                    //print_r($_POST);
                    ModeloAdministration::Consulta_ModificarPlaneacion($id,$_POST['actividad'],$_POST['fecha'],$_POST['dia'],$_POST['asignatura'],$_POST['encargado'],$_POST['observaciones'],$_POST['aprobado'],$_POST['hora_inicio'],$_POST['hora_fin'],$_POST['estado']);
                }
                VistaTablePlaneation::tablePlaneation();
            }
            if ($accion=="editar_administracion") {
                $id=$_GET["id"];
                VistaEditPlaneation::editplaneation($id);
            }
            if ($accion=="ver_administracion") {
                $id=$_GET["id"];
                VistaEyePlaneation::eyeplaneation($id);
            }
/////////////////////////////////ESTAS SON LAS ACCIONES DE MONITOR          
            if ($accion=="monitores") {
                VistaTableMonitor::tableMonitor();
            }
            if ($accion=="nuevoHorarioMonitor") {
                VistaMonitor::monitor();
            }
            if ($accion=="guardar_monitor") {
                if (isset($_POST['actividad'])) {
                    //print_r($_POST);
                    ModeloAdministration::Consulta_Guardar_Horario_Monitor($_POST['monitor'],$_POST['fecha'],$_POST['hora_inicio'],$_POST['hora_fin'],$_POST['actividad']);
                }
                VistaTableMonitor::tableMonitor();
            }
            if ($accion=="editar_monitor") {
                $id=$_GET["id"];
                VistaEditMonitor::editmonitor($id);
            }
            if ($accion=="modificar_monitor") {
                $id=$_GET["id"];
                if (isset($_POST['fecha'])) {
                    //print_r($_POST);
                    ModeloAdministration::Consulta_Modificar_Horario_Monitor($id,$_POST['monitor'],$_POST['fecha'],$_POST['hora_inicio'],$_POST['hora_fin'],$_POST['actividad'],$_POST['estado']);
                }
                VistaTableMonitor::tableMonitor();
            }
            if ($accion=="ver_monitor") {
                $id=$_GET["id"];
                VistaEyeMonitor::eyemonitor($id);
            }
                      
        }
        
    }
}
?>
