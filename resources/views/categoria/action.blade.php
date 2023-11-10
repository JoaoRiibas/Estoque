<a onclick="openModal('{{route('categoria.form', $categoria->id)}}')" class="btn text-primary"><i class="fa fa-edit"></i></a>

<form method="POST" action="{{route('categoria.delete', $categoria->id)}}">
    @csrf
    {{ method_field('DELETE') }}

    <button type="submit" class="btn text-danger"><i class="fa fa-trash-o"></i></button>    
</form>