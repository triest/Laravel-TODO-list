@extends('layouts.app')

@section('content')

    <div class="container mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Создать запись.
        </button>
        <button type="button" id="openEditModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" hidden="hidden">
        </button>
        <button type="button" id="openViewModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal" hidden="hidden">
        </button>
    </div>

    <table id="tableID" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
        </tr>
        </thead>
        <tbody id="tbody"></tbody>
    </table>

    <div id="tagsCloud"></div> <button onclick="getToDoList()">Сбросить</button>


    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="sendTodoItem" name="sendTodoItem" action="{{route('todo-list.store')}}" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Описание</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <button type="button" id="closeModel" class="btn btn-secondary" data-bs-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="sendEditItem" name="sendEditItem" action="{{route('todo-list.update',['todo_list'=>1])}}" method="post">
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Заголовок</label>
                        <input type="text" class="form-control" id="edit-title" name="title" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Описание</label>
                        <textarea class="form-control" id="edit-description" name="description"></textarea>
                    </div>
                    <button type="button" id="closeModelUpload" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <form id="uploadModel" name="uploadModel" action="{{route('attachment.store',['todo_list'=>1])}}" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Название файла</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Название файла</label>
                        <input name="file" type="file" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <form id="addTag" name="addTag" action="{{route('todo-list.add-tag',['todo_list'=>1])}}" method="post">
                    <button type="submit" class="btn btn-primary">Добавить тег</button>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="viewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="sendEditItem" name="sendEditItem" action="{{route('todo-list.update',['todo_list'=>1])}}" method="post">
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Заголовок</label>
                        <input type="text" class="form-control" id="view-title" name="title" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Описание</label>
                        <textarea class="form-control" id="view-description" name="description" readonly></textarea>
                    </div>
                    <div id="images"></div>
                    <button type="button" id="closeModelUpload" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                    </button>
                </form>

            </div>
        </div>
    </div>

@endsection
