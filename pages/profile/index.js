$(document).ready(function() {

    let oldVal, newVal;

    $('.info').keydown(function(event){
        if(event.keyCode === 13) {
            event.preventDefault();
            return false;
        }
    });

    $('#name_id').focus(function () {
        oldVal = $(this).text();
    }).blur(function (){
        newVal = $(this).text();
        if(newVal !== oldVal){
            $.ajax({
                url: 'profile.php',
                type: 'POST',
                data: { option: 'name', newVal: newVal, id: id},
                success: function (res){
                    console.log(res);
                },
                error: function () {
                    alert("Error!");
                },
            })
        }
    });

    $('#class_id').focus(function () {
        oldVal = $(this).text();
    }).blur(function (){
        newVal = $(this).text();
        if(newVal !== oldVal){
            newVal = newVal.replace('Предметы: ', '');
            $.ajax({
                url: 'profile.php',
                type: 'POST',
                data: { option: 'class', newVal: newVal, id: id},
                success: function (res){
                    console.log(res);
                },
                error: function () {
                    alert("Error!");
                },
            })
        }
    });

    $('#phone_id').focus(function () {
        oldVal = $(this).text();
    }).blur(function (){
        newVal = $(this).text();
        if(newVal !== oldVal){
            $.ajax({
                url: 'profile.php',
                type: 'POST',
                data: { option: 'phone', newVal: newVal, id: id},
                success: function (res){
                    console.log(res);
                },
                error: function () {
                    alert("Error!");
                },
            })
        }
    });

    $('#skype_id').focus(function () {
        oldVal = $(this).text();
    }).blur(function (){
        newVal = $(this).text();
        if(newVal !== oldVal){
            $.ajax({
                url: 'profile.php',
                type: 'POST',
                data: { option: 'skype', newVal: newVal, id: id},
                success: function (res){
                    console.log(res);
                },
                error: function () {
                    alert("Error!");
                },
            })
        }
    });

});