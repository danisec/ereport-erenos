import jQuery from "jquery";
window.$ = jQuery;

$(document).ready(function () {
    // Ketika idThnAjaran dipilih
    $("#idThnAjaran").on("change", function () {
        const tahunAjaran = $(this).val();

        // Request ke server untuk mengambil data kelas berdasarkan idThnAjaran
        $.ajax({
            url:
                "/dashboard/history-siswa/tambah-historysiswa/" +
                tahunAjaran +
                "/getThnAjaran",
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
            url:
                "/dashboard/history-siswa/tambah-historysiswa/" +
                kelas +
                "/getSiswa",
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
});
