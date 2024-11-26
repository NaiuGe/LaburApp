<?php
    session_name("LOGIN");
    session_start();
    include ("conexion.php");

?>
<html>
    <head>
        <link rel="stylesheet" href="estilo.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <header>
    <img id="abrir" class="abrir-menu" src="./imagenes/fotoMenu.png" alt="Menú hamburguesa">
        <img class="logo" src="./imagenes/logo.png" alt="Logo de Laburapp">
        <nav class="nav-bar" id="nav">
            <button id="cerrar" class="cerrar-menu">X</button>
                    <ul class="nav-list"> 
                    <li><a href="index.php" alt="indice">Principal</a></li>
                    <li><a href='perfil.php' alt="Ver Perfil">Ver Perfil</a></li>
                    <li><a href="#">Ver gráfico</a></li>
                    <li><a href='cerrarlogin.php' alt="CERRAR SESIÓN">Cerrar sesión</a></li>            
                </ul>
            </nav>
    </header>
<body>
    
    <main>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    drawChart1();
    drawChart2();
}
function drawChart1() {
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

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);

    document.getElementById('imagen1').value = chart.getImageURI();
}

function drawChart2() {
    var data = google.visualization.arrayToDataTable([
        ["Profesiones", "Publicaciones", { role: "style" }],
        <?php
$sql = "SELECT pr.nombre_profesion AS nombre, COUNT(pr.id_profesion) AS total 
        FROM publicaciones AS p
        JOIN profesiones AS pr ON pr.id_profesion = p.id_profesion
        GROUP BY pr.nombre_profesion
        ORDER BY total DESC";
$resultado = mysqli_query($conexion, $sql);

$filas = [];
while ($r = mysqli_fetch_assoc($resultado)) {
    $nombre = addslashes($r['nombre']);
    $total = (int) $r['total'];
    $color = "#".substr(md5($nombre), 0, 6); 
    $filas[] = "['$nombre', $total, '$color']";
}

echo implode(",", $filas);
?>
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        { calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" },
        2]);

    var options = {
        title: "Número de Publicaciones por Profesión",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
    };

    var chart = new google.visualization.ColumnChart(document.getElementById("grafico2"));
    chart.draw(view, options);

document.getElementById('imagen2').value = chart.getImageURI(); 
}

</script>
<div class="grafico-contenedor">
        <div id="piechart_3d" class="grafico" style="width: 900px; height: 500px;"></div>
    </div>

        <section>
        <form method="post" id="hacer_pdf" action="generarGrafico.php">
    <input type="hidden" size="100" name="imagen1" id="imagen1">
    <input type="hidden" size="100" name="imagen2" id="imagen2">
    <div class="grafico-contenedor">
                <div id="grafico2" class="grafico" style="height: 300px;"></div>
            </div>

    <br><br><br><br><br><br>    
    <input class="btn-busqueda" type="submit" value="Cargar PDF"/>
</form>
	</section>
    <footer>
        <script src="script.js"></script>
    </footer>
    </body>
    </main>
</html>
