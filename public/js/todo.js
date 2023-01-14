/*
document.getElementById("sendTodoItem").addEventListener("click", function(event){
    event.preventDefault()
});

$('#sendTodoItem').submit(function (evt) {
    evt.preventDefault();
    window.history.back();
});*/

function editToDoItem(id){
    console.log(id)
    document.getElementById("openEditModal").click();
    // изменяем адрес формы
    let frm = document.getElementById('sendEditItem')
    console.log(frm.action)
    action =frm.action;
    action=   action.substr(0, action.lastIndexOf("/"));
    console.log(action);
    action+='/'+id
    document.getElementById('sendEditItem').action = action;

    $.ajax({
        type: "GET",
        url: action,

        success: function (data) {  console.log(data.data);
              document.getElementById('edit-title').value=data.data.title
              document.getElementById('edit-description').value=data.data.description
        }
    });
}

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
                    html += '<td>'
                    html += '<button onclick="editToDoItem('+item.id+')"> Редактировать </button>'
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


    $(function () {
        var frm = $('#sendEditItem');

        frm.submit(function (ev) {
            ev.preventDefault();
            $.ajax({
                type: 'put',
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
