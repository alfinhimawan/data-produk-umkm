document.addEventListener("DOMContentLoaded", function () {
    // Grafik penambahan produk per bulan (line chart)
    const area = document.getElementById("produkPerBulanChart");
    if (area) {
        let produkDataJson = document.getElementById('produkPerBulanData');
        let chartData = { labels: [], data: [] };
        if (produkDataJson) {
            try {
                chartData = JSON.parse(produkDataJson.textContent);
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
                        label: "Produk Ditambahkan",
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

    // Grafik jumlah produk per kategori (doughnut chart)
    const doughnut = document.getElementById("produkPerKategoriChart");
    if (doughnut) {
        let kategoriBarJson = document.getElementById('produkPerKategoriData');
        let barData = { labels: [], data: [] };
        if (kategoriBarJson) {
            try {
                barData = JSON.parse(kategoriBarJson.textContent);
            } catch (e) {}
        }
        const colors = [
            "#36b9cc", "#1cc88a", "#e74a3b", "#f6c23e", "#858796", "#4e73df", "#fd7e14", "#20c997", "#6f42c1", "#e83e8c"
        ];
        new Chart(doughnut.getContext("2d"), {
            type: "doughnut",
            data: {
                labels: barData.labels.length ? barData.labels : ["Kategori 1", "Kategori 2", "Kategori 3"],
                datasets: [
                    {
                        label: "Jumlah Produk",
                        data: barData.data.length ? barData.data : [0,0,0],
                        backgroundColor: barData.labels.map((_, i) => colors[i % colors.length]),
                        borderWidth: 1,
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
