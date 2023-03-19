<div class="actions">
    <a href="{{ route('buku.update', $data->id) }}" class="btn btn-link btn-info edit" data-id="{{ $data->id }}"><i
            class="fa fa-edit"></i></a>
    <a href="#" id="delete" class="btn btn btn-link btn-danger delete" data-id="{{ $data->id }}"><i
            class="fa fa-times"></i></a>
</div>
