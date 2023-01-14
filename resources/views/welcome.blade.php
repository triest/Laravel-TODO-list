@extends('layouts.app')

@section('content')

    <div class="container mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Создать запись.
        </button>
        <button type="button" id="openEditModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" hidden="hidden">

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

    <div id="tagsCloud"></div>


    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="sendTodoItem" name="sendTodoItem" action="{{route('todo-list.store')}}" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <button type="button" id="closeModel" class="btn btn-secondary" data-bs-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="text" class="form-control" id="edit-title" name="title" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <textarea class="form-control" id="edit-description" name="description"></textarea>
                    </div>
                    <button type="button" id="closeModel" class="btn btn-secondary" data-bs-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
