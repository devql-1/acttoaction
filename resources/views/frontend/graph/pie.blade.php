{{-- resources/views/partials/graphs/pie.blade.php --}}
<div class="row align-items-center g-4">
    <div class="col-md-6">
        <div style="position:relative; height:320px;">
            <canvas id="dynamicChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div style="display:flex; flex-direction:column; gap:12px;" id="pieLegend"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const pieData = @json($chartData);
    const pieLabels = pieData.map(d => d.name);
    const pieValues = pieData.map(d => d.score);
    const pieColors = pieData.map(d => d.color);
    const total = pieValues.reduce((a, b) => a + b, 0);

    new Chart(document.getElementById('dynamicChart'), {
        type: 'doughnut',
        data: {
            labels: pieLabels,
            datasets: [{
                data: pieValues,
                backgroundColor: pieColors.map(c => c + 'dd'),
                borderColor: '#fff',
                borderWidth: 3,
                hoverOffset: 10,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '58%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.label + ': ' + ctx.parsed + '%'
                    }
                }
            },
            animation: { duration: 1200, animateRotate: true }
        }
    });

    // Build legend
    const legend = document.getElementById('pieLegend');
    pieData.forEach(d => {
        const share = total > 0 ? Math.round((d.score / total) * 100) : 0;
        legend.innerHTML += `
        <div style="display:flex; align-items:center; gap:10px; padding:10px 14px;
                    background:#f8faff; border-radius:10px; border-left:4px solid ${d.color};">
            <div style="width:10px;height:10px;border-radius:50%;
                        background:${d.color};flex-shrink:0;"></div>
            <span style="font-size:13px;font-weight:600;flex:1;">${d.name}</span>
            <strong style="font-size:13px;color:${d.color};">${d.score}%</strong>
        </div>`;
    });
</script>