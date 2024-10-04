<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Perfil de usuario </title>
</head>
<body>

    <div class="barra-arriba">
            <?php
                session_name("LOGIN");
                session_start();

                include ("conexion.php");
                if (isset($_SESSION['contador'])){
                    
                    $consulta = "SELECT * FROM usuarios, publicaciones;"; 
                
                    $resultado= mysqli_query($conexion, $consulta);
                    $cantfilas= mysqli_num_rows($resultado);
                    echo '<br></br>';
                        echo '<div class="barra-arriba"> <h2>'. $_SESSION['nombre'].' '. $_SESSION['apellido'] .'</h2></div>';
                        echo "";
                        echo '<br></br>';
                } else {
                    echo "No tenes una cuenta ingresada. Inicia Sesión e intentalo de nuevo.";
                    echo '<br><input type="button" value="Iniciar sesion" onclick="location=\'login.html\'">';
                }
                
            ?>
        <div>
            <img src="imagenes/icono_usuario.png" id="fotoperfil">
        </div>
        
    </div>
    <div class="central">
        <h3>Trabajos Disponibles</h3>
        <div class="opciones">
            <div class="caja">
                <p>Desarrollador WEB</p>
                <div id="imagen">
                    <a href="" class="link">
                        <img src="imagenes/icono_trabajo.png" id="fotopubli">
                    </a>
                </div>
                
                <input type="button" type="submit" value="Ver publicación">
            </div>
            <div class="caja">
                <p>Desarrollador Back-end</p>
                <div id="imagen">
                    <a href="" class="link">
                        <img src="imagenes/icono_trabajo.png" id="fotopubli">
                    </a>
                </div>
                
                <input type="button" type="submit" value="Ver publicación">
            </div>
            
        </div>
    </div>


</body>
</html>