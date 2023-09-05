import jQuery from "jquery";
window.$ = jQuery;

let i = 1; // Ubah nilai awal menjadi 1, agar nomor dimulai dari 1

$("#add").click(function () {
    i++; // Increment nilai i

    $("#table").append(
        `<tr>
                <th class="px-9" scope="row">${i}</th>
                <td class="pl-3">
                    <textarea class="field-input-indigo keterangan-input w-[55rem]" name="keterangan[]" rows="1" placeholder="Deskripsi History" required></textarea>
                </td>
                <td class="w-10 text-center">
                    <button class="delete-history-btn focus:outline-none" type="button">
                        <svg class="mt-1.5 h-auto w-7" width="30" height="36" viewBox="0 0 30 36" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="30" height="36" fill="url(#pattern0)"/>
                        <defs>
                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use xlink:href="#image0_100_2277" transform="matrix(0.0104167 0 0 0.00868056 0 0.0833333)"/>
                        </pattern>
                        <image id="image0_100_2277" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAB90lEQVR4nO2XTy5DcRSFzxwLUBOsggmxKZaCnXgmJiyBWAMmmDA60uRJRPKk3q/Ve/T7kt9MmvPn3tuSAAAAAAAAAAAAarAuqZPkka/rPwNGsCbpqiH8z3cjaYMGlhO+V6kEr9grx7IDMQUsPxSzAYsL4XrGOz7v7w9OkGYP/y9LKMeijHYjf8u3/g8RV8BXIkX/I/3xBhyuP96Aw/XHG3C4/ngDDtcfb8Dh+uMNOFx/vAGH64834HD98QYcrj/egMP1xxtwuP5fG3D435ejWkCmgKxAzQaIAlqoNqFmA7ICNSdIFNBCtQk1G5AVqDlBooAWqk2o2YCsQM0JEgW0UG1CzQZkBWpOkCighWoTajYgK1BzgkQBLVSbULMBWYGaEyQKaKHahJoNyArUnCBRQAvVJtRsQFag5gSJAlqoNqFmA7ICNSdIFNBCtQk1G5AVqFftBFUjXX+8AYfrjzfgcP3xBhyuP96Aw/XHG3C4/ngDDtcfb8Dh+uMNOFy/XgYMbKo+WwPanxXE/YCJY9XnZED7nYI4HzDx1pcwUT0mffjvA9pPFcTRD3c09R0ojMsCoXlO70KBbEt6KBCeG9+TpF2Fsi/psUCIHvmmA7SncHZCz1HXb/G/4VDSWf9z7rVAwP72pppu+187cV+4AAAAAAAAAACg8nwAeGeSplaV1ioAAAAASUVORK5CYII="/>
                        </defs>
                        </svg>
                    </button>
                </td>
             </tr>`
    );

    // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menambahkan baris baru
    updateNomor();
});

$(document).on("click", ".delete-history-btn", function () {
    $(this).parents("tr").remove();
    // Memanggil fungsi updateNomor untuk memperbarui nomor setelah menghapus baris
    updateNomor();
});

// Fungsi untuk memperbarui nomor setelah menghapus atau menambahkan baris
function updateNomor() {
    let nomor = 1;
    $("#table tbody tr").each(function () {
        $(this).find("th").text(nomor);
        nomor++;
    });
}
