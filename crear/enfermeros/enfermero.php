<?php
require_once("../../base_datos/base_datos.php");
$daba = new database();
$con = $daba ->conectar();
session_start();
?>

<?php
    if ((isset($_POST["enviar"])) && ($_POST["enviar"] == "formu")) {

        $docu=$_POST['doc_enfermero'];
        $name_en=$_POST['n_enfermero'];
        $edad=$_POST['edad'];
        $vacuna=$_POST['vacuna'];
        $tip_mascota=$_POST['tip_mascota'];

        $consu=$con->prepare("SELECT * FROM mascotas WHERE doc = '$docu'");
        $consu->execute();
        $res=$consu->fetch();

        if($docu==""||$name_en==""||$edad==""||$vacuna==""||$tip_mascota==""){

            echo'<script>alert("Existen datos vacios, cambielos")</script>';
            echo'<script>window.location"enfermero.php"</script>';
        }else if($res){
            echo'<script>alert("Existen datos vacios, cambielos")</script>';
            echo'<script>window.location"enfermero.php"</script>';
        }else{
            $agre=$con->prepare("INSERT INTO enfermeros (doc, nombre, edad, vacuna, tip_mascota) VALUES ('$docu', '$name_en', '$edad', '$vacuna', '$tip_mascota')");
            $agre->execute();

            echo'<script>alert("datos guardados")</script>';
            echo'<script>window.location"../../index.php"</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de enfermeros</title>
</head>
<body>
    <div>
        <div>
            <form method="POST" id="formu" name="formu">
                <h2>Crear enfermero</h2>              
                <div>
                    <label>Documento del enfermero </label>
                    <input type="number" id="doc_enfermero" name="doc_enfermero" placeholder="Documento del enfermero" >
                </div>

                <div>
                    <label>Nombre del enfermero </label>
                    <input type="text" id="n_enfermero" name="n_enfermero" placeholder="Nombre del enfermero">
                </div>

                <div>
                    <label>Edad </label>
                    <input type="number" id="edad" name="edad" placeholder="Ingrese su Edad" >
                </div>

                <div>
                    <label>Nombre de vacuna</label>
                    <input type="text" id="vacuna" name="vacuna" placeholder="Ingrese la vacuna a aplicar" >
                </div>

                <div>
                    <label>Tipo de mascota</label>
                    <input type="text" id="tip_mascota" name="tip_mascota">
                </div>

                <input type="submit">    
                <input type="hidden" name="enviar" id="enviar" value="formu">

            </form>
            <a href="../../index.html">regresar</a>
    </div>
</body>
</html>