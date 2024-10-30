<?php

include("conexion.php");

$user = $_POST["nombre"];
$apellido = $_POST['apellido'];
$pass = $_POST["pass"];
$mail = $_POST["mail"];
$telefono = $_POST["telefono"];

$consulta = "SELECT * FROM usuarios WHERE mail='$mail'";
$resultado = mysqli_query($conexion, $consulta);
$cantfilas = mysqli_num_rows($resultado);
if ($cantfilas == 1) {
    echo "<h3> El usuario ya se encuentra registrado. </h3>";
    echo "<input type='button' value='Volver' onClick='location=\"index.php\"'> ";
} else {



    $imagen=$_FILES['imagen']['tmp_name'];
    $nombreImg=$_FILES['imagen']['name'];
    $extImg=strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));
    $sizeImg=$_FILES['imagen']['size'];
    $dir="imagenes/fotos_perfiles/";
    $id= "-".$user."-".$apellido;
    if($extImg=='jpg' or $extImg=='jpeg'){
        
        $registro=$conexion->query("SELECT * from usuarios where id_usuario='$id' ");
        $fila= mysqli_fetch_assoc($registro);
        $id2="-".$user."-".$apellido;
        $ruta=$dir.$id2.".".$extImg;
        $sql = "INSERT INTO usuarios (nombre, apellido, contraseña, mail, telefono, foto_perfil) VALUES ('$user', '$apellido', '$pass', '$mail', '$telefono', '$ruta' )";
        mysqli_query($conexion, $sql);
        echo "registrado con éxito.";
        echo "<br> <br>";
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
            $_SESSION['info-foto-perfil']=$fila['foto_perfil'];
            $_SESSION['contador-fotoperfil']=1;
            echo "<input type='button' value='Volver' onClick='location=\"index.php\"'> ";}
        if (move_uploaded_file($imagen,$ruta)){
            
        }
        $_SESSION['info-foto-perfil']=$ruta;
        header('Cache-Control: no-store, no-cache, must-revalidate');
        mysqli_close($conexion);
    } else { 
        echo"No se admite ese tipo de archivos, solo jpg o jpeg";}
        
    
    }