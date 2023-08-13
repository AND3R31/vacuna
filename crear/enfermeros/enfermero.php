<?php
require_once("../../base_datos/base_datos.php");
$daba = new database();
$con = $daba ->conectar();
session_start();



$consultaa=$con->prepare("SELECT * FROM roles");
    $consultaa->execute();
    $conn=$consultaa->fetch();

    
?>

<?php
    if ((isset($_POST["enviar"])) && ($_POST["enviar"] == "formu")) {

        $docu=$_POST['doc_enfermero'];
        $name_en=$_POST['n_enfermero'];
        $edad=$_POST['edad'];
        $mas=$_POST['mas'];


        $caa=$con->prepare("SELECT * FROM enfermeros WHERE doc_d='$docu'");
        $caa->execute();
        $res=$caa->fetch();


        if($docu==""||$name_en==""||$edad==""||$mas==""){

            echo'<script>alert("Existen datos vacios, cambielos")</script>';
            echo'<script>window.location"enfermero.php"</script>';
        }else if($res){
            echo'<script>alert("Existen datos que ya han sido registrados, cambielos")</script>';
            echo'<script>window.location"enfermero.php"</script>';
        }else{
            $agre=$con->prepare("INSERT INTO enfermeros (doc_d, nombre_d, edad, rol) VALUES ('$docu', '$name_en', '$edad', '$mas')");
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
    <title>Registro de usuarios</title>
</head>
<body>
    <div>
        <div>
            <form method="POST" id="formu" name="formu">
                <h2>Crear usuario</h2>              
                <div>
                    <label>Documento del usuario </label>
                    <input type="number" id="doc_enfermero" name="doc_enfermero" placeholder="Documento del usuario" >
                </div>

                <div>
                    <label>Nombre del enfermero </label>
                    <input type="text" id="n_enfermero" name="n_enfermero" placeholder="Nombre del usuario">
                </div>

                <div>
                    <label>Edad </label>
                    <input type="number" id="edad" name="edad" placeholder="Ingrese su Edad" >
                </div>
              
                <div>
                    <label>Seleccione el tipo de rol </label><br>
                    <select name="mas" id="mas">
                    <option>Seleccione el rol</option>
                    <?php
                    do {
                    ?>
                    <option value="<?php echo ($conn['id']) ?>"> <?php echo ($conn['nombre']) ?> </option> 
                    <?php
                    } while ($conn = $consultaa->fetch());
                    ?>
                    </select>
                </div>

                <input type="submit">    
                <input type="hidden" name="enviar" id="enviar" value="formu">

            </form>
            <a href="../../index.html">regresar</a>
    </div>
</body>
</html>