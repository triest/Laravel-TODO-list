/*
document.getElementById("sendTodoItem").addEventListener("click", function(event){
    event.preventDefault()
});

$('#sendTodoItem').submit(function (evt) {
    evt.preventDefault();
    window.history.back();
});*/

function editToDoItem(id) {
    document.getElementById("openEditModal").click();
    // изменяем адрес формы
    let frm = document.getElementById('sendEditItem')
    action = frm.action;
    action = action.substr(0, action.lastIndexOf("/"));
    action += '/' + id
    document.getElementById('sendEditItem').action = action;


    $.ajax({
        type: "GET",
        url: action,

        success: function (data) {
            console.log(data.data);
            document.getElementById('edit-title').value = data.data.title
            document.getElementById('edit-description').value = data.data.description
        },
        error: function(data){
            alert(data.responseJSON.message);
        }
    });

    frm = document.getElementById('uploadModel')

      action = action.substr(0, action.lastIndexOf("/"));
      console.log(action);
      action+= '/'+id + '/attachment'

    document.getElementById('uploadModel').action = action;
}


function viewToDoItem(id) {
    document.getElementById("openViewModal").click();
    // изменяем адрес формы
    let frm = document.getElementById('sendEditItem')
    action = frm.action;
    action = action.substr(0, action.lastIndexOf("/"));
    action += '/' + id
    document.getElementById('sendEditItem').action = action;
    console.log("view")

    $.ajax({
        type: "GET",
        url: action,

        success: function (data) {
            document.getElementById('view-title').value = data.data.title
            document.getElementById('view-description').value = data.data.description
            let attachment = data.data.attachment;
            console.log(attachment)

            let html = '';
            document.getElementById('images').innerHTML = html

            attachment.forEach(function (item) {
                html += '<a href="' + item.path + '" target="_blank"><img src="' + item.preview_path + ' " width="150" height="150"></a>';
            })
            $('#images').append(html);


        },
        error: function(data){
            alert(data.responseJSON.message);
        }
    });

    frm = document.getElementById('uploadModel')

    action = action.substr(0, action.lastIndexOf("/"));
    console.log(action);
    action+= '/'+id + '/attachment'

    document.getElementById('uploadModel').action = action;
}

$(document).ready(function () {

    console.log("om redy")

    getToDoList();
    getTagsList();

    function getTagsList() {
        $.ajax({
            type: "GET",
            url: 'api/tag',

            success: function (data) {
                let html = '';
                document.getElementById('tagsCloud').innerHTML = html
                data.data.forEach(function (item) {
                    html += '<button onclick="getToDoList(' + item.id + ')"> ' + item.title + ' </button>'
                })
                $('#tagsCloud').append(html);
            },
            error: function(data){
            alert(data.responseJSON.message);
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
                },
                error: function(data){
                    alert(data.responseJSON.message);
                }
            });
            ev.preventDefault();
            getToDoList()
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
                },
                error: function(data){
                    alert(data.responseJSON.message);
                }
            });
            ev.preventDefault();
            getToDoList()
        });
    });


});


$("#uploadModel").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var frm = $('#uploadModel');
    $.ajax({
        url: frm.attr('action'),
        type: 'POST',
        data: formData,
        success: function (data) {
            $("#closeModelUpload").click();
        },
        error: function(data){
            alert(data.responseJSON.message);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


function getToDoList(tag_id = null) {

    let url = 'api/todo-list';

    if (tag_id != null) {
        url += "?&tags[]=" + tag_id
    }

    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
            let html = '';
            document.getElementById('tbody').innerHTML = html

            data.data.forEach(function (item) {
                html += '<tr>'
                html += '<td>'
                html += item.title
                html += '</td>'
                html += '<td>'
                html += item.description
                html += '</td>'
                html += '<td>'
                html += '<button onclick="editToDoItem(' + item.id + ')"> Редактировать </button>'
                html += '<button onclick="viewToDoItem(' + item.id + ')"> Смотреть </button>'
                html += '</td>'
                html += '</tr>'

            })
            $('#tbody').append(html);
        },
        error: function(data){
            alert(data.responseJSON.message);
        },
    });

}
