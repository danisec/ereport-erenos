import "./bootstrap";
import jQuery from "jquery";
import Alpine from "alpinejs";
import "./mappingkelas";

if (
    window.location.pathname == "/dashboard" ||
    window.location.pathname == "/dashboard/"
) {
    import("./chartGuruSiswa")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./chartGuruSiswa:", error);
        });
    import("./chartSiswa")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./chartSiswa:", error);
        });
    import("./chartGuru")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./chartGuru:", error);
        });
}

if (window.location.pathname.includes("/dashboard/pengumuman/")) {
    import("./dateTime")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./dateTime:", error);
        });
    import("./tinymce")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./tinymce:", error);
        });
}

if (window.location.pathname.includes("/dashboard/presensi/")) {
    import("./presensi")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./presensi:", error);
        });
}

if (window.location.pathname === "/dashboard/presensi") {
    import("./filterSearchPresensi")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./filterSearchPresensi:", error);
        });
}

if (window.location.pathname === "/dashboard/materi/tambah-materi") {
    import("./tabelMateri")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./tabelMateri:", error);
        });
}

if (
    window.location.pathname.includes("/dashboard/materi/") ||
    window.location.pathname.includes("/dashboard/pelajaran/")
) {
    import("./textareaMateri")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./textareaMateri:", error);
        });
}

if (window.location.pathname === "/dashboard/nilai/tambah-nilai") {
    import("./date")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./date:", error);
        });
}

if (window.location.pathname.includes("/dashboard/nilai/")) {
    import("./nilai")
        .then((module) => {})
        .catch((error) => {
            console.error("Gagal mengimpor ./nilai:", error);
        });
}

window.$ = jQuery;
window.Alpine = Alpine;

Alpine.start();
