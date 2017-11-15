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
			<section id="subida">
				<form action="lectura.php" method="post" enctype="multipart/form-data">
					<h1>Formulario de carga  de información</h1>
					<div class="filCon">
						<input type="file" name="Data" id="Data" class="Data" enctype="multipart/form-data" accept=".txt" onchange="nombre(this.value)"/><br>
						<label for="Data" class="btn">Cargar</label>
						<span class="letras" id="letras"></span>
					</div>
					<div class="boton">
						<input type="submit" value="Enviar información">
					</div>
				</form>
			</section>
		</div>
	</body>
</html>