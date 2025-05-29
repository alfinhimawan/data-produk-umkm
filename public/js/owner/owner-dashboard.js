document.addEventListener("DOMContentLoaded", function () {
    const area = document.getElementById("produkAreaChart");
    if (area) {
        new Chart(area.getContext("2d"), {
            type: "line",
            data: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agu",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
                datasets: [
                    {
                        label: "Produk",
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
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

    const pie = document.getElementById("kategoriPieChart");
    if (pie) {
        new Chart(pie.getContext("2d"), {
            type: "pie",
            data: {
                labels: ["Kategori 1", "Kategori 2", "Kategori 3"],
                datasets: [
                    {
                        data: [1, 1, 1],
                        backgroundColor: ["#36b9cc", "#1cc88a", "#e74a3b"],
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
