<?php
include 'conexion.php';

// Insertar proveedor
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "INSERT INTO proveedores (nombre, direccion, telefono, email) VALUES (:nombre, :direccion, :telefono, :email)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    header("Location: gestionar_proveedores.php");
    exit();
}

// Actualizar proveedor
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "UPDATE proveedores SET nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    header("Location: gestionar_proveedores.php");
    exit();
}

// Borrar proveedor
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM proveedores WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: gestionar_proveedores.php");
    exit();
}

// Obtener proveedores
$sql = "SELECT * FROM proveedores";
$stmt = $conn->prepare($sql);
$stmt->execute();
$proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            margin-bottom: 20px;
        }
        .table thead {
            background-color: #343a40;
            color: #fff;
        }
        .btn-primary, .btn-warning, .btn-danger {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Gestión de Proveedores</h2>
        </div>
        <div class="card-body">
            <!-- Formulario para agregar o editar proveedores -->
            <form action="gestionar_proveedores.php" method="post">
                <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : 'submit'; ?>" class="btn btn-primary">
                    <?php echo isset($_GET['edit']) ? 'Actualizar' : 'Ingresar'; ?>
                </button>
            </form>
        </div>
    </div>

    <!-- Lista de proveedores -->
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Lista de Proveedores</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($proveedor['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['direccion']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['email']); ?></td>
                            <td>
                                <a href="gestionar_proveedores.php?edit=<?php echo $proveedor['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="gestionar_proveedores.php?delete=<?php echo $proveedor['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de borrar este proveedor?');">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
