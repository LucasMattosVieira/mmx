const inputCep = document.getElementById("cep");
inputCep.onkeyup = () => buscaEndereco(inputCep.value);

async function buscaEndereco(cep) {
    //console.log("Buscando cep");
    if (cep.length != 9) return;
    let form = document.getElementById("createAdForm");
    let endereco = "";

    try {
        let response = await fetch("../php/address.php?cep=" + cep);
        endereco = await response.json();
    }
    catch (e) {
        form.reset();
        console.log(e);
    }
    finally {
        form.estado.value = endereco.estado;
        form.bairro.value = endereco.bairro;
        form.cidade.value = endereco.cidade;
    }
}
