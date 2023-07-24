import jQuery from "jquery";
window.$ = jQuery;

$(document).ready(function () {
    // Ketika idThnAjaran dipilih
    $("#idThnAjaran").on("change", function () {
        const tahunAjaran = $(this).val();

        // Request ke server untuk mengambil data kelas berdasarkan idThnAjaran
        $.ajax({
            url:
                "/dashboard/nilai/tambah-nilai/" +
                tahunAjaran +
                "/getTahunAjaran",
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

                // Clear showSiswaTable
                $("#siswaTable tbody").empty();

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
        const nis = $("#idKelas").val();

        // Request ke server untuk mengambil data siswa berdasarkan idKelas
        $.ajax({
            url: "/dashboard/nilai/tambah-nilai/" + nis + "/getSiswa",
            type: "GET",
            dataType: "json",
            success: function (siswaData) {
                // Panggil fungsi showSiswaTable dengan parameter data siswa
                showSiswaTable(siswaData);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

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

function showSiswaTable(siswaData) {
    // Dapatkan referensi tbody dari tabel siswa
    const siswaTableBody = $("#siswaTable tbody");

    // Hapus semua baris pada tabel siswa
    $("#siswaTable tbody").empty();

    // Iterasi melalui setiap objek siswa dalam data siswa
    siswaData.forEach(function (siswa, index) {
        // Buat elemen <tr> untuk setiap siswa
        const row = $("<tr>").addClass(
            "bg-white text-base font-medium leading-5 hover:bg-gray-50"
        );

        // Buat elemen <th> untuk nomor urut
        const indexCell = $("<th>")
            .addClass("px-9")
            .attr("scope", "row")
            .text(index + 1);
        row.append(indexCell);

        // Buat elemen <input> untuk NIS siswa
        const nisInput = $("<input>")
            .addClass(
                "pl-3 border-none hover:border-none bg-transparent hover:bg-gray-50"
            )
            .attr("type", "text")
            .attr("name", "NIS[]") // Tambahkan tanda kurung siku ([]) untuk menandakan bahwa ini adalah array
            .attr("readonly", true)
            .val(siswa.siswa.NIS);
        const nisCell = $("<td>").append(nisInput);
        row.append(nisCell);

        // Buat elemen <td> untuk menampilkan nama siswa
        const namaCell = $("<td>").addClass("pl-3").text(siswa.siswa.nmSiswa);
        row.append(namaCell);

        // Buat elemen <input /> untuk nilai siswa
        const inputCell = $("<td>").addClass("pl-3");
        const nilaiInput = $("<input>")
            .addClass("field-input-indigo text-md nilai-input w-40 font-normal")
            .attr("type", "text")
            .attr("name", "nilai[]")
            .attr("placeholder", "Nilai")
            .attr("required", true);
        inputCell.append(nilaiInput);
        row.append(inputCell);

        // Tambahkan baris ke dalam tbody
        siswaTableBody.append(row);
    });
}
