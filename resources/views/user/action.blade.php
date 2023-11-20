<a onclick="openModal('{{route('user.form', $user->id)}}')" class="btn text-primary"><i class="fa fa-edit"></i></a>

{{-- <form method="POST" action="{{route('user.delete', $user->id)}}">
    @csrf
    {{ method_field('DELETE') }}

    <button type="submit" class="btn text-danger"><i class="fa fa-trash-o"></i></button>    
</form> --}}