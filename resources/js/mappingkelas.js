import jQuery from "jquery";
window.$ = jQuery;

$(document).ready(function () {
    // Ketika NIS dipilih
    $("#nis").on("change", function () {
        const nis = $(this).val();
        // Hapus semua option pada dropdown nmSiswa
        $("#nmSiswa").empty();
        // Request ke server untuk mengambil data nmSiswa berdasarkan NIS
        $.ajax({
            url: "/dashboard/mappingkelas/tambah-datasiswa/" + nis + "/getNis",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Tambahkan option nmSiswa pada dropdown
                $.each(data, function (key, value) {
                    $("#nmSiswa").append(
                        '<option value="' +
                            value.nmSiswa +
                            '">' +
                            value.nmSiswa +
                            "</option>"
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    // Ketika nmSiswa dipilih
    $("#nmSiswa").on("change", function () {
        const nmSiswa = $(this).val();
        // Hapus semua option pada dropdown nis
        $("#nis").empty();
        // Request ke server untuk mengambil data nis berdasarkan nmSiswa
        $.ajax({
            url:
                "/dashboard/mappingkelas/tambah-datasiswa/" +
                nmSiswa +
                "/getNmSiswa",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Tambahkan option nis pada dropdown
                $.each(data, function (key, value) {
                    $("#nis").append(
                        '<option value="' +
                            value.NIS +
                            '">' +
                            value.NIS +
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
