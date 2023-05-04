<!DOCTYPE html>
<html>
<head>
	<title>Sistema Expertos CRUD</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php

		if (isset($_GET['alerta'])) {
			$alerta = $_GET['alerta'];
			$color = $_GET['color'];
			echo '<div id="alerta" class="alert alert-'.$color.'" role="alert">'.$alerta.'</div>';
		}
		
	?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Expertos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php?view=bodegas">Bodegas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?view=productos">Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?view=stock">Stock</a>
      </li>
    </ul>
  </div>
</nav>

<?php
		// Obtener el parámetro de la URL
		$view = isset($_GET['view']) ? $_GET['view'] : '';

		// Cargar la vista correspondiente
		switch ($view) {
			case 'stock':
				require_once('vista_stock.php');
				break;
			case 'productos':
				require_once('vista_productos.php');
				break;
			case 'bodegas':
				require_once('vista_bodegas.php');
				break;
			default:
				// Cargar la vista predeterminada si no se proporciona un parámetro
				require_once('vista_bodegas.php');
				break;
		}
		
	?>


	<!-- Bootstrap JavaScript -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<script>
		// Ocultar la alerta después de 5 segundos
		setTimeout(function() {
			var alerta = document.getElementById('alerta');
			alerta.style.display = 'none';
		}, 2000);
	</script>


</body>
</html>