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

            $.ajax({
                url: '/pages/chat/server/send.php',
                type: 'POST',
                data: {message},
                success: function () {
                    update();
                },
                error: function () {
                    alert("Error!");
                },
            })
        }
        resetForm(this.form)
    });

    let block = document.getElementById("space_for_messages");
    block.scrollTop = block.scrollHeight;
});

function resetForm(form) {
    // clearing textarea
    let text = form.getElementsByTagName('textarea');
    for (let i = 0; i < text.length; i++)
        text[i].value = '';
    return false;
}

function update() {
    $(".list_of_mess").load('/pages/chat/server/show_mes.php', '', () => {
        console.log('Updated')
    });
    window.setTimeout(update, 10000);
    let block = document.getElementById("space_for_messages");
    block.scrollTop = block.scrollHeight;
}
