<?php
    require_once('modulo_bodega.php');
    $bodegas = consultar_bodega();

    if ($bodegas != null) {
        foreach ($bodegas as $bodega) {
            echo "<tr>";
            echo "<td class='align-middle'>".$bodega['id_bodega']."</td>";
            echo "<td class='align-middle'>".$bodega['nombre_bodega']."</td>";
            echo "<td class='align-middle'>";
            echo "<button type='button' class='btn btn-primary' onclick='openModal(".$bodega['id_bodega'].")'>Editar</button>";
            echo "<form action='' method='POST' style='display: inline-block;'>";
            echo "<input type='hidden' name='id' value='".$bodega['id_bodega']."'>";
            echo "<button type='submit' name='eliminar' class='btn btn-danger'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No hay bodegas registradas.</p>";
    }
    
    mysqli_close($conexion);
?>
