<!DOCTYPE html>
<html>
<head>
	<title>Sistema Expertos CRUD</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
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
    // Función para abrir el modal y cargar los datos del producto
    function openModalproducto(id) {
      var producto = getProductoById(id);
      if (producto != null) {
        document.getElementById("id_producto").value = producto.id_producto;
        document.getElementById("nombre").value = producto.nombre_producto;
        document.getElementById("detalle").value = producto.detalle_producto;
        $("#modalProducto-editar").modal("show");
      }
    }

    // Función para cerrar el modal
    function closeModals() {
      document.getElementById("modalProducto-editar").close();
      document.getElementById("modalBodega-editar").close();
    }


    // Función para obtener un producto por su ID
    function getProductoById(id) {
      <?php
        // Obtener la lista de productos en formato JSON
        $productos_json = json_encode($productos);
      ?>
      var productos = <?php echo $productos_json; ?>;
      for (var i = 0; i < productos.length; i++) {
        if (productos[i].id_producto == id) {
          return productos[i];
        }
      }
      return null;
    }

    $('#modalBodega-editar').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id_bodega');
          var modal = $(this);
          modal.find('#id_bodega').val(id);
          modal.find('#nombre').val(button.closest('tr').find('.nombre_bodega').text());
      });
</script>
</body>
</html>