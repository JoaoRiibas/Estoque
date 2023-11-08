<a onclick="openModal('{{route('lote.form', $lote->id)}}')" class="btn text-primary"><i class="fa fa-edit"></i></a>

<form method="POST" action="{{route('lote.delete', $lote->id)}}">
    @csrf
    {{ method_field('DELETE') }}

    <button type="submit" class="btn text-danger"><i class="fa fa-trash-o"></i></button>    
</form>