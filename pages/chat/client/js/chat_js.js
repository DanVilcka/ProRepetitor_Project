$(document).ready(function () {
    $("#mess").submit(function (e) {
        e.preventDefault();
    });
    $("#send").click(function () {
        const message = $("#write").val().replace(/\n/g, '<br/>');
        if (message === '') {
            alert('Message Empty!');
        } else {
            console.log(message);
            $.get("send.php?message=" + message)
        }
        resetForm(this.form)
    });
});

function resetForm(form) {
    // clearing textarea
    let text = form.getElementsByTagName('textarea');
    for (let i = 0; i < text.length; i++)
        text[i].value = '';
    return false;
}