/*
document.getElementById("sendTodoItem").addEventListener("click", function(event){
    event.preventDefault()
});

$('#sendTodoItem').submit(function (evt) {
    evt.preventDefault();
    window.history.back();
});*/
$(function () {
    var frm = $('#sendTodoItem');
    frm.submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
              //  alert('ok');
                $("#closeModel").click();
            }
        });
        ev.preventDefault();
    });
});
