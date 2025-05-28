document.addEventListener("DOMContentLoaded", function () {
    try {
        const umkmPerBulan = JSON.parse(
            document.getElementById("umkmPerBulanData").textContent
        );
        const areaCtx = document
            .getElementById("umkmAreaChart")
            .getContext("2d");
        new Chart(areaCtx, {
            type: "line",
            data: {
                labels: umkmPerBulan.labels,
                datasets: [
                    {
                        label: "UMKM Baru",
                        data: umkmPerBulan.data,
                        backgroundColor: "rgba(28, 200, 138, 0.1)",
                        borderColor: "rgba(28, 200, 138, 1)",
                        borderWidth: 2,
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(28, 200, 138, 1)",
                        pointBorderColor: "rgba(28, 200, 138, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
                        pointHoverBorderColor: "rgba(28, 200, 138, 1)",
                        fill: true,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: { title: { display: true, text: "Bulan" } },
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: "Jumlah UMKM" },
                    },
                },
            },
        });
    } catch (e) {
        console.error("Gagal render AreaChart UMKM:", e);
    }

    try {
        let originalPieData = JSON.parse(
            document.getElementById("umkmPieData").textContent
        );
        let pieChart = window.pieChartInstance;
        if (!pieChart) {
            const pieCtx = document.getElementById("umkmPieChart").getContext("2d");
            pieChart = new Chart(pieCtx, {
                type: "pie",
                data: {
                    labels: Object.keys(originalPieData),
                    datasets: [
                        {
                            data: Object.values(originalPieData),
                            backgroundColor: ["#1cc88a", "#e74a3b"],
                            borderWidth: 2,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                },
            });
            window.pieChartInstance = pieChart;
        }
        document.querySelectorAll(".pie-filter").forEach(function (el) {
            el.addEventListener("click", function () {
                const status = this.getAttribute("data-status");
                if (status === "Aktif") {
                    pieChart.data.labels = ["Aktif"];
                    pieChart.data.datasets[0].data = [originalPieData["Aktif"] || 0];
                    pieChart.data.datasets[0].backgroundColor = ["#1cc88a"];
                } else if (status === "Nonaktif") {
                    pieChart.data.labels = ["Nonaktif"];
                    pieChart.data.datasets[0].data = [originalPieData["Nonaktif"] || 0];
                    pieChart.data.datasets[0].backgroundColor = ["#e74a3b"];
                }
                pieChart.update();
            });
        });
    } catch (e) {
        console.error("Gagal render PieChart UMKM (interaktif):", e);
    }
});
