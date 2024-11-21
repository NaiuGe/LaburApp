<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="icon" href="imagenes/logo.png" type="image/png">
    <title>Edición de Perfil</title>
</head>
<script>
    // Función para mostrar la vista previa de la imagen seleccionada
    function previewImage(event) {
        const file = event.target.files[0];
        
        // Verificar si el archivo es una imagen
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Mostrar la imagen de vista previa
                const image = document.getElementById('imagenPreview');
                image.src = e.target.result;
                image.style.display = 'block'; // Mostrar la imagen
            };
            
            reader.readAsDataURL(file);
        } else {
            alert('Por favor selecciona un archivo de imagen');
        }
    }
</script>
<body>
    <div class='centrar'>
    <div class='mod-perfil'>
    <h2>Modificar Perfil </h2>
    <form method="post" action="info_perfil.php" enctype="multipart/form-data">
        
    <?php
    
    session_name("LOGIN");
    session_start();
    include ("conexion.php");
    $ruta='';
    $id_usuario = $_SESSION['id_usuario'];

    $consulta = "SELECT usuarios.* FROM usuarios WHERE usuarios.id_usuario = '$id_usuario';";

    $resultado = mysqli_query($conexion, $consulta);
    
    if ($row = mysqli_fetch_row($resultado)) {
        
        echo " <header class='texto-inicio-sesion'>
        <h1>Modificar Perfil</h1>
        </header>";

        echo " <div class='centrar'> <div class='cuadro-modificar-perfil'>"; //Inicio contenedor central y principal
        echo "<div class='contenedor-input'> <h3> Foto de Perfil </h3>";
        
        echo "<div class='contenedor-foto'>";
        if (!empty($_SESSION['contador-fotoperfil'] && $_SESSION['info-foto-perfil']!='')){
            echo "<img id='imagenPreview' src='" . $_SESSION['info-foto-perfil']  . "'>";
            echo '<form method="post" action="info_perfil.php" enctype="multipart/form-data">';
        header('Cache-Control: no-store, no-cache, must-revalidate');}
        else {
            echo "img id='imagenPreview' src='imagenes/icono_usuario.png' >";
            echo '<form method="post" action="info_perfil.php" enctype="multipart/form-data">';
        header('Cache-Control: no-store, no-cache, must-revalidate');
        }
        echo "</div>";
        echo "<form method='post' onsubmit='return verificar()' action='actualizar_perfil.php'>";
        echo '<input type="file" accept="imagen/*" name="imagen" onchange="previewImage(event)" width="50vh">';
        echo "<br>";
        echo "<input name='id_usuario' value='".$row[0]."'hidden>";
        echo "<h3>Nombre y Apellido</h3> <p>".$row[1]. " ".$row[2]."</p>";
        echo "<h3> Correo Electrónico </h3>";
        echo "<input type='text' name='mail' value='".$row[3]."'>";
        echo "<h3> Domicilio </h3>";
        echo "<input type='text' name='domicilio' value='".$row[4]."'>";
        echo "<h3> CONTRASEÑA </h3>";
        echo "<input type='text' name='pass' value='".$row[7]."'>";
        echo "<h3> Número de Telefono </h3>";
        echo "<input type='tel' name='telefono' value='".$row[8]."'>";
        echo "<h3> Descripción personal </h3>";
        echo "<input type='text' name='informacion' value='".$row[9]."'>";
        echo "<br><br>";
        echo '<input type="submit" value="Actualizar" class="boton" name="btnregistrar">';
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input class='boton' type='button' value='Cancelar' onClick='location=\"perfil.php\"'> ";
            //--- php de la foto ---
            if(!empty($_POST['btnregistrar'])){
            $imagen=$_FILES['imagen']['tmp_name'];
            $nombreImg=$_FILES['imagen']['name'];
            $extImg=strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));
            $sizeImg=$_FILES['imagen']['size'];
            $dir="imagenes/fotos_perfiles/";
            $id=$_SESSION['id_usuario'];
            if($extImg=='jpg' or $extImg=='jpeg'){
                
                $registro=$conexion->query("SELECT * from usuarios where id_usuario='$id' ");
                $fila= mysqli_fetch_assoc($registro);
                $id2=$fila['id_usuario'];
                $ruta=$dir.$_SESSION['nombre'].$id2.".".$extImg;
    
                if (move_uploaded_file($imagen,$ruta)){
                    
                }
                $_SESSION['info-foto-perfil']=$ruta;
                header('Cache-Control: no-store, no-cache, must-revalidate');
                
            }
            }
            header('Cache-Control: no-store, no-cache, must-revalidate');

        echo "<br>";
     

            //--- carga de los demas datos ---
            if(isset($_POST['btnregistrar'])){
            $id_usuario = $_POST["id_usuario"];
            $mail = $_POST["mail"];
            $domicilio = $_POST["domicilio"];
            $pass = $_POST["pass"];
            $telefono = $_POST["telefono"];
            $informacion = $_POST["informacion"];
        
            $sql = "UPDATE usuarios SET foto_perfil= '$ruta', mail = '$mail', domicilio = '$domicilio', contraseña = '$pass', telefono = $telefono, informacion = '$informacion' WHERE id_usuario = $id_usuario";
            mysqli_query($conexion, $sql);

            header("location:perfil.php");;}

        echo "</form> </div> </div>";
    }

    ?>
    
    <script src="script.js"></script> 
</div>
</div>
</form>
</body>
</html>