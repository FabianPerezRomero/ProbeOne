<?php

$LimInfCod = 1;
$LimSupCod = 3;
$Control = False;

if ($_FILES['Data']["error"] > 0) {
	echo "Error: " . $_FILES['Data']["error"] . "<br>";
}else{
	$tmp_name = $_FILES['Data']['tmp_name'];
	$name = $_FILES['Data']['name'];
	move_uploaded_file($tmp_name, "Subidos/$name");
}

$Data = fopen("Subidos/$name", "r") or die("No se cargó el archivo");

$tamaño = FileSize ("Subidos/$name");

$InfoAr = [];
while (!feof($Data)) {
	$Info = fgets($Data);
	$InfoAs = nl2br($Info);
	$InfoAr[] = $InfoAs;
}

$InforArGlobal = $InfoAr;

foreach ($InfoAr as $InfoM) {
	$InfoCliente = explode(',', $InfoM);
	$codigo = intval($InfoCliente[3]);
	if ($codigo < $LimInfCod or $codigo > $LimSupCod) {
		$Control = False;
		break;
		echo "Invalido";
	}else{
		$Control = True;
	}
}

if ($Control) {
	$Control = False;
	try {
	include("conexion.php");
    // set the PDO error mode to exception
    $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $Control = True;
    }
	catch(PDOException $e)
    {
    	echo "Connection failed: " . $e->getMessage();
    }

    if($Control){
    	$InfoEnviar = $InforArGlobal;
		foreach ($InfoEnviar as $Enviar) {
			$InfoCliente = explode(',', $Enviar);

			$email = $InfoCliente[0];
			$firstname = $InfoCliente[1];
			$lastname = $InfoCliente[2];
			$code = $InfoCliente[3];
			//echo "correo: " . $email . "  nombre: " . $firstname . "  Apellido: " . $lastname . "codigo: " . $code . "<br>";
			$n = $c->exec("insert user(email,firstname,lastname,code) values('$email','$firstname','$lastname','$code')");
		}
	}else{
		echo "No hay conexion con la base de datos";
	}
}

if ($Control == True) {
	$consulta = $c->query("select * from user");
	$tabla = $c->query("describe user");

	$Datos = $consulta->fetchAll();
	$infotabla = $tabla->fetchAll();

	if (count($Datos) > 0) {
		$filas = count($Datos);
		$columnas = count($Datos[0])/2;
	}

	for ($i=0; $i < count($infotabla); $i++) {
		$ColumnName[$i] = $infotabla[$i]["Field"];
	}
}else{
	$Datos = NULL;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Formulacio de carga de información</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="CSS/Estilo.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="JavaScript/funciones.js"></script>
	</head>
	<body>
		<div class="Contenedor">

		<header>
			<h2>GEMA SAS</h2>
		</header>

		<div class="Datos" align="center">
			<?php
				if (count($Datos) > 0) {
			?>
			<h2>Usuarios activos</h2>
			<table class="Principal">
				<tr>
					<td class="Encabezado"><strong>Email</strong></td>
					<td class="Encabezado"><strong>Nombre</strong></td>
					<td class="Encabezado"><strong>Apellido</strong></td>
				</tr>
				<?php
					for ($i=0; $i < $filas; $i++) {
						if (intval($Datos[$i][4]) == 1) {						
				?>
				<tr>
					<?php
						for ($n=1; $n < $columnas-1; $n++) {
					?>
						<td><?php echo $Datos[$i][$n];?></td>
					<?php
						}
					?>
					<tr>
					<?php
							}
					}
					?>
			</table>


			<h2>Usuarios inactivos</h2>
			<table class="Principal">
				<tr>
					<td class="Encabezado"><strong>Email</strong></td>
					<td class="Encabezado"><strong>Nombre</strong></td>
					<td class="Encabezado"><strong>Apellido</strong></td>
				</tr>
				<?php
					for ($i=0; $i < $filas; $i++) {
						if (intval($Datos[$i][4]) == 2) {						
						?>
						<tr>
							<?php
								for ($n=1; $n < $columnas-1; $n++) {
									?>
									<td><?php echo $Datos[$i][$n];?></td>
									<?php
								}
							?>
							
						</tr>
						<?php
						}
					}
				?>
			</table>


			<h2>Usuarios en espera</h2>
			<table class="Principal">
				<tr>
					<td class="Encabezado"><strong>Email</strong></td>
					<td class="Encabezado"><strong>Nombre</strong></td>
					<td class="Encabezado"><strong>Apellido</strong></td>
				</tr>
				<?php
					for ($i=0; $i < $filas; $i++) {
						if (intval($Datos[$i][4]) == 3) {						
						?>
						<tr>
							<?php
								for ($n=1; $n < $columnas-1; $n++) {
									?>
									<td><?php echo $Datos[$i][$n];?></td>
									<?php
								}
							?>
							
						</tr>
						<?php
						}
					}
				?>
			</table>

				<?php
			}else{
				?>
				<h1>El documento enviado no es compatible</h1>
				<?php
			}
		?>
			</div>

			</div>
		</section>

		
		
	</body>
</html>