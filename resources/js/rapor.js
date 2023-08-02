import jQuery from "jquery";
window.$ = jQuery;

$(document).ready(function () {
    // Ketika idThnAjaran dipilih
    $("#idThnAjaran").on("change", function () {
        const tahunAjaran = $(this).val();

        // Request ke server untuk mengambil data kelas berdasarkan idThnAjaran
        $.ajax({
            url: "/dashboard/rapor/" + tahunAjaran + "/getThnAjaran",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Empty the element with id "idKelas"
                $("#idKelas").empty();

                // Create a new option element
                var option = $("<option>", {
                    value: "Kelas",
                    text: "Kelas",
                    selected: true,
                    hidden: true,
                    disabled: true,
                });

                // Append the option element to the element with id "idKelas"
                $("#idKelas").append(option);

                // Empty the element with id "NIS"
                $("#NIS").empty();

                // Create a new option element
                var option = $("<option>", {
                    value: "Siswa",
                    text: "Siswa",
                    selected: true,
                    hidden: true,
                    disabled: true,
                });

                // Append the option element to the element with id "NIS"
                $("#NIS").append(option);

                // Tambahkan option nmKelas pada dropdown
                $.each(data, function (key, value) {
                    $("#idKelas").append(
                        '<option value="' +
                            value.kelas.idKelas +
                            '">' +
                            value.kelas.kelas +
                            "</option>"
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    // Ketika idKelas dipilih
    $("#idKelas").on("change", function () {
        const kelas = $(this).val();

        // Request ke server untuk mengambil data NIS berdasarkan idKelas
        $.ajax({
            url: "/dashboard/rapor/" + kelas + "/getSiswa",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Empty the element with id "NIS"
                $("#NIS").empty();

                // Create a new option element
                var option = $("<option>", {
                    value: "Siswa",
                    text: "Siswa",
                    selected: true,
                    hidden: true,
                    disabled: true,
                });

                // Append the option element to the element with id "NIS"
                $("#NIS").append(option);

                // Tambahkan option NIS pada dropdown
                $.each(data, function (key, value) {
                    $("#NIS").append(
                        '<option value="' +
                            value.siswa.NIS +
                            '">' +
                            value.siswa.nmSiswa +
                            "</option>"
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    // Get base url
    const baseURL = window.location.origin;

    // Ketika NIS dipilih
    $("#NIS").on("change", function () {
        const tahunAjaran = $("#idThnAjaran").val();
        const nis = $(this).val();

        // Permintaan AJAX untuk memeriksa keberadaan data rapor berdasarkan NIS dan tahun ajaran
        $.ajax({
            url: `/dashboard/rapor/${tahunAjaran}/${nis}/cekRapor`,
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data.data) {
                    // Jika data rapor sudah ada, redirect ke halaman edit
                    const idRapor = data.data.idRapor;
                    const editUrl = `${baseURL}/dashboard/rapor/ubah-rapor/${idRapor}/edit`;
                    $("a.ml-48").attr("href", editUrl);
                } else {
                    // Jika data rapor belum ada, redirect ke halaman tambah rapor
                    const tambahUrl = `${baseURL}/dashboard/rapor/tambah-rapor/${tahunAjaran}/${nis}`;
                    $("a.ml-48").attr("href", tambahUrl);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                // Jika terjadi error, redirect ke halaman tambah rapor
                const tambahUrl = `${baseURL}/dashboard/rapor/tambah-rapor/${tahunAjaran}/${nis}`;
                $("a.ml-48").attr("href", tambahUrl);
            },
        });
    });
});
