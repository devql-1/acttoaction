{{-- resources/views/partials/graphs/line.blade.php --}}
<div class="graph-wrap graph-line">
    <canvas id="dynamicChart"></canvas>
</div>
<script>
    (function() {
        const mob      = window.innerWidth < 576;
        const lineData = @json($chartData);

        new Chart(document.getElementById('dynamicChart'), {
            type: 'line',
            data: {
                labels: lineData.map(d => mob ? d.name : d.icon + ' ' + d.name),
                datasets: [{
                    label: 'Score (%)',
                    data: lineData.map(d => d.score),
                    backgroundColor: 'rgba(23, 92, 221, 0.08)',
                    borderColor: '#175cdd',
                    borderWidth: mob ? 2 : 3,
                    pointBackgroundColor: lineData.map(d => d.color),
                    pointBorderColor: '#fff',
                    pointBorderWidth: mob ? 2 : 3,
                    pointRadius: mob ? 6 : 10,
                    pointHoverRadius: mob ? 8 : 13,
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
                        ticks: { callback: v => v + '%', font: { size: mob ? 10 : 12 } },
                        grid: { color: '#f0f4fb' }
                    },
                    x: {
                        ticks: {
                            font: { size: mob ? 9 : 13, weight: '700' },
                            maxRotation: mob ? 45 : 0,
                            minRotation: mob ? 45 : 0,
                        },
                        grid: { display: false }
                    }
                },
                animation: { duration: 1400, easing: 'easeOutQuart' }
            }
        });
    })();
</script>
