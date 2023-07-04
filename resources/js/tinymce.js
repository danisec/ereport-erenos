tinymce.init({
    selector: "textarea", // change this value according to your HTML
    height: "300",
    width: "800px",
    menu: {
        edit: { title: "Edit", items: "undo, redo, selectall" },
    },
});

$(document).ready(function () {
    var formId = "#save-content-form";

    $(formId).on("submit", function (e) {
        e.preventDefault();

        var data = $(formId).serializeArray();
        data.push({
            name: "pengumuman",
            value: tinyMCE.get("tinymce").getContent(),
        });

        $.ajax({
            type: "POST",
            url: $(formId).attr("data-action"),
            data: data,
            success: function (response, textStatus, xhr) {
                window.location = response.redirectTo;
            },
            complete: function (xhr) {},
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                var response = XMLHttpRequest;
            },
        });
    });
});
