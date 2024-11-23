<?php
    session_name("LOGIN");
    session_start();
    include ("conexion.php");


?>
<html>
    <head>
        <link rel="stylesheet" href="estilo.css">
    </head>
    <header>
    <img id="abrir" class="abrir-menu" src="./imagenes/fotoMenu.png" alt="Menú hamburguesa">
        <img class="logo" src="./imagenes/logo.png" alt="Logo de Laburapp">
        <nav class="nav-bar" id="nav">
        <img id="cerrar" class="cerrar-menu" src="./imagenes/cerrar.png" alt="Cruz para cerrar el menú">
                    <ul class="nav-list"> 
                    <li><a href="index.php" alt="indice">Principal</a></li>
                    <li><a href='perfil.php' alt="Ver Perfil">Ver Perfil</a></li>
                    <li><a href='cerrarlogin.php' alt="CERRAR SESIÓN">Cerrar sesión</a></li>            
                </ul>
            </nav>
    </header>
<body>
    <main>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Localidades', 'Personas'],
            <?php
$sql = "SELECT concat('[\"' , l.nombre_localidad, '\",' , cast(count(l.id_localidad) as char), '],' ) 
as fila FROM localidades as l, usuarios as u
WHERE u.id_localidad = l.id_localidad
GROUP BY l.nombre_localidad
ORDER BY count(l.id_localidad) DESC";
$resultado = mysqli_query($conexion,$sql);
while ($r = mysqli_fetch_assoc($resultado)) echo $r['fila'];
        
            ?>
        ]);

        var options = {
            title: 'Porcentaje de usuarios por localidad',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('grafico'));
        chart.draw(data, options);

        document.getElementById('imagen').value = chart.getImageURI();
        }
        
        </script>
        <section>
		<form method="post" id="hacer_pdf" action="generarGrafico.php">
			<input type="hidden" size="100" name="imagen" id="imagen">
			<div id="grafico" style="width:80%; height: 400px; float:left;"></div>
			<br></br><br></br><br></br>
			<input class="btn-busqueda" type="submit" value="Cargar PDF"/>
		</form>
	</section>
    </main>
    </body>
</html>
