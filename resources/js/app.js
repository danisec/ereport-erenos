import "./bootstrap";
import Alpine from "alpinejs";
import "./mappingkelas";

if (window.location.pathname === "/dashboard/presensi/tambah-presensi") {
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

window.Alpine = Alpine;

Alpine.start();

import jQuery from "jquery";
window.$ = jQuery;
