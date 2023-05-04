<!DOCTYPE html>
<html>
<head>
    <title>Bodega</title>
</head>
<body>
    <div class="container">
        <h1>Bodega</h1>
        <?php
        require_once("modulo_bodega.php");
        require_once("modulo_stock.php");

        if(isset($_POST["id_producto"]) && isset($_POST["nuevo_stock"])){
            $id_producto = $_POST["id_producto"];
            $nuevo_stock = $_POST["nuevo_stock"];

            if(actualizar_stock_producto_bodega($_POST["id_bodega"], $id_producto, $nuevo_stock)){
                echo "<div class='alert alert-success' role='alert'>El stock se actualizó correctamente.</div>";
            }else{
                echo "<div class='alert alert-danger' role='alert'>Hubo un problema al actualizar el stock. Inténtalo nuevamente.</div>";
            }
        }
        ?>

        <?php
        
        $bodegas = consultar_bodega();
        if($bodegas != null){
            foreach ($bodegas as $bodega) {

                echo "<h2>".$bodega['nombre_bodega']."</h2>";
                $productos_bodega = consultar_productos_bodega($bodega['id_bodega']);
                if($productos_bodega != null){
                    echo "<table class='table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Producto</th>";
                    echo "<th>Detalle</th>";
                    echo "<th>Stock</th>";
                    echo "<th>Editar stock</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach ($productos_bodega as $producto) {
                        echo "<tr>";
                        if (isset($producto['nombre_producto'])) {
                            echo "<td class='align-middle'>".$producto['nombre_producto']."</td>";
                        } else {
                            echo "<td class='align-middle'>Nombre del producto no disponible</td>";
                        }
                        if (isset($producto['detalle_producto'])) {
                            echo "<td class='align-middle'>".$producto['detalle_producto']."</td>";
                        } else {
                            echo "<td class='align-middle'>Stock no disponible</td>";
                        }
                        if (isset($producto['stock'])) {
                            echo "<td class='align-middle'>".$producto['stock']."</td>";
                        } else {
                            echo "<td class='align-middle'>Stock no disponible</td>";
                        }
                        echo "<td class='align-middle'>";
                        echo "<form id='actualizar_stock' method='POST'>";
                            echo "<input type='hidden' name='id_producto' value='".$producto['id_producto']."'>";
                            echo "<input type='hidden' name='id_bodega' value='".$bodega['id_bodega']."'>";
                            echo "<div class='form-group'>";
                            echo "<label for='nuevo_stock'>Nuevo stock:</label>";
                            echo "<input type='number' name='nuevo_stock' min='0' class='form-control'>";
                            echo "</div>";
                            echo "<button type='submit' name='actualizar_stock' class='btn btn-primary'>Actualizar stock</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td class='align-middle'>";
                        echo "<form action='' id='eliminar_producto_bodega' method='POST' style='display: inline-block;'>";
                        echo "<input type='hidden' name='id_producto' value='".$producto['id_producto']."'>";
                        echo "<input type='hidden' name='id_bodega' value='".$bodega['id_bodega']."'>";
                        echo "<button type='submit' name='eliminar_producto_bodega' class='btn btn-danger'>Eliminar</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No hay productos en esta bodega.</p>";
                } 
                echo "<td class='align-middle'>";
                    echo "<button type='submit' class='btn btn-secondary' onclick='openModalAgregarProducto(".$bodega['id_bodega'].")'>Agregar producto</button>";
                echo "</td>";
            }
        } else {
            echo "<p>No se encontró la bodega.</p>";
        }
        ?>
    </div>

    <!-- Modal para mostrar los productos -->

    <!-- Agrega el siguiente código al final de la página para crear el modal -->
    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProductoTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalAgregarProductoTitle">Agregar producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?php
                    $productos_no_bodega = consultar_productos_sin_bodega(3);
                    #$productos_no_bodega = consultar_productos_sin_bodega($bodega['id_bodega']);
                    if($productos_no_bodega != null){
                        echo "<select class='form-control' name='producto'>";
                        foreach ($productos_no_bodega as $producto) {
                            echo "<option value='".$producto['id_producto']."'>".$producto['nombre_producto']."</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "<p>No hay productos disponibles para agregar a esta bodega.</p>";
                    }
                ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar cambios</button>
        </div>
        </div>
    </div>
    </div>

    <script>
        // Función para abrir el modal y cargar los datos del producto
        function openModalAgregarProducto(id) {
            if (id != null) {
                $("#nombreProducto").text(id);
                $("#modalAgregarProducto").modal("show");
            }
        }
    </script>

</body>
</html>
