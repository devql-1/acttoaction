<div class="graph-wrap">
    <canvas id="dynamicChart"></canvas>
</div>
<script>
    (function() {
        const mob = window.innerWidth < 576;
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
                    borderRadius: mob ? 6 : 10,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { label: ctx => ' Score: ' + ctx.parsed.y + '%' }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: { callback: v => v + '%', font: { size: mob ? 10 : 12 } },
                        grid: { color: '#f0f4fb' }
                    },
                    x: {
                        ticks: {
                            font: { size: mob ? 9 : 12, weight: '600' },
                            maxRotation: mob ? 45 : 0,
                            minRotation: mob ? 45 : 0,
                        },
                        grid: { display: false }
                    }
                },
                animation: { duration: 1200, easing: 'easeOutQuart' }
            }
        });
    })();
</script>