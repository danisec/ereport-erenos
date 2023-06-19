import jQuery from "jquery";
window.$ = jQuery;

$(document).ready(function () {
    let selectedKelas;
    let selectedThnAjaran;

    $("#idKelas").on("change", function () {
        selectedKelas = $(this).val();
        getDataThnAjaran(selectedKelas);
    });

    $("#idThnAjaran").on("change", function () {
        selectedThnAjaran = $(this).val();
        if (selectedKelas) {
            tampilkanDataPresensi(selectedKelas, selectedThnAjaran);
        }
    });

    function getDataThnAjaran(kelas) {
        $.ajax({
            url: "/dashboard/presensi/" + kelas + "/filterKelas",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $("#idThnAjaran").empty();
                const option = $("<option>", {
                    value: "Tahun",
                    text: "Tahun",
                    selected: true,
                    hidden: true,
                    disabled: true,
                });
                $("#idThnAjaran").append(option);
                $.each(data, function (key, value) {
                    $("#idThnAjaran").append(
                        '<option value="' +
                            value.tahunajaran.idThnAjaran +
                            '">' +
                            value.tahunajaran.thnAjaran +
                            "</option>"
                    );
                });
                // Manually trigger the change event of idThnAjaran
                $("#idThnAjaran").trigger("change");
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    function tampilkanDataPresensi(kelas, tahun) {
        $.ajax({
            url: "/dashboard/presensi/" + kelas + "/" + tahun + "/getPresensi",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $("#tabelData tbody").empty(); // Menghapus tabel yang sudah ada

                $.each(data, function (key, value) {
                    const row = $("<tr>", {
                        class: "bg-white text-base font-medium leading-5 hover:bg-gray-50",
                    }).append(
                        $("<th>", { scope: "row", class: "px-9" }).text(
                            key + 1
                        ),
                        $("<td>", { class: "pl-6" }).text(
                            value.jadwal.kelas.kelas
                        ),
                        $("<td>", { class: "pl-6" }).text(value.tanggal),
                        $("<td>", { class: "pl-6" }).text(
                            value.jadwal.pelajaran.nmPelajaran
                        ),
                        $("<td>", { class: "pl-6" }).text(
                            value.jadwal.guru.namaGuru
                        ),
                        $("<td>", {
                            class: "mr-3 flex flex-row items-center gap-5 2xl:m-0",
                        }).append(
                            $(document.createElement("a"))
                                .attr({
                                    href:
                                        "presensi/view-presensi/" +
                                        value.idKehadiran,
                                })
                                .append(
                                    $("<img>", {
                                        class: "h-auto w-9",
                                        src: "/assets/icons/eye.svg",
                                        alt: "detail-presensi",
                                    })
                                ),
                            $(document.createElement("a"))
                                .attr({
                                    href:
                                        "presensi/ubah-presensi/" +
                                        value.idKehadiran +
                                        "/edit",
                                })
                                .append(
                                    $("<img>", {
                                        class: "h-auto w-9",
                                        src: "/assets/icons/edit.svg",
                                        alt: "detail-presensi",
                                    })
                                ),
                            $("<button>", {
                                class: "focus:outline-none",
                                type: "button",
                                onclick: `hapusPresensi(${value.idKehadiran})`,
                            })
                                .append(
                                    $("<img>", {
                                        class: "h-auto w-9",
                                        src: "/assets/icons/trash.svg",
                                        alt: "delete-presensi",
                                    })
                                )
                                .click(function () {
                                    hapusPresensi(value.idKehadiran);
                                })
                        )
                    );
                    $("#tabelData").append(row);
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }

    // Fungsi untuk menghapus presensi
    function hapusPresensi(idKehadiran) {
        if (confirm("Apakah Anda yakin ingin menghapus presensi ini?")) {
            $.ajax({
                url: "presensi/" + idKehadiran,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    $("#tabelData")
                        .find(`tr[data-id="${idKehadiran}"]`)
                        .remove();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                },
            });
        }
    }
});
