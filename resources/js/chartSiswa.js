const siswaChart = document.getElementById("siswaChart");

const tahunAkademikSiswa = JSON.parse(siswaChart.dataset.tahunAkademikSiswa);
const jumlahSiswa = JSON.parse(siswaChart.dataset.jumlahSiswa);

new Chart(siswaChart, {
    type: "bar",
    data: {
        labels: tahunAkademikSiswa.map((tahun) => "Tahun Akademik: " + tahun),
        datasets: [
            {
                label: "Jumlah Siswa",
                data: jumlahSiswa,
                fill: false,
                borderColor: "rgba(0, 58, 255, 0.8)",
                backgroundColor: "rgba(0, 58, 255, 0.8)",
                tension: 0.1,
                borderWidth: 1,
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
