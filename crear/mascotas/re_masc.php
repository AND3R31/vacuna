<?php
require_once("../../base_datos/base_datos.php");
$daba = new database();
$con = $daba ->conectar();
session_start();

$fecha=date("Y-m-d");

$mes = strtotime("3 months");
$ff = date("Y-d-m", $mes);
?>

<?php
if ((isset($_POST["aceptar"])) && ($_POST["aceptar"] == "formulario")) {

    $docu_d=$_POST['mas'];
    $nom_mascota=$_POST['mascota'];
    $ti_mascota=$_POST['ti_mascota'];
    $enfermero=$_POST['enf'];
    $vacuna=$_POST['vac'];
    ;

    $consu=$con->prepare("SELECT * FROM mascotas WHERE dueño = '$docu_d'");
    $consu->execute();
    $ress=$consu->fetch();

    if($docu_d==""||$nom_mascota==""||$ti_mascota=="" ||$enfermero==""||$vacuna=="" ){

        echo'<script>alert("Existen datos vacios, cambielos")</script>';
        echo'<script>window.location="mascotas.php"</script>';
    }else if($ress){
        echo'<script>alert("Existen datos vacios, cambielos")</script>';
        echo'<script>window.location="mascotas.php"</script>';
    }else{
        $agre=$con->prepare("INSERT INTO mascotas (dueño, nom_mascota, tipo_masc, enfermero, vacuna) VALUES ('$docu_d', '$nom_mascota', '$ti_mascota', '$enfermero', '$vacuna')");
        $agre->execute();

        $actua=$con->prepare("INSERT INTO det_vacuna (id_mascota. id_enfermero, id_vacuna, fecha_vac, exp_vac) VALUES ('$mascota', '$enfermero', '$vacuna', '$fecha', '$ff')");
        $actua->execute();
        $actualizar1=$actua->fetch();

        echo'<script>alert("datos guardados")</script>';
        echo'<script>window.location="../../index.html"</script>';
    }
}else{
    echo'<script>alert("No se pudo hacer el registro")</script>';
    // echo'<script>window.location="../../index.html"</script>';
}
?>

