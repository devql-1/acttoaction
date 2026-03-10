<div style="position:relative; height:320px;">
    <canvas id="dynamicChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('dynamicChart'), {
        type: 'bar',
        data: {
            labels: @json($chartData->pluck('name')),
            datasets: [{
                label: 'Score (%)',
                data: @json($chartData->pluck('score')),
                backgroundColor: @json($chartData->pluck('color')->map(fn($c) => $c . '99')),
                borderColor: @json($chartData->pluck('color')),
                borderWidth: 2,
                borderRadius: 10,
                borderSkipped: false,
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
                    ticks: { font: { size: 12, weight: '600' } },
                    grid: { display: false }
                }
            },
            animation: { duration: 1200, easing: 'easeOutQuart' }
        }
    });
</script>