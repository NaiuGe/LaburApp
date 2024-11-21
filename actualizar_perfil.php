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
            echo '<script>';
            echo 'alert ("Se modificaron los datos del perfil");';
            echo 'window.location.href = "perfil.php";';
            echo '</script>';
        } else { 
            echo '<script>';
            echo 'alert ("No se modificaron los datos del perfil");';
            echo 'window.location.href = "info_perfil.php";';
            echo '</script>';
        }
    }else { 
        echo '<script>';
        echo 'alert ("Error al modificar.");';
        echo 'window.location.href = "info_perfil.php";';
        echo '</script>';
    }
    
    ?>
    <html>
        <body>
            <script src="script.js"></script>
        </body>
    </html> 