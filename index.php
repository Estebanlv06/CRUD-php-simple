<!DOCTYPE html>
<html>
<head>
	<title>Productos</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1>Productos</h1>
		<h2>Agregar producto</h2>
		<form id="agregar_producto" method="post">
			<div class="form-group">
				<label for="nombre">Nombre:</label>
				<input type="text" class="form-control" name="nombre" required>
			</div>
			<div class="form-group">
				<label for="detalle">Detalle:</label>
				<input type="text" class="form-control" name="detalle" required>
			</div>
			<button type="submit" class="btn btn-primary" name="agregar_producto" form="agregar_producto">Agregar</button>
		</form>

		<hr>

		<h2>Editar o eliminar productos</h2>
		<table class="table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nombre</th>
					<th>Detalle</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
      <?php
        require_once('vista_productos.php');
      ?>
			</tbody>
		</table>

  <!-- Modal para editar producto -->
  <div class="modal fade" id="modalProducto-editar" tabindex="-1" role="dialog" aria-labelledby="modal-editar-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalProducto-editar-label">Editar producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editar_producto" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id_producto" id="id_producto">
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
            <div class="form-group">
              <label for="detalle">Detalle:</label>
              <input type="text" class="form-control" name="detalle" id="detalle">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="editar_producto" form="editar_producto">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
	</div>

	<!-- Bootstrap JavaScript -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<script>
  // Función para abrir el modal y cargar los datos del producto
  function openModal(id) {
    var producto = getProductById(id);
    if (producto != null) {
      document.getElementById("id_producto").value = producto.id_producto;
      document.getElementById("nombre").value = producto.nombre_producto;
      document.getElementById("detalle").value = producto.detalle_producto;
      $("#modalProducto-editar").modal("show");
    }
  }

  // Función para cerrar el modal
  function closeModal() {
    document.getElementById("modalProducto-editar").close();
  }

  // Función para obtener un producto por su ID
  function getProductById(id) {
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
</script>
</body>
</html>

