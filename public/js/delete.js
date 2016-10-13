$(document).ready(function() {
    function sleep(time) {
        return new Promise((resolve) => setTimeout(resolve, time));
    }

    $("#delete-modal").on("show.bs.modal", function(modal) {
        window.delete_id = $(modal.relatedTarget).data("id");
        var name = $(modal.relatedTarget).data("name");

        $(".modal-body strong:last").text(name);
    });

    $("#delete-confirm").click(function() {
        $("#delete-modal").modal("hide");
        $("#ajax-loading").show();

        $.ajax({
            url: $("#delete-modal").data("url") + window.delete_id,
            type: "POST",
            data: {_method: "delete", _token: window.Laravel.csrfToken},
            success: function(data) {
                $("#alert-box").addClass(data.class);
                $("#alert-message").text(data.message);
                $("#alert-box").show();
            }
        });

        sleep(3000).then(() => {
            window.location.reload();
        });
    });

});
