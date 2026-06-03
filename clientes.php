<?php 
// 1. Incluir la conexión a la base de datos y la cabecera modular
include 'includes/db.php';
include 'includes/header.php'; 
?>

<div class="row mb-3">
    <div class="col-md-8">
        <h2>Gestión de Clientes</h2>
    </div>
    <div class="col-md-4 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCliente">
            + Nuevo Cliente
        </button>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 2. Consulta procedimental. 
                // IMPORTANTE: Uso de comillas invertidas para las columnas con tildes
                $query = "SELECT id, nombre, correo, `teléfono` FROM clientes";
                $resultado = mysqli_query($conexion, $query);

                // Validamos que la consulta no tenga errores de SQL antes de imprimir
                if ($resultado) {
                    // 3. Bucle para imprimir cada cliente en la tabla
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['correo']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['teléfono']) . "</td>";
                        echo "<td>
                                <a href='procesar_cliente.php?eliminar=" . $fila['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar este cliente?\")'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    // Si hay error en la base de datos, lo mostramos en la tabla para diagnosticar
                    echo "<tr><td colspan='5' class='text-danger text-center'>Error en la base de datos: " . mysqli_error($conexion) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="procesar_cliente.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Registrar Nuevo Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              
              <div class="mb-3">
                  <label class="form-label">Nombre Completo</label>
                  <input type="text" name="nombre" class="form-control" placeholder="Ej. Juan Pérez" required>
              </div>
              
              <div class="mb-3">
                  <label class="form-label">Correo Electrónico</label>
                  <input type="email" name="correo" class="form-control" placeholder="juan@correo.com" required>
              </div>

              <div class="mb-3">
                  <label class="form-label">Contraseña de Acceso</label>
                  <input type="password" name="contrasena" class="form-control" required>
              </div>
              
              <div class="mb-3">
                  <label class="form-label">Teléfono / Celular</label>
                  <input type="text" name="telefono" class="form-control" placeholder="0999999999" maxlength="10" required>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name="guardar_cliente" class="btn btn-success">Guardar Cliente</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php 
// 4. Incluir scripts y cierre del documento
include 'includes/footer.php'; 
?>