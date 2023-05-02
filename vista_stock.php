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
                        if (isset($producto['stock'])) {
                            echo "<td class='align-middle'>".$producto['stock']."</td>";
                        } else {
                            echo "<td class='align-middle'>Stock no disponible</td>";
                        }
                        echo "<td class='align-middle'>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='id_producto' value='".$producto['id_producto']."'>";
                        echo "<div class='form-group'>";
                        echo "<label for='nuevo_stock'>Nuevo stock:</label>";
                        echo "<input type='number' name='nuevo_stock' min='0' class='form-control'>";
                        echo "</div>";
                        echo "<button type='submit' name='actualizar_stock' class='btn btn-primary'>Actualizar stock</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
            
                } else {
                    echo "<p>No hay productos en esta bodega.</p>";
                } 
            }
        } else {
            echo "<p>No se encontró la bodega.</p>";
        }
        ?>
    </div>
</body>
</html>
