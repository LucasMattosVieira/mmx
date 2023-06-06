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
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        // console.log("Fim da pagina");

        searchResults();
        checkEnd();
    }
    
}

async function searchResults() {

    const formData = new FormData(current_form);
    let search_params = new URLSearchParams(formData);
    search_params.append("offset", current_result_offset);

    if (current_form == adv_form) {

        try {
            let response = await fetch(`/mmx/src/php/advancedSearch.php?${search_params}`);
            var results = await response.json();  
        }
        catch (e) {
            console.log(e);
        }
        newResults(results);

    } else {
        try {
            let response = await fetch(`/mmx/src/php/simpleSearch.php?${search_params}`);
            var results = await response.json();  
        }
        catch (e) {
            console.log(e);
        }
        newResults(results);
    }
}

function newResults(ads) {

    if (search_off) { // apos a primeira busca, ativa a rolagem dos resultados
        if (ads.length > 5) {
            document.addEventListener('scroll', checkEnd);
        }
        search_off = false;
        search_img.style.display = 'none';
    }

    if (ads.length == 0) {
        noResults();
        return;
    }

    current_result_offset++;

    // console.log(ads);
    // console.log(ads.length);
    
    for (let i = 0; i < ads.length; i++) {
        let new_card = document.createElement("div");
        let price = new Intl.NumberFormat('pt-BR', {style: 'currency',currency: 'BRL',});
        new_card.innerHTML = `<a href="../php/ad.php?id=${ads[i]["code"]}">` +
                            `<img src="../assets/card.png" alt="imagem_teste" width="300px">` +
                            `<h1 class="titulo">${ads[i]["title_r"]}</h1>` +
                            `<p class="descricao">${ads[i]["descr"]}</p>` +
                            `<p class="preco">${price.format(ads[i]["price"])}</p>` +
                            `</a>`;
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

