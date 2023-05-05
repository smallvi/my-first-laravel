<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <title>CRUD test - Yeo</title>
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
                <a href="{{ route('todos.create') }}" class="btn btn-primary">Create New Todo</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-bordered" id="table">
                    <theader>
                        <tr>
                            <td>Id</td>
                            <td>Todo</td>
                            <td>Time Updated</td>
                            <td>Action</td>
                        </tr>
                    </theader>
                    <tbody>
                        @foreach ($todos as $todo)
                        <tr>
                            <td>{{ $todo->id }}</td>
                            <td>{{ $todo->todo }}</td>
                            <td>{{ $todo->updated_at }}</td>
                            <td class="d-flex flex-row">
                                <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-primary mx-2">Update</a>
                                <form action="{{ route('todos.destroy', $todo->id ) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-2">Delete</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(function() {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('index') }}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' }
                    ]
                });
            });
        </script>
</body>

</html>