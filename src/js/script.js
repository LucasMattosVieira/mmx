const simple_filter = document.getElementById("simple_filter");
const advanced_filter = document.getElementById("advanced_filter");

const simple_form = document.getElementById("simpleForm");
const adv_form = document.getElementById("advForm");

const search_img = document.getElementById("start_search");
const error_img = document.getElementById("no_results");

advanced_filter.style.display = 'none';
error_img.style.display = 'none';

let current_form = simple_form;


document.getElementById("setAdvanced").addEventListener('click', function() {
    simple_filter.style.display = 'none';
    advanced_filter.style.display = 'block';
    current_form = adv_form;
});

document.getElementById("setSimple").addEventListener('click', function() {
    advanced_filter.style.display = 'none';
    simple_filter.style.display = 'block';
    current_form = simple_form;
});

simple_form.addEventListener('submit',(e) => {
    e.preventDefault();
    searchResults();
});

// adv_form.addEventListener('submit',(e) => {
//     e.preventDefault();
//     searchResults();
// });

let current_result_offset = 0;
let search_off = true;

function checkEnd() {
    let last_card = document.querySelector("#cards > div:last-child");
    

    if ((window.scrollY + window.innerHeight) > (last_card.offsetTop + last_card.clientHeight - 50)) {
        console.log("Fim da pagina");

        searchResults();
        // for (let i = 0; i < 6; i++) {
            
        //     let new_card = document.createElement("div");
        //     new_card.innerHTML = '<img src="../assets/card.png" alt="imagem_teste" width="300px">' +
        //                         '<h1 class="titulo">TÍTULO</h1>' +
        //                         '<p class="descricao">Descrição teste</p>' +
        //                         '<p class="preco">R$ 1.234,56</p>';
        //     new_card.classList.add("card");
        //     document.getElementById("cards").appendChild(new_card);
        //     max_results--;
        // }
        checkEnd();
    }
    
}

async function searchResults() {

    const formData = new FormData(current_form);
    let search_params = new URLSearchParams(formData);
    search_params.append("offset", current_result_offset);

    if (current_form == adv_form) {

        try {
            let response = await fetch(`/mmx/src/php/buscaAvancada.php?${search_params}`);
            let results = await response.json();
            newResults(results);
        }
        catch (e) {
            console.log(e);
        }

    } else {
        try {
            let response = await fetch(`/mmx/src/php/buscaSimples.php?${search_params}`);
            let results = await response.json();
            newResults(results);
        }
        catch (e) {
            console.log(e);
        }
    }
}

function newResults(ads) {

    if (search_off) { // apos a primeira busca, ativa a rolagem dos resultados
        document.addEventListener('scroll', checkEnd);
        search_off = false;
        search_img.style.display = 'none';
    }

    if (ads.length == 0) {
        noResults();
        return;
    }

    current_result_offset++;

    console.log(ads);
    console.log(ads.length);

    for (ad in ads) {
        let new_card = document.createElement("div");
        new_card.innerHTML = `<img src="../assets/card.png" alt="imagem_teste" width="300px">` +
                            `<h1 class="titulo">${ad["title_r"]}</h1>` +
                            `<p class="descricao">${ad["descr"]}</p>` +
                            `<p class="preco">R$ 1.234,56</p>`;
        new_card.classList.add("card");
        document.getElementById("cards").appendChild(new_card);
}

}

function noResults() {
    if (current_result_offset == 0) { // zero resultados encontrados na 1a busca
        error_img.style.display = 'block';
    }
    document.removeEventListener('scroll', checkEnd); // para de buscar mais resultados 
}