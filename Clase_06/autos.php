<?php
	include("verifica_sesion.php");
	
	include ("conectar.php");
	
	$error=0;
	
	if (isset($_POST['insertar'])) {
		$p = $_POST['patente'];
		$m = $_POST['marca'];
		$d = $_POST['modelo'];
		$a = $_POST['anio'];
		$t = $_POST['tipo'];
		$sql = "insert into autos (patente, marca, modelo, anio, tipo) values ('$p','$m', '$d', '$a', '$t')";
		try {
			mysqli_query($conexion, $sql);
		} catch (Exception $e) {
			$error=1;
		}
	}
	
	if (isset($_POST['actualizar'])) {
		$id = $_POST['id'];
		$p  = $_POST['patente'];
		$m  = $_POST['marca'];
		$d  = $_POST['modelo'];
		$a  = $_POST['anio'];
		$t  = $_POST['tipo'];
		$sql = "update autos set patente='$p', marca='$m', modelo='$d', anio='$a', tipo='$t' where idauto=$id";
		try {
			mysqli_query($conexion, $sql);
		} catch (Exception $e) {
			$error=1;
		}
	}
	
	if (isset($_GET['eliminar'])) {
		$id = $_GET['eliminar'];
		$sql = "delete from autos where idauto=$id";
		try {
			mysqli_query($conexion, $sql);
		} catch (Exception $e) {
			$error=2;
		}
	}
	
	if (isset($_GET['mod'])) {
		$id = $_GET['mod'];
		$sql = "select * from autos where idauto=$id";
		$modif = mysqli_query($conexion, $sql);
		$acambiar = mysqli_fetch_assoc($modif);
	}
	
	// -------------------- Paginación ------------------
	$rango_pag=5;
	if (isset($_GET["pagina"])) {
		$pagina=$_GET["pagina"];
	} else {
		$pagina=1;
	}
	$desde = ($pagina-1)*$rango_pag;
	$sql="select * from autos";
	$resultado = mysqli_query($conexion, $sql);
	$cant_registros = mysqli_num_rows($resultado);
	$cant_pag = ceil($cant_registros/$rango_pag);
	// -------------------------------------------------
	
	$sql = "select * from autos limit $desde, $rango_pag";  // cláusula limit agregada por la paginación
	$mostrar = mysqli_query($conexion, $sql);
?>

<html>
<head>
	<link href="estilo.css" rel="stylesheet" type="text/css">
	<title> Mantenimiento Mecanico </title>
</head>
<body>
	<header>
		<H1> Taller de Mantenimiento Mecánico </H1>
	</header>
	<nav>
		<ul>
		  <li>  <a href="autos.php"> Autos </a> </li>
		  <li>  <a href="tiposm.php"> Tipos Mant. </a> </li>
		  <li>  <a href="mecanicos.php"> Mecánicos </a> </li>
		  <li>  <a href="reparaciones.php"> Reparaciones </a> </li>
		  <li>  <a href="consultas.php"> Consultas </a> </li>
		  <li>  <a href="reportes.php"> Reportes </a> </li>
		</ul>
	</nav>
	<section>
		<form action="autos.php" method="post">
		  <H3> Gestión de Autos </H3>
		  <?php if ($error==1) echo "<p id='controlPatente'> Error-Patente duplicada </p>"; 
		        if ($error==2) echo "<p id='controlPatente'> Error-No es posible eliminar una auto que tiene reparaciones </p>";
		  ?>
		  <input type="hidden" name="id" value="<?php if(isset($_GET['mod'])) echo $_GET['mod']; else echo '';?>" ></input>
		  Patente <input type="text" name="patente" maxlength="7"
		  value="<?php if(isset($_GET['mod'])) echo $acambiar['patente']; else echo ''; ?>" placeholder="Patente" autofocus required></input>	
          &nbsp;&nbsp;&nbsp;
		  Marca <input type="text" name="marca" maxlength="50"
		  value="<?php if(isset($_GET['mod'])) echo $acambiar['marca']; else echo ''; ?>" placeholder="Marca" required></input>	
          &nbsp;&nbsp;&nbsp;		
		  Modelo <input type="text" name="modelo" maxlength="50"
		  value="<?php if(isset($_GET['mod'])) echo $acambiar['modelo']; else echo ''; ?>" placeholder="Modelo" required></input>
		  &nbsp;&nbsp;&nbsp;
		  Año <input type="number" name="anio" min="1900" max="3000"
		  value="<?php if(isset($_GET['mod'])) echo $acambiar['anio']; else echo ''; ?>" 
		  placeholder="Año" required></input> 
		  &nbsp;&nbsp;&nbsp;
		  Tipo 
		  <select name="tipo" required> 
			<option value="" selected disabled>seleccione el tipo de auto</option>
			<?php
				if(isset($_GET['mod'])){
					echo "<option value='".$acambiar['tipo']."' selected>".$acambiar['tipo']."</option>";
				}
			?> 
			<option value="Sedan"> Sedan </option>
			<option value="Hatch"> Hatch </option>
			<option value="SUV"> SUV </option>
			<option value="Pick up"> Pick up </option>
		  </select>
		  <br> </br>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="submit" 
		  name="<?php if(isset($_GET['mod'])) echo 'actualizar'; else echo 'insertar';?>"
		  value="<?php if(isset($_GET['mod'])) echo 'Modificar'; else echo 'Crear';?>"
		  style='width:120px;height:20px'>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="button" name="cancelar" value="Cancelar" style='width:120px;height:20px' onClick="window.location.href = 'autos.php'">
		</form>  
		  
		  <table border="2">
			<tr>
				<th>Id</th>
				<th>Patente</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Año</th>
				<th>Tipo</th>
				<th>Modificar</th>
				<th>Eliminar</th>
			</tr>
		  <?php
			while ($fila=mysqli_fetch_assoc($mostrar)){
				echo "<tr>
						<td>".$fila['idauto']."</td>
						<td>".$fila['patente']."</td>
						<td>".$fila['marca']."</td>
						<td>".$fila['modelo']."</td></td>
						<td>".$fila['anio']."</td></td>
						<td>".$fila['tipo']."</td></td>
						<td><center><a href='autos.php?mod=".$fila['idauto']."'><img src='modificar.jpg' width='30' height='25'></a></center></td>
						<td><center><a href=\"javascript:preguntar('".$fila['idauto']."','".$fila['patente']."')\"><img src='eliminar.png' width='30' 
					  </tr>";
			}
		  ?>
		  </table>
		  <?php
		    // -------------------- Paginación ---------------------
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."Pág.:  ";
			for ($i=1 ; $i<=$cant_pag ; $i++) {
				echo "<a href='?pagina=".$i."'>".$i."</a>  " ;
			}
			// -----------------------------------------------------
		  ?>
		  <script>
			function preguntar(valor, patente) {
				rpta = confirm("Estas seguro de eliminar el auto " + valor + "-" + patente + " ?");
				if (rpta) window.location.href = "autos.php?eliminar=" + valor;
			}
		  </script>
	</section>
	<footer> 
		<p> ISP21 - TSDS - Programación </p>
	</footer>
</body>
</html>
