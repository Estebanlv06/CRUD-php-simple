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
                    require_once('modulo_producto.php');
                    $productos = consultar_producto();
                    if ($productos != null) {
                        foreach ($productos as $producto) {
                            echo "<tr>";
                            echo "<td class='align-middle'>".$producto['id_producto']."</td>";
                            echo "<td class='align-middle'>".$producto['nombre_producto']."</td>";
                            echo "<td class='align-middle'>".$producto['detalle_producto']."</td>";
                            echo "<td class='align-middle'>";
                            echo "<button type='button' class='btn btn-primary' onclick='openModalproducto(".$producto['id_producto'].")'>Editar</button>";
                            echo "<form action='' method='POST' style='display: inline-block;'>";
                            echo "<input type='hidden' name='id' value='".$producto['id_producto']."'>";
                            echo "<button type='submit' name='eliminar_producto' class='btn btn-danger'>Eliminar</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p>No hay productos registrados.</p>";
                    }
                    mysqli_close($conexion);
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