<x-app-layout title="{{ $title }}">

    <x-header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">

        @if (Auth::user()->role == 'superadmin')
            <div class="flex flex-row">
                <div class="flex flex-col gap-6" style="height:40vh; width:80vw">
                    <h2 class="text-lg font-medium text-white">Perbandingan Guru dan Siswa</h2>
                    <canvas id="guruSiswa" data-siswa-count="{{ $siswaCount }}"
                        data-guru-count="{{ $guruCount }}"></canvas>
                </div>


                <div class="flex flex-col gap-6" style="height:40vh; width:80vw">
                    <h2 class="text-lg font-medium text-white">Jumlah Siswa baru per Tahun Akademik
                    </h2>
                    <canvas id="siswaChart" data-tahun-akademik-siswa="@json($tahunAkademikSiswa)"
                        data-jumlah-siswa="@json($jumlahSiswa)"></canvas>
                </div>
            </div>

            <div class="mt-32 flex flex-col gap-6">
                <h2 class="text-lg font-medium text-white">Jumlah Guru per Tahun Akademik
                </h2>
                <canvas id="guruChart" data-tahun-akademik-guru="@json($tahunAkademikGuru)"
                    data-jumlah-guru="@json($jumlahGuru)"></canvas>
            </div>
        @endif

        @if (Auth::user()->role == 'guru')
            <div class="flex flex-col">
                <h2 class="text-lg font-medium text-white">Nilai rata-rata per Pelajaran
                </h2>
                <canvas id="nilaiChart"></canvas>
            </div>

            <div class="mt-32 flex flex-col gap-6">
                <h2 class="text-lg font-medium text-white">Presensi Siswa
                </h2>
                <canvas id="presensiChart"></canvas>
            </div>
        @endif

    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const nilaiChart = document.getElementById('nilaiChart').getContext('2d');
        const chartNilai = @json($chartNilai);

        const labels = [];
        const data = [];
        const backgroundColors = [];

        chartNilai.forEach(item => {
            const label = item.pelajaran;
            const rataRata = item.rata_rata;
            const backgroundColor = item.backgroundColor;

            labels.push(label);
            data.push(rataRata);
            backgroundColors.push(backgroundColor);
        });

        const chart = new Chart(nilaiChart, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai Rata-rata',
                    data: data,
                    backgroundColor: backgroundColors,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            color: 'white',
                        },
                        ticks: {
                            color: 'white',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                        },
                    },
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white',
                        },
                    },
                },
            },
        });
    </script>

    <script>
        let chartPresensi = {!! json_encode($chartPresensi) !!};

        let kelasLabels = chartPresensi.map(function(data) {
            return data.kelas;
        });

        // Membuat array untuk label tanggal
        let tanggalLabels = chartPresensi.map(function(data) {
            return data.tanggal[0];
        });

        // Membuat array untuk jumlah siswa hadir
        let jumlahHadirData = chartPresensi.map(function(data) {
            return data.jumlah_hadir[0];
        });

        // Membuat array untuk jumlah siswa izin
        let jumlahIzinData = chartPresensi.map(function(data) {
            return data.jumlah_izin[0];
        });

        // Membuat array untuk jumlah siswa sakit
        let jumlahSakitData = chartPresensi.map(function(data) {
            return data.jumlah_sakit[0];
        });

        // Membuat array untuk jumlah siswa alpha
        let jumlahAlphaData = chartPresensi.map(function(data) {
            return data.jumlah_alpha[0];
        });

        let backgroundColor = chartPresensi.map(function(data) {
            return data.backgroundColor;
        });

        // Membuat grafik dengan Chart.js
        let ctxPresensi = document.getElementById('presensiChart').getContext('2d');
        let presensiChart = new Chart(ctxPresensi, {
            type: 'bar',
            data: {
                labels: kelasLabels,
                datasets: [{
                    label: 'Hadir',
                    data: jumlahHadirData,
                    backgroundColor: 'rgba(0, 255, 64, 0.8)',
                    borderWidth: 1
                }, {
                    label: 'Izin',
                    data: jumlahIzinData,
                    backgroundColor: 'rgba(0, 53, 255, 0.8)',
                    borderWidth: 1
                }, {
                    label: 'Sakit',
                    data: jumlahSakitData,
                    backgroundColor: 'rgba(255, 207, 0, 0.8)',
                    borderWidth: 1
                }, {
                    label: 'Alpha',
                    data: jumlahAlphaData,
                    backgroundColor: 'rgba(255, 0, 80, 0.8)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            color: 'white',
                        },
                        ticks: {
                            color: 'white',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                        },
                    },
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white',
                        },
                    },
                },
            },
        });
    </script>

</x-app-layout>
