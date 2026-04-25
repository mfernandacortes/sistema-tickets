fetch('../controllers/dashboard_data.php')
.then(res => res.json())
.then(data => {

    console.log(data); // DEBUG (podés sacarlo después)

    // 1. Por departamento
    new Chart(document.getElementById('porDepartamento'), {
        type: 'bar',
        data: {
            labels: data.departamentos.map(d => d.departamento),
            datasets: [{
                label: 'Tickets',
                data: data.departamentos.map(d => d.total)
            }]
        }
    });

    // 2. Por estado
    new Chart(document.getElementById('porEstado'), {
        type: 'pie',
        data: {
            labels: data.estados.map(e => e.estado),
            datasets: [{
                data: data.estados.map(e => e.total)
            }]
        }
    });

    // 3. Problemas
    new Chart(document.getElementById('problemas'), {
        type: 'bar',
        data: {
            labels: data.problemas.map(p => p.problema),
            datasets: [{
                label: 'Frecuencia',
                data: data.problemas.map(p => p.total)
            }]
        }
    });

    // 4. Evolución temporal
    new Chart(document.getElementById('evolucion'), {
        type: 'line',
        data: {
            labels: data.evolucion.map(e => 
                e.anio + '-' + String(e.mes).padStart(2, '0')
            ),
            datasets: [{
                label: 'Tickets por mes',
                data: data.evolucion.map(e => e.total),
                fill: false,
                tension: 0.1
            }]
        }
    });

});