<div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <!-- <a class="" href="{{ route('todos.edit', $id) }}">Update</a> -->
        <a class="dropdown-item" href="javascript:void(0)" data-toggle="tooltip" onClick="edit({{ $id }})" data-original-title="Edit">
            Edit
        </a>
        <a class="dropdown-item" href="javascript:void(0)" data-toggle="tooltip" onClick="del({{ $id }})" data-original-title="Delete">
            Delete
        </a>
        <!-- <form action="{{ route('todos.destroy', $id) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="DELETE" />
            <button type="submit" class="dropdown-item">Delete</a>
        </form> -->

    </div>
</div>