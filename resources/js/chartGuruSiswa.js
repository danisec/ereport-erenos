const guruSiswa = document.getElementById("guruSiswa");

const siswaCount = parseInt(guruSiswa.dataset.siswaCount, 10);
const guruCount = parseInt(guruSiswa.dataset.guruCount, 10);

new Chart(guruSiswa, {
    type: "bar",
    data: {
        labels: [""],
        datasets: [
            {
                label: "Siswa",
                data: [siswaCount],
                backgroundColor: "rgba(0, 58, 255, 0.8)",
                borderWidth: 1,
            },
            {
                label: "Guru",
                data: [guruCount],
                backgroundColor: "rgba(255, 99, 132, 1)",
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
