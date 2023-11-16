@if($mensagem = Session::get('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-text"><strong> {{$mensagem}} </strong></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@elseif($mensagem = Session::get('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-text"><strong> {{$mensagem}} </strong></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif