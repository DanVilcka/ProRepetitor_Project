$(document).ready(function () {
    $("#send").click(function () {
        let message = $("#write").val();
        console.log(message);
        $.ajax({
            url: 'send.php',
            type: 'POST',
            data: {message: message},
            success: function (res) {
                console.log(res);
            },
            error: function () {
                alert("Error!");
            },
        })
    });
});