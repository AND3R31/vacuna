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
    $consultaa=$con->prepare("SELECT * FROM mascotas");
    $consultaa->execute();
    $conn=$consultaa->fetch();

    $con_enfer=$con->prepare("SELECT * FROM enfermeros WHERE rol = 2");
    $con_enfer->execute();
    $con_e=$con_enfer->fetch();

    $con1_enfer=$con->prepare("SELECT * FROM vacunas");
    $con1_enfer->execute();
    $con1_e=$con1_enfer->fetch();
?>


<?php

if ((isset($_POST["boton"])) && ($_POST["boton"] == "fo")) {

    $mascota=$_POST['mas'];
    $enfermero=$_POST['enf'];
    $vacuna=$_POST['vac'];

    $vali=$con->prepare("SELECT * FROM mascotas WHERE doc='$mascota' ");
    $vali->execute();
    $validar=$vali->fetch();

    if($mascota==""||$enfermero==""||$vacuna==""){

        echo'<script>alert("Existen datos vacios, cambielos")</script>';
        echo'<script>window.location"vacunas.php"</script>';

    } else if($validar){

        $actu=$con->prepare("UPDATE mascotas SET vacuna = '$vacuna', enfermero = '$enfermero' WHERE doc = '$mascota' ");
        $actu->execute();   
        $actualizar=$actu->fetch();

        $ing = $con->prepare("INSERT INTO det_vacuna (id_mascota, id_enfermero, id_vacuna, fecha_vac, exp_vac) VALUES ('$mascota', '$enfermero', '$vacuna', '$fecha', '$ff')");
        $ing->execute();   
        $a=$ing->fetch();



        // echo'<script>alert("Se actualizo correctamente los datos de la vacuna")</script>';
        

    }else{
        $actua=$con->prepare("UPDATE mascotas SET vacuna = '$vacuna', enfermero = '$enfermero' WHERE doc = '$mascota' ");
        $actua->execute();
        $actualizar1=$actua->fetch();

        $inge=$con->prepare("INSERT INTO det_vacuna (id_mascota, id_enfermero, id_vacuna, fecha_vac, exp_vac) VALUES '$mascota', '$enfermero','$vacuna', '$fecha','$ff'");
        $inge->execute();   
        $b=$inge->fetch();

        



        echo'<script>alert("Se registro correctamente la vacunacion del usuario" <?php echo $mascota ?>)</script>';
        echo'<script>window.location"../../index.html"</script>';
    }



}else{
    echo'<script>alert("no se pudo hacer el registro de las vacunas")</script>';
    echo'<script>window.location"vacunas.php"</script>';
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
            <form method="post" name="fo">
                <h2>Crear mascota</h2>              
                <div>
                    <label>Seleccione la mascota </label><br>
                    <select name="mas" id="mas">
                    <option>Seleccione la mascota</option>
                    <?php
                    do {
                    ?>
                    <option value="<?php echo ($conn['doc']) ?>"> <?php echo ($conn['nom_mascota']) ?> </option> 
                    <?php
                    } while ($conn = $consultaa->fetch());
                    ?>
                    </select>
                </div><br>

                <div>
                    <label>Seleccione el enfermero asigando</label><br>
                    <select name="enf" id="enf">
                    <option>Seleccione el enfermero</option>
                    <?php
                    do {
                    ?>
                    <option value="<?php echo ($con_e['doc']) ?>"> <?php echo ($con_e['nombre']) ?></option> 
                    <?php
                    } while ($con_e = $con_enfer->fetch());
                    ?>
                    </select>
                </div>

                <div>
                    <label>Seleccione el enfermero asigando</label><br>
                    <select name="vac" id="vac">
                    <option>Seleccione la vacuna</option>
                    <?php
                    do {
                    ?>
                    <option value="<?php echo ($con1_e['id']) ?>"><?php echo ($con1_e['nombre']) ?> </option> 
                    <?php
                    } while ($con1_e = $con1_enfer->fetch());
                    ?>
                    </select>
                </div>

                <input type="submit">
                <input type="hidden" name="boton" id="boton" value="fo">

            </form>
            <a href="../../index.html"> regresar</a>
            
    </div>
</body>
</html>

