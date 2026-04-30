<?php require_once __DIR__ . '/../config/database.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <a href="menu.php" class="btn btn-secondary mb-3">← Volver al menú</a>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4">🎫 Cargar Ticket</h3>

                    <form method="POST" action="../controllers/TicketController.php">

                        <div class="mb-3">
                            <input class="form-control" name="dni" id="dni" placeholder="DNI" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="departamento" id="departamento" placeholder="Departamento" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="cargo" id="cargo" placeholder="Cargo" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="problema" placeholder="Problema" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="detalle" placeholder="Detalle" rows="4" required></textarea>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary">Guardar Ticket</button>
                        </div>

                    </form>
                </div>
            </div>

            <div id="historial" class="mt-4"></div>

        </div>
    </div>

</div>

<script>
const dniInput = document.getElementById('dni');

dniInput.addEventListener('blur', buscarUsuario);
dniInput.addEventListener('change', buscarUsuario);

dniInput.addEventListener('keypress', function(e){
    if(e.key === 'Enter'){
        e.preventDefault();
        buscarUsuario();
    }
});

function buscarUsuario() {
    let dni = dniInput.value;
    if(dni === '') return;

    fetch('../ajax/buscar_usuario.php?dni=' + dni)
    .then(r => r.json())
    .then(d => {
        if(d && d.dni){
            document.getElementById('nombre').value = d.nombre;
            document.getElementById('departamento').value = d.departamento;
            document.getElementById('cargo').value = d.cargo;
            cargarHistorial(dni);
        } else {
            document.getElementById('nombre').value = '';
            document.getElementById('departamento').value = '';
            document.getElementById('cargo').value = '';
            document.getElementById('historial').innerHTML = '<p class="text-muted">Usuario nuevo</p>';
        }
    });
}

function cargarHistorial(dni) {
    fetch('../ajax/historial_tickets.php?dni=' + dni)
    .then(r => r.json())
    .then(data => {
        let html = "<h5>Historial de tickets</h5>";
        if(data.length > 0){
            html += "<ul class='list-group'>";
            data.forEach(t => {
                html += `<li class="list-group-item d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <span>${t.fecha} - ${t.problema}</span>
                    <strong class="badge bg-secondary">${t.estado}</strong>
                </li>`;
            });
            html += "</ul>";
        } else {
            html += "<p class='text-muted'>Sin tickets previos</p>";
        }
        document.getElementById('historial').innerHTML = html;
    });
}
</script>

<?php if(isset($_GET['msg']) && $_GET['msg']=='ok'): ?>
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast show align-items-center text-bg-success border-0">
        <div class="d-flex">
            <div class="toast-body">
                🎫 Ticket generado correctamente (N° <?= htmlspecialchars($_GET['id']) ?>)
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
    </div>
</div>
<script>
setTimeout(() => {
    document.querySelector('.toast')?.remove();
}, 4000);
</script>
<?php endif; ?>
<footer>
<?php
include "footer.php"; 
?>
</footer>
</body>
</html>
