const guruChart = document.getElementById("guruChart");

const tahunAkademikGuru = JSON.parse(guruChart.dataset.tahunAkademikGuru);
const jumlahGuru = JSON.parse(guruChart.dataset.jumlahGuru);

new Chart(guruChart, {
    type: "bar",
    data: {
        labels: tahunAkademikGuru.map((tahun) => "Tahun Akademik: " + tahun),
        datasets: [
            {
                label: "Jumlah Guru",
                data: jumlahGuru,
                fill: false,
                borderColor: "rgba(255, 99, 132, 1)",
                tension: 0.1,
                borderWidth: 1,
                backgroundColor: "rgba(255, 99, 132, 1)",
            },
        ],
    },
    options: {
        scales: {
            x: {
                grid: {
                    color: "white", // Ubah menjadi 'white' untuk warna grid sumbu x menjadi putih
                },
                ticks: {
                    color: "white", // Ubah menjadi 'white' untuk warna tulisan data tahun menjadi putih
                },
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: "white", // Ubah menjadi 'white' untuk warna tulisan data jumlah siswa menjadi putih
                },
            },
        },
        plugins: {
            legend: {
                labels: {
                    color: "white", // Ubah menjadi 'white' untuk tulisan label menjadi putih
                },
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        var label = context.dataset.label || "";

                        if (label) {
                            label += ": ";
                        }

                        if (context.parsed.y !== null) {
                            label += context.parsed.y;
                        }

                        return label;
                    },
                },
            },
        },
    },
});
