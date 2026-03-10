{{-- resources/views/partials/graphs/radar.blade.php --}}
<div style="position:relative; height:380px;">
    <canvas id="dynamicChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('dynamicChart'), {
        type: 'radar',
        data: {
            labels: @json($chartData->pluck('name')),
            datasets: [{
                label: 'Your Score',
                data: @json($chartData->pluck('score')),
                backgroundColor: 'rgba(23, 92, 221, 0.15)',
                borderColor: '#175cdd',
                borderWidth: 2.5,
                pointBackgroundColor: @json($chartData->pluck('color')),
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.label + ': ' + ctx.parsed.r + '%'
                    }
                }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    ticks: { display: false, stepSize: 25 },
                    grid: { color: '#e4ecf8' },
                    angleLines: { color: '#e4ecf8' },
                    pointLabels: {
                        font: { size: 12, weight: '700' },
                        color: '#3c4049'
                    }
                }
            },
            animation: { duration: 1400, easing: 'easeOutQuart' }
        }
    });
</script>