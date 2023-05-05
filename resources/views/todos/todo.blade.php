<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>CRUD (Ajax) test - Yeo</title>
</head>

<body>
    <div class="container mt-2">
        <h1>{{$title}}</h1>
        @if ($message = Session::get('success'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-success">{{$message}}</p>
            </div>
        </div>
        @endif

        <div class="row mt-3">
            <div class="col-md-12">
                <!-- <a href="{{ route('todos.create') }}" class="btn btn-primary">Create New Todo</a> -->
                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Todo</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-bordered" id="todo-table">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Todo</td>
                            <td>Time Updated</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

    <div class="modal" tabindex="-1" role="dialog" id="todo-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="todo-modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="todoForm" name="todoForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">

                            <div class="row">
                                <label for="name" class="col-sm-2 control-label">Todo</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="todo" name="todo" placeholder="Enter Todo" maxlength="50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p id="error-modal" class="text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#todo-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('todos.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'todo',
                    name: 'todo'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    });

    function add() {
        $('#todoForm').trigger("reset");
        $('#todo-modal-title').html("Add Todo");
        $('#id').val('');
        $('#todo-modal').modal('show');
    }

    $('#todoForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('todos.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#todo-modal").modal('hide');
                var oTable = $('#todo-table').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save").attr("disabled", false);
            },
            error: function(data) {
                $("#error-modal").html("Please input at least 3 character");
                console.log(data);
            }
        });
    });

    function edit(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('edit-todo') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                $('#todo-modal-title').html("Edit Company");
                $('#todo-modal').modal('show');
                $('#id').val(res.id);
                $('#todo').val(res.todo);
            }
        });
    }

    function del(id) {
        if (confirm("Delete Record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('delete-todo') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    var oTable = $('#todo-table').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }
</script>

</html>