
function buscaEndereco(cep) {

    if (cep.length != 9) return;
    let form = document.querySelector("#formE");

    fetch("endereco.php?cep=" + cep)
        .then(response => {
            if (!response.ok) {
         
            throw new Error(response.status);
            }
        })
        .then(endereco => {
            // utiliza os dados para preencher o formulário
            form.estado.value = endereco.estado;
            form.bairro.value = endereco.bairro;
            form.cidade.value = endereco.cidade;
        })
        .catch(error => {
            form.reset();
            console.error('Falha inesperada: ' + error);
        });
}

window.onload = function () {
    const inputCep = document.querySelector("#cep");
    inputCep.onkeyup = () => buscaEndereco(inputCep.value);
}
