import jQuery from "jquery";
window.$ = jQuery;

$(document).ready(function () {
    // Ketika idThnAjaran dipilih
    $("#idThnAjaran").on("change", function () {
        const tahunAjaran = $(this).val();

        // Request ke server untuk mengambil data kelas berdasarkan idThnAjaran
        $.ajax({
            url:
                "/dashboard/presensi/tambah-presensi/" +
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

                // Empty the element with id "idPelajaran"
                $("#idPelajaran").empty();

                // Create a new option element
                var option = $("<option>", {
                    value: "Pelajaran",
                    text: "Pelajaran",
                    selected: true,
                    hidden: true,
                    disabled: true,
                });

                // Append the option element to the element with id "idPelajaran"
                $("#idPelajaran").append(option);

                // Clear the value of namaGuru field
                $("#namaGuru").val("");

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
        const kelas = $(this).val();

        // Request ke server untuk mengambil data nmPelajaran berdasarkan idKelas
        $.ajax({
            url: "/dashboard/presensi/tambah-presensi/" + kelas + "/getKelas",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Empty the element with id "idPelajaran"
                $("#idPelajaran").empty();

                // Create a new option element
                var option = $("<option>", {
                    value: "Pelajaran",
                    text: "Pelajaran",
                    selected: true,
                    hidden: true,
                    disabled: true,
                });

                // Append the option element to the element with id "idPelajaran"
                $("#idPelajaran").append(option);

                // Clear the value of namaGuru field
                $("#namaGuru").val("");

                // Clear showSiswaTable
                $("#siswaTable tbody").empty();

                // Tambahkan option nmPelajaran pada dropdown
                $.each(data, function (key, value) {
                    $("#idPelajaran").append(
                        '<option value="' +
                            value.pelajaran.idPelajaran +
                            '">' +
                            value.pelajaran.nmPelajaran +
                            "</option>"
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    // Ketika idPelajaran dipilih
    $("#idPelajaran").on("change", function () {
        const pelajaran = $(this).val();

        $.ajax({
            url:
                "/dashboard/presensi/tambah-presensi/" +
                pelajaran +
                "/getPelajaran",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Tampilkan data ke form namaGuru
                $("#namaGuru").val(data[0].guru.namaGuru);

                // Tambahkan input idJadwal pada form
                $("#idJadwal").val(data[0].idJadwal);

                // Request data siswa berdasarkan nis
                const nis = $("#idKelas").val(); // Get the nis from the selected option
                $.ajax({
                    url:
                        "/dashboard/presensi/tambah-presensi/" +
                        nis +
                        "/getSiswa",
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
                "pl-6 border-none hover:border-none bg-transparent hover:bg-gray-50"
            )
            .attr("type", "text")
            .attr("name", "NIS[]") // Tambahkan tanda kurung siku ([]) untuk menandakan bahwa ini adalah array
            .attr("readonly", true)
            .val(siswa.siswa.NIS);
        const nisCell = $("<td>").append(nisInput);
        row.append(nisCell);

        // Buat elemen <td> untuk menampilkan nama siswa
        const namaCell = $("<td>").addClass("pl-6").text(siswa.siswa.nmSiswa);
        row.append(namaCell);

        // Buat elemen <select> untuk status siswa
        const selectCell = $("<td>").addClass("pl-20");
        const selectStatus = $("<select>")
            .addClass("field-input-indigo mt-1 w-40")
            .attr("name", "status[]") // Tambahkan tanda kurung siku ([]) untuk menandakan bahwa ini adalah array
            .prop("required", true);
        // Tambahkan option-option ke dalam select
        ["Hadir", "Izin", "Sakit", "Alpha"].forEach(function (optionValue) {
            const option = $("<option>")
                .attr("value", optionValue)
                .text(optionValue);
            selectStatus.append(option);
        });
        selectCell.append(selectStatus);
        row.append(selectCell);

        // Tambahkan baris ke dalam tbody
        siswaTableBody.append(row);
    });
}

function datetime() {
    const dateInput = document.getElementById("datetime");
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const day = date.getDate();
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const seconds = date.getSeconds();

    const currentDate = `${year}-${month < 10 ? `0${month}` : month}-${
        day < 10 ? `0${day}` : day
    }T${hours < 10 ? `0${hours}` : hours}:${
        minutes < 10 ? `0${minutes}` : minutes
    }`;

    dateInput.value = currentDate;
}

datetime();

function hideScrollTopButton() {
    const scrollTopButton = document.getElementById("scroll-button");

    if (window.pageYOffset < 200) {
        scrollTopButton.style.display = "none";
    } else {
        scrollTopButton.style.display = "block";
    }
}

window.addEventListener("scroll", hideScrollTopButton);
