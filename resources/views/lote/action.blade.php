<a onclick="openModal('{{route('lote.form', $lote->id)}}')" class="btn text-primary"><i class="fa fa-edit"></i></a>

<form method="POST" action="{{route('lote.delete', $lote->id)}}">
    @csrf
    {{ method_field('DELETE') }}

    <button type="submit" class="btn text-danger"><i class="fa fa-trash-o"></i></button>    
</form>

@push('js')
    <script>
        //Função responsável por buscar o conteúdo que vem de uma rota e inserir no modal
        function openModal(url) {
                
                axios.get(url).then(view => {
            
                    $('#modal-default').html(view.data);
                    $('#modal-default').modal('show');
            
                }).catch((erro) => {
            
                    console.log('ERRO MODAL');
                })
            };
    </script>
@endpush