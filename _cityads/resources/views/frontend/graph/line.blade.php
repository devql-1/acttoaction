{{-- resources/views/partials/graphs/line.blade.php --}}
<div style="position:relative; height:300px;">
    <canvas id="dynamicChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const lineData = @json($chartData);

    new Chart(document.getElementById('dynamicChart'), {
        type: 'line',
        data: {
            labels: lineData.map(d => d.icon + ' ' + d.name),
            datasets: [{
                label: 'Score (%)',
                data: lineData.map(d => d.score),
                backgroundColor: 'rgba(23, 92, 221, 0.08)',
                borderColor: '#175cdd',
                borderWidth: 3,
                pointBackgroundColor: lineData.map(d => d.color),
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointRadius: 10,
                pointHoverRadius: 13,
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' Score: ' + ctx.parsed.y + '%'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: { callback: v => v + '%', font: { size: 12 } },
                    grid: { color: '#f0f4fb' }
                },
                x: {
                    ticks: { font: { size: 13, weight: '700' } },
                    grid: { display: false }
                }
            },
            animation: { duration: 1400, easing: 'easeOutQuart' }
        }
    });
</script>