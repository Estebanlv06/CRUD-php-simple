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
 // var productos = <?php echo json_encode($productos); ?>;
  for (var i = 0; i < productos.length; i++) {
    if (productos[i].id_producto == id) {
      return productos[i];
    }
  }
  return null;
}

$('#modalBodega-editar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var modal = $(this);
  modal.find('#id_bodega').val(id);
  modal.find('#nombre').val(button.closest('tr').find('.nombre_bodega').text());
});

  