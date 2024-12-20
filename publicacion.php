<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="icon" href="./imagenes/logo.png" type="image/png">
    <title>Laburapp</title>
    <meta name="description" content="Trabajos y emprendimientos">
    <meta name="keywords" content="Trabajo, empleo, rubro, emprendimiento, laburo">
</head>
<body>
    <div class="centrar">
        <div class="cuadro-ver-publicacion">
            <?php
            session_name("LOGIN");
            session_start();
            include('conexion.php');
            

            if (isset($_GET['id_publicacion'])) {
                include("conexion.php");
                $id = $_GET['id_publicacion'];
                $sql = "SELECT * from publicaciones where id_publicaciones='$id'";
                $resultado = mysqli_query($conexion, $sql);
                $fila = mysqli_fetch_assoc($resultado);
                $id_usuario = $fila['id_usuario'];
                $buscar_usuario = "SELECT * from usuarios where id_usuario='$id_usuario'";
                $resultado2 = mysqli_query($conexion, $buscar_usuario);
                $fila_usuario = mysqli_fetch_assoc($resultado2);
                echo "<h1>" . $fila['nombre_publicacion'] . "</h1>";
                echo "<div class='seccion'> 
                    <p>" . $fila['descripcion'] . "</p>
                    <div class='foto-portada-en-publicacion'><img class='foto-portada-en-publicacion' src='" . $fila['foto_portada'] . "' width='500vh'></div>
                    <h4>Publicado el: " . $fila['fecha'] . ".</h4>";
                if (isset($_SESSION['id_usuario'])) {
                    if ($fila_usuario['id_usuario'] == $_SESSION['id_usuario']) {
                        echo "<a href='perfil.php'>
                        <h4>Por: " . $fila_usuario['nombre'] . " " . $fila_usuario['apellido'] . ".</h4></a>
                        </div>";
                    } else {
                        echo "<a href='mostrar-perfil.php?id_usuario=" . $id_usuario . "'>
                        <h4>Por: " . $fila_usuario['nombre'] . " " . $fila_usuario['apellido'] . ".</h4></a>";
                        $sql="SELECT * from solicitudes where id_usuario='".$_SESSION['id_usuario']."' and id_publicaciones='$id'";
                        $solicitudes=mysqli_query($conexion, $sql);
                        if (mysqli_num_rows($solicitudes)==0){echo "<a href='solicitar.php?id_publicacion=" . $id . "' class='boton'>
                            <h4>Solicitar</h4>
                            </a>
                            </div>
                            </div>";}
                        else{
                            echo "<input type='button' class='boton-disabled' value='Solicitado'>";
                        }
                    }
                } else {
                    echo "<a href='mostrar-perfil.php?id_usuario=" . $id_usuario . "'>
                    <h4>Por: " . $fila_usuario['nombre'] . " " . $fila_usuario['apellido'] . ".</h4></a>
                    <a href='login.html'><h3>¡Inicie sesion para solicitar trabajos!</h3></a>
                    </a>
                    </div>
                    </div>";
                }
            } else {
                echo "<h1> ERROR INESPERADO </h1>";
            }

            $value = $_GET['value'];
            if ($value == 1) {
                echo "<input type='button' class='boton' value='volver' onclick='location=\"publicaciones.php\"'>";
            } else if ($value == 2) {
                $busq = $_GET['busq'];
                echo "<form action='barra-buscador.php' method='get'>";
                echo "<input type='hidden' value='" . $busq . "' name='busq'>";
                echo "<input type='hidden' value='Enviar' name='Enviar'>";
                echo "<input type='submit' class='boton' value='volver'>";
                echo "</form>";
            } else if ($value == 3) {
                echo "<input type='button' class='boton' value='volver' onclick='location=\"index.php\"'>";
            } else if ($value == 4) {
                echo "<form action='mostrar-perfil.php' method='get'>";
                echo "<input type='hidden' value='" . $id_usuario . "' name='id_usuario'>";
                echo "<input type='hidden' value='Enviar' name='Enviar'>";
                echo "<input type='submit' class='boton' value='volver'>";
                echo "</form>";
            } else if ($value == 5) {
                echo "<input type='button' class='boton' value='volver' onclick='location=\"perfil.php\"'>";
            } else if ($value == 6) {
                echo "<input type='button' class='boton' value='volver' onclick='location=\"solicitudes.php\"'>";
            }
            ?>
        </div>
    </div>
</body>
</html>
