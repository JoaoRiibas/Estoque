//Função responsável por buscar o conteúdo que vem de uma rota e inserir no modal
function openModal(url) {
                
    axios.get(url).then(view => {

        $('#modal-default').html(view.data);
        $('#modal-default').modal('show');

    }).catch((erro) => {

        console.log('ERRO AO ABRIR O MODAL');
    }) 
};