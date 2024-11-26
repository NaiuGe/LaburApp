<?php
	include("verifica_sesion.php");
	
	include ("conectar.php");
	
	if (isset($_POST['insert'])) {
		$ia = $_POST['idauto'];
		$it = $_POST['idtipo'];
		$im = $_POST['idmecanico'];
		$d = $_POST['descripcion'];
		$f = $_POST['fecha'];
		$c = $_POST['costo'];
		$sql = "insert into reparaciones (idauto, idtipo, idmecanico, descripcion, fecha, costo) values ('$ia', '$it', '$im', '$d', '$f', '$c')";
		mysqli_query($conexion, $sql);
	}
	
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$ia = $_POST['idauto'];
		$it = $_POST['idtipo'];
		$im = $_POST['idmecanico'];
		$d = $_POST['descripcion'];
		$f = $_POST['fecha'];
		$c = $_POST['costo'];
		$sql = "update reparaciones set idauto='$ia', idtipo='$it', idmecanico='$im', descripcion='$d', fecha='$f', costo='$c' where idreparacion=$id";
		mysqli_query($conexion, $sql);
	}
	
	if (isset($_GET['el'])) {
		$id = $_GET['el'];
		$sql = "delete from reparaciones where idreparacion=$id";
		mysqli_query($conexion, $sql);
	}
		
	if (isset($_GET['mo'])) {
		$id = $_GET['mo'];
		$sql = "select * from reparaciones where idreparacion=$id";
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
	$sql="select * from reparaciones";
	$resultado = mysqli_query($conexion, $sql);
	$cant_registros = mysqli_num_rows($resultado);
	$cant_pag = ceil($cant_registros/$rango_pag);
	// -------------------------------------------------
	
	$sql = "SELECT r.idreparacion as idreparacion, 
	        concat(a.patente,' - ',a.marca,' ',a.modelo) as auto, 
			t.tipom as tipo, 
			concat(m.nombre, '-', + m.especialidad) as mecanico,
			r.descripcion as descripcion, 
			r.fecha as fecha, 
			r.costo as costo
			FROM reparaciones as r, autos as a, tiposmant as t, mecanicos as m
			WHERE r.idauto = a.idauto AND 
				  r.idtipo = t.idtipom AND 
				  r.idmecanico = m.idmecanico
			LIMIT $desde, $rango_pag";
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
		<form action="reparaciones.php" method="post">
		<H3> Gestión de Reparaciones </H3>
		<input type="hidden" 
		value="<?php if(isset($_GET['mo'])) echo $_GET['mo']; else echo '';?>" 
		name="id"></input>
		Auto <select name="idauto" autofocus required> 
		     <option value="" selected disabled>seleccione el auto</option>
		<?php
			if(isset($_GET['mo'])){
				$sql= "select * from autos where idauto=".$acambiar['idauto'];
				$autos = mysqli_query($conexion, $sql);
				$fila=mysqli_fetch_assoc($autos);
				echo "<option value='".$fila['idauto']."' selected>".$fila['patente']." - ".$fila['marca']." ".$fila['modelo']."</option>";
			}
			$sql= "select * from autos";
			$autos = mysqli_query($conexion, $sql); 
			while ($fila=mysqli_fetch_assoc($autos)) {
				echo "<option value='".$fila['idauto']."'>".$fila['patente']." - ".$fila['marca']." ".$fila['modelo']."</option>";
			}
		?>   </select>
		&nbsp;&nbsp;&nbsp;
		Tipo Mant. <select name="idtipo" required> 
				   <option value="" selected disabled>seleccione el tipo de mant.</option>
		<?php
			if(isset($_GET['mo'])){
				$sql= "select * from tiposmant where idtipom=".$acambiar['idtipo'];
				$tipos = mysqli_query($conexion, $sql);
				$fila=mysqli_fetch_assoc($tipos);
				echo "<option value='".$fila['idtipom']."' selected>".$fila['tipom']."</option>";
			}
			$sql= "select * from tiposmant";
			$tipos = mysqli_query($conexion, $sql); 
			while ($fila=mysqli_fetch_assoc($tipos)) {
				echo "<option value='".$fila['idtipom']."'>".$fila['tipom']."</option>";
			}
		?>   </select>
		&nbsp;&nbsp;&nbsp;
		Mecánico <select name="idmecanico" required> 
				 <option value="" selected disabled>seleccione el mecánico</option>
		<?php
			if(isset($_GET['mo'])){
				$sql= "select * from mecanicos where idmecanico=".$acambiar['idmecanico'];
				$mecanicos = mysqli_query($conexion, $sql);
				$fila=mysqli_fetch_assoc($mecanicos);
				echo "<option value='".$fila['idmecanico']."' selected>".$fila['nombre']."-".$fila['especialidad']."</option>";
			}
			$sql= "select * from mecanicos";
			$mecanicos = mysqli_query($conexion, $sql); 
			while ($fila=mysqli_fetch_assoc($mecanicos)) {
				echo "<option value='".$fila['idmecanico']."'>".$fila['nombre']."-".$fila['especialidad']."</option>";
			}
		?>   </select>
		&nbsp;&nbsp;&nbsp;		
		Fecha <input type="date" 
		value="<?php if(isset($_GET['mo'])) echo $acambiar['fecha']; else echo '';?>" 
		name="fecha" placeholder="Fecha" required></input>
		&nbsp;&nbsp;&nbsp;
		Costo <input type="text" 
		value="<?php if(isset($_GET['mo'])) echo $acambiar['costo']; else echo '';?>" 
		name="costo" placeholder="Costo" required></input> 
		<br></br>
		Descripción <input type="text" 
		value="<?php if(isset($_GET['mo'])) echo $acambiar['descripcion']; else echo '';?>"
		name="descripcion" placeholder="Descripción" maxlength="256" size="152" required></input>
		<br></br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" 
		name="<?php if(isset($_GET['mo'])) echo 'update'; else echo 'insert';?>" 
		value="<?php if(isset($_GET['mo'])) echo 'Modificar'; else echo 'Crear';?>" 
		style='width:120px;height:20px'> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" name="cancelar" value="Cancelar" style='width:120px;height:20px' onClick="window.location.href = 'reparaciones.php'">
		<br></br>
		<table border="2">
			<tr>
				<th>Id</th>
				<th>Auto</th>
				<th>Tipo Mant.</th>
				<th>Mecánico</th>
				<th>Descripción</th>
				<th>Fecha</th>
				<th>Costo</th>
				<th>Eliminar</th>
				<th>Modificar</th>
			</tr>
		<?php
			while ($fila=mysqli_fetch_assoc($mostrar)){
				//cambiar $fila['fecha'] por date("d/m/Y", strtotime($fila['fecha']))
				echo "<tr>
						<td>".$fila['idreparacion']."</td>
						<td>".$fila['auto']."</td>
						<td>".$fila['tipo']."</td></td>
						<td>".$fila['mecanico']."</td></td>
						<td>".$fila['descripcion']."</td></td>
						<td>".date("d/m/Y", strtotime($fila['fecha']))."</td></td>
						<td>".$fila['costo']."</td></td>
						<td><center><a href=\"javascript:preguntar('".$fila['idreparacion']."')\"><img src='eliminar.png' width='30' height='25'></a></center></td>
						<td><center><a href='reparaciones.php?mo=".$fila['idreparacion']."')\"><img src='modificar.jpg' width='30' height='25'></a></center></td>
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
			function preguntar(valor) {
				rpta = confirm("Estas seguro de eliminar la reparación " + valor + "?");
				if (rpta) window.location.href = "reparaciones.php?el=" + valor;
			}
		</script>
	</section>
	<footer> 
		<p> ISP21 - TSDS - Programación </p>
	</footer>
</body>
</html>
