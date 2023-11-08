<a onclick="openModal('{{route('marca.form', $marca->id)}}')" class="btn text-primary"><i class="fa fa-edit"></i></a>

<form method="POST" action="{{route('marca.delete', $marca->id)}}">
    @csrf
    {{ method_field('DELETE') }}

    <button type="submit" class="btn text-danger"><i class="fa fa-trash-o"></i></button>    
</form>