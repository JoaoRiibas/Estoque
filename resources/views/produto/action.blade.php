<a onclick="openModal('{{route('produto.form', $id)}}')" class="btn text-primary"><i class="fa fa-edit"></i></a>

<a onclick="openModal('{{route('produto.detalhes', $id)}}')" class="btn text-primary"><i class="fa fa-info-circle"></i></a>

<form method="POST" action="{{route('produto.delete', $id)}}">
    @csrf
    {{ method_field('DELETE') }}

    <button type="submit" class="btn text-danger"><i class="fa fa-trash-o"></i></button>    
</form>