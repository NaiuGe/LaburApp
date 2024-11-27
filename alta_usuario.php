<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        function DenegarFoto(){
            alert("No se admite ese tipo de archivos, solo jpg o jpeg");
            window.location.href="registro_usuario.php";
        }
    </script>
    

<?php

include("conexion.php");

$user = $_POST["nombre"];
$apellido = $_POST['apellido'];
$pass = $_POST["pass"];
$mail = $_POST["mail"];
$telefono = $_POST["telefono"];
$localidad = $_POST["localidad"];

$consulta = "SELECT * FROM usuarios WHERE mail='$mail'";
$resultado = mysqli_query($conexion, $consulta);
$cantfilas = mysqli_num_rows($resultado);
if ($cantfilas == 1) {
    echo '<script>';
    echo 'alert("El usuario ya se encuentra registrado.");';
    echo 'window.location.href = "registro_usuario.php";';
    echo '</script>';
} else {

    $imagen=$_FILES['imagen']['tmp_name'];
    /* ------Validación de imagen ------*/
    $nombreImg=$_FILES['imagen']['name'];
    $extImg=strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));
    $sizeImg=$_FILES['imagen']['size'];
    $dir="imagenes/fotos_perfiles/";
    $id= "-".$user."-".$apellido;
    if($extImg=='jpg' or $extImg=='jpeg'){
        
        $registro=$conexion->query("SELECT * from usuarios where id_usuario='$id' ");
        $fila= mysqli_fetch_assoc($registro);
        /*-------Variable duplicada------ */
        $id2="-".$user."-".$apellido;
        $ruta=$dir.$id2.".".$extImg;
    $sql = "INSERT INTO usuarios (nombre, apellido, contraseña, mail, telefono, id_localidad, foto_perfil) VALUES ('$user', '$apellido', '$pass', '$mail', '$telefono', '$localidad', '$ruta')";
    mysqli_query($conexion, $sql);
    if (move_uploaded_file($imagen,$ruta)){ //mueve el archivo hacia la ruta
                    
    }
    
    echo '<script>';
    echo 'alert("El usuario fue registrado con exito.");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
    
    $consulta = "SELECT * FROM usuarios WHERE mail='$mail' AND contraseña='$pass'";

    $resultado= mysqli_query($conexion, $consulta);

    $cantfilas= mysqli_num_rows($resultado);

    if ($cantfilas==1) {
        $fila = mysqli_fetch_assoc($resultado);
        session_name("LOGIN");
        session_start();
        $_SESSION['nombre']=$fila['nombre'];
        $_SESSION['apellido']=$fila['apellido'];
        $_SESSION['pass']=$fila['contraseña'];
        $_SESSION['contador']=1;
        $_SESSION['id_usuario']=$fila['id_usuario'];
        $_SESSION['info-foto-perfil']=$ruta;
        $_SESSION['contador-fotoperfil']=1;
        mysqli_close($conexion);
        echo "<input type='button' value='Volver' onClick='location=\"index.php\"'> ";}
        if (move_uploaded_file($imagen,$ruta)){
            
        }
        $_SESSION['info-foto-perfil']=$ruta;
        header('Cache-Control: no-store, no-cache, must-revalidate');
        mysqli_close($conexion);
    } else { 
        echo"<script>DenegarFoto()</script>";}
}

?>

<script src="script.js"></script> 
</body>
</html>