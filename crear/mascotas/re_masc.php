<?php
require_once("../../base_datos/base_datos.php");
$daba = new database();
$con = $daba ->conectar();
session_start();


$fecha=date("Y-m-d");

$mes = strtotime("3 months");
$ff = date("Y-d-m", $mes);

$consultaa=$con->prepare("SELECT * FROM roles");
    $consultaa->execute();
    $conn=$consultaa->fetch();
?>

<?php
if ((isset($_POST["aceptar"])) && ($_POST["aceptar"] == "formulario")) {

    $docu_d=$_POST['doc_dueño'];
    $name_du=$_POST['dueño'];
    $edad=$_POST['edad'];
    $nom_mascota=$_POST['mascota'];
    $ti_mascota=$_POST['ti_mascota'];

    // echo $docu_d;
    // echo $name_du;
    // echo $edad;
    // echo $nom_mascota;
    // echo $ti_mascota;

    $consu=$con->prepare("SELECT * FROM mascotas WHERE doc = '$docu_d'");
    $consu->execute();
    $ress=$consu->fetch();

    if($docu_d==""||$name_du==""||$edad==""||$nom_mascota==""||$ti_mascota==""){

        echo'<script>alert("Existen datos vacios, cambielos")</script>';
        echo'<script>window.location="enfermero.php"</script>';
    }else if($ress){
        echo'<script>alert("Existen datos vacios, cambielos")</script>';
        echo'<script>window.location="enfermero.php"</script>';
    }else{
        $agre=$con->prepare("INSERT INTO mascotas (doc, dueño, edad, nom_mascota, tipo_masc, fecha_vac, exp_vac) VALUES ('$docu_d', '$name_du', '$edad', '$nom_mascota', '$ti_mascota', '$fecha', '$ff')");
        $agre->execute();

        echo'<script>alert("datos guardados")</script>';
        echo'<script>window.location="../../index.html"</script>';
    }
}else{
    echo'<script>alert("No se pudo hacer el registro")</script>';
    echo'<script>window.location="../../index.html"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regfistro de mascotas</title>
</head>
<body>
    <div>
        <div>
            <form method="post" name="formulario">

                
                <h2>Crear mascota</h2>              
                <div>
                    <label>Documento del dueño </label>
                    <input type="number" id="doc_dueño" name="doc_dueño" placeholder="Documento del dueño" >
                </div>

                <div>
                    <label>Nombre del dueño </label>
                    <input type="text" id="dueño" name="dueño" placeholder="Nombre del dueño" >
                </div>

                <div>
                    <label>Edad </label>
                    <input type="number" id="edad" name="edad" placeholder="Ingrese su Edad" >
                </div>

                <div>
                    <label>Nombre de la mascota</label>
                    <input type="text" id="mascota" name="mascota" placeholder="Ingrese el nombre de la mascota" >
                </div>

                <div>
                    <label>Tipo de mascota</label>
                    <input type="text" id="ti_mascota" name="ti_mascota" placeholder="Ingrese el tipo de mascota que usted tiene">
                </div>

                <input type="submit">
                <input type="hidden" id="aceptar" name="aceptar" value="formulario">

                
            </form>

            <a href="../../index.html">regresar</a>
            
    </div>
</body>
</html>