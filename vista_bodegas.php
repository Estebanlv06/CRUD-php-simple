<div class="container">
    <h1>Bodegas</h1>
    <h2>Agregar bodega</h2>
    <form id="agregar_bodega" method="post">
        <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" name="nombre" required>
        </div>
        <button type="submit" class="btn btn-primary" name="agregar_bodega" form="agregar_bodega">Agregar</button>
    </form>

    <hr>

    <h2>Editar o eliminar bodegas</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>


<?php
    require_once('modulo_bodega.php');
    $bodegas = consultar_bodega();

    if ($bodegas != null) {
        foreach ($bodegas as $bodega) {
            echo "<tr>";
            echo "<td class='align-middle'>".$bodega['id_bodega']."</td>";
            echo "<td class='align-middle'>".$bodega['nombre_bodega']."</td>";
            echo "<td class='align-middle'>";
            #echo "<button type='button' class='btn btn-primary' onclick='openModalbodega(".$bodega['id_bodega'].")'>Editar</button>";
            echo "<button type='button' class='btn btn-primary' data-id='".$bodega['id_bodega']."' data-toggle='modal' data-target='#modalBodega-editar'>Editar</button>";
            echo "<form action='' method='POST' style='display: inline-block;'>";
            echo "<input type='hidden' name='id' value='".$bodega['id_bodega']."'>";
            echo "<button type='submit' name='eliminar_bodega' class='btn btn-danger'>Eliminar</button>";
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
        </tbody>
    </table>
    </div>


<!-- Modal para editar bodega -->
<div class="modal fade" id="modalBodega-editar" tabindex="-1" role="dialog" aria-labelledby="modal-editar-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalBodega-editar-label">Editar bodega</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="editar_bodega" method="POST">
            <div class="modal-body">
            <input type="hidden" name="id_bodega" id="id_bodega">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="editar_bodega" form="editar_bodega">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
        </div>
    </div>
</div>
