<?php 
// 1. Incluir conexión y cabecera
include 'includes/db.php';
include 'includes/header.php'; 
?>

<div class="row mb-3">
    <div class="col-md-8">
        <h2>Gestión de Servicios</h2>
    </div>
    <div class="col-md-4 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalServicio">
            + Nuevo Servicio
        </button>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio ($)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 2. Consulta procedimental para obtener datos
                $query = "SELECT * FROM servicios";
                $resultado = mysqli_query($conexion, $query);

                // 3. Recorrer resultados y generar filas HTML
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['descripción']) . "</td>";
                    echo "<td>" . number_format($fila['precio'], 2) . "</td>";
                    echo "<td>
                            <a href='editar_servicio.php?id=" . $fila['id'] . "' class='btn btn-sm btn-warning'>Editar</a>
                            <a href='procesar_servicio.php?eliminar=" . $fila['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalServicio" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="procesar_servicio.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Añadir Nuevo Servicio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label">Nombre del Servicio</label>
                  <input type="text" name="nombre" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label class="form-label">Descripción</label>
                  <textarea name="descripcion" class="form-control" rows="3" required></textarea>
              </div>
              <div class="mb-3">
                  <label class="form-label">Precio</label>
                  <input type="number" step="0.01" name="precio" class="form-control" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name="guardar_servicio" class="btn btn-success">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php 
// 4. Incluir el pie de página
include 'includes/footer.php'; 
?>