document.addEventListener("DOMContentLoaded", function () {
    // Area Chart: UMKM Baru per Bulan
    const area = document.getElementById("umkmAreaChart");
    if (area) {
        let umkmDataJson = document.getElementById('umkmPerBulanData');
        let chartData = { labels: [], data: [] };
        if (umkmDataJson) {
            try {
                chartData = JSON.parse(umkmDataJson.textContent);
            } catch (e) {}
        }
        new Chart(area.getContext("2d"), {
            type: "line",
            data: {
                labels: chartData.labels.length ? chartData.labels : [
                    "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
                ],
                datasets: [
                    {
                        label: "UMKM Baru",
                        data: chartData.data.length ? chartData.data : [0,0,0,0,0,0,0,0,0,0,0,0],
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        borderWidth: 2,
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
            },
        });
    }

    // Pie Chart: Status UMKM
    const pie = document.getElementById("umkmPieChart");
    if (pie) {
        let umkmPieJson = document.getElementById('umkmPieData');
        let pieData = { Aktif: 0, Nonaktif: 0 };
        if (umkmPieJson) {
            try {
                pieData = JSON.parse(umkmPieJson.textContent);
            } catch (e) {}
        }
        new Chart(pie.getContext("2d"), {
            type: "pie",
            data: {
                labels: ["Aktif", "Nonaktif"],
                datasets: [
                    {
                        data: [pieData.Aktif || 0, pieData.Nonaktif || 0],
                        backgroundColor: ["#1cc88a", "#e74a3b"],
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: { legend: { position: "bottom" } },
            },
        });
    }
});
