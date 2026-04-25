<?php require_once '../config/database.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Cargar Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<a href="menu.php" class="btn btn-secondary mb-3">← Volver al menú</a>

<h3>Cargar Ticket</h3>

<form method="POST" action="../controllers/TicketController.php">

    <input class="form-control mb-2" name="dni" id="dni" placeholder="DNI" required>

    <input class="form-control mb-2" name="nombre" id="nombre" placeholder="Nombre" required>

    <input class="form-control mb-2" name="departamento" id="departamento" placeholder="Departamento" required>

    <input class="form-control mb-2" name="cargo" id="cargo" placeholder="Cargo" required>

    <input class="form-control mb-2" name="problema" placeholder="Problema" required>

    <textarea class="form-control mb-2" name="detalle" placeholder="Detalle" required></textarea>

    <button class="btn btn-primary">Guardar</button>

</form>

<div id="historial" class="mt-4"></div>

<script>
const dniInput = document.getElementById('dni');

dniInput.addEventListener('blur', buscarUsuario);
dniInput.addEventListener('change', buscarUsuario);

// evitar que ENTER rompa el flujo
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
            nombre.value = d.nombre;
            departamento.value = d.departamento;
            cargo.value = d.cargo;

            cargarHistorial(dni);
        } else {
            nombre.value = '';
            departamento.value = '';
            cargo.value = '';

            document.getElementById('historial').innerHTML = '<p>Usuario nuevo</p>';
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
                html += `<li class="list-group-item">
                    ${t.fecha} - ${t.problema} <strong>(${t.estado})</strong>
                </li>`;
            });

            html += "</ul>";
        } else {
            html += "<p>Sin tickets previos</p>";
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
</body>
</html>