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