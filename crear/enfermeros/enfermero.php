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
        $mas=$_POST['mas'];


        if($docu==""||$name_en==""||$edad==""||$mas==""){

            echo'<script>alert("Existen datos vacios, cambielos")</script>';
            echo'<script>window.location"enfermero.php"</script>';
        }else if($res){
            echo'<script>alert("Existen datos vacios, cambielos")</script>';
            echo'<script>window.location"enfermero.php"</script>';
        }else{
            $agre=$con->prepare("INSERT INTO enfermeros (doc, nombre, edad, rol) VALUES ('$docu', '$name_en', '$edad', '$mas')");
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

                <h2>Crear mascota</h2>              
                <div>
                    <label>Seleccione la mascota </label><br>
                    <select name="mas" id="mas">
                    <option>Seleccione la mascota</option>
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