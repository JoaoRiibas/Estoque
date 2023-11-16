<a onclick="openModal('{{route('fornecedor.form', $fornecedor->id)}}')" class="btn text-primary"><i class="fa fa-edit"></i></a>

<a onclick="openModal('{{route('fornecedor.detalhes', $fornecedor->id)}}')" class="btn text-primary"><i class="fa fa-info"></i></a>

<form method="POST" action="{{route('fornecedor.delete', $fornecedor->id)}}">
    @csrf
    {{ method_field('DELETE') }}

    <button type="submit" class="btn text-danger"><i class="fa fa-trash-o"></i></button>    
</form>