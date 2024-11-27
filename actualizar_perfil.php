<?php

    session_name("LOGIN");
    session_start();

    include("conexion.php");
    $id_usuario = $_POST["id_usuario"];
    $mail = $_POST["mail"];
    $domicilio = $_POST["domicilio"];
    $pass = $_POST["pass"];
    $telefono = $_POST["telefono"];
    $informacion = $_POST["informacion"];

    $sql = "UPDATE usuarios SET mail = '$mail', domicilio = '$domicilio', contraseña = '$pass', telefono = $telefono, informacion = '$informacion' WHERE id_usuario = $id_usuario";

    
    if (mysqli_query($conexion, $sql )){
        if (mysqli_affected_rows($conexion) > 0) {
            echo "<br> <br> <br> <br> <h3> Se modificaron los datos del perfil ...</h3>";
        } else { echo " <br><br><br><br><h3> No se modificaron los datos del perfil... </h3>"; }
    } else {echo " <br><br><br><br><h3> Error en la modificación... </h3>"; }

    echo "<br>";
    
    echo "<input class='boton' type='button' value='Volver' onClick='location=\"perfil.php\"'> ";