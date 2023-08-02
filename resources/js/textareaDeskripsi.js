import jQuery from "jquery";
window.$ = jQuery;

$(document).ready(function () {
    $(document).ready(function () {
        function adjustTextareaHeight() {
            // Menggunakan method each untuk mengiterasi melalui semua elemen dengan class deskripsiTextarea
            $(".deskripsiTextarea").each(function () {
                // Menggunakan this untuk merujuk ke elemen textarea saat ini
                this.style.height = "auto"; // Reset tinggi textarea
                this.style.height = this.scrollHeight + "px"; // Atur tinggi textarea sesuai dengan kontennya
            });
        }

        // Panggil fungsi adjustTextareaHeight saat dokumen siap dan teks awal diisi
        adjustTextareaHeight();

        // Panggil fungsi adjustTextareaHeight saat teks berubah dalam textarea
        $(document).on("input", ".deskripsiTextarea", function () {
            adjustTextareaHeight();
        });
    });
});
