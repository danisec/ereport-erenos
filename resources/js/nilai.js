import jQuery from "jquery";
window.$ = jQuery;

$(document).ready(function () {
    // Ketika pelajaran dipilih
    $("#pelajaran").on("change", function () {
        const pelajaran = $(this).val();
        // Hapus semua option pada dropdown materi
        $("#materi").empty();
        // Request ke server untuk mengambil data materi berdasarkan idPelajaran
        $.ajax({
            url: "/dashboard/nilai/tambah-nilai/" + pelajaran + "/getPelajaran",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Tambahkan option materi pada dropdown
                $.each(data, function (key, value) {
                    $("#materi").append(
                        '<option value="' +
                            value.idMateri +
                            '">' +
                            value.materi +
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
