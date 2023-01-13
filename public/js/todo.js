/*
document.getElementById("sendTodoItem").addEventListener("click", function(event){
    event.preventDefault()
});

$('#sendTodoItem').submit(function (evt) {
    evt.preventDefault();
    window.history.back();
});*/


$(document).ready(function () {

    console.log("om redy")

    myfunction();

    function myfunction() {


        $.ajax({
            type: "GET",
            url: 'api/todo-list',

            success: function (data) {
                console.log(data.data);
                let html = '';

                data.data.forEach(function (item) {
                    html += '<tr>'
                    html += '<td>'
                    html += item.title
                    html += '</td>'
                    html += '<td>'
                    html += item.description
                    html += '</td>'
                    html += '</tr>'

                })
                $('#tbody').append(html);
            }
        });

    }

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
            myfunction()
        });
    });



});
