const simpleFilter = document.getElementById("simple_filter");
const advancedFilter = document.getElementById("advanced_filter");

const simpleForm = document.getElementById("simpleForm");
const advancedForm = document.getElementById("advForm");

const searchSVG = document.getElementById("start_search");
const errorSVG = document.getElementById("no_results");

const cardDiv = document.getElementById("cards");

let currentForm = simpleForm;
let currentResultOffset = 0;
let searchOff = true;

advancedFilter.style.display = 'none';
errorSVG.style.display = 'none';

window.onload = FetchAllAds(); // busca todos os anuncios por padrao ao carregar a pagina Home

document.getElementById("setAdvanced").addEventListener('click', function() {
    simpleFilter.style.display = 'none';
    advancedFilter.style.display = 'block';
});

document.getElementById("setSimple").addEventListener('click', function() {
    advancedFilter.style.display = 'none';
    simpleFilter.style.display = 'block';
});

simpleForm.addEventListener('submit',(e) => {
    e.preventDefault();
    ClearCards();
    currentForm = simpleForm;
    SearchResults();
});

advancedForm.addEventListener('submit',(e) => {
    e.preventDefault();
    ClearCards();
    currentForm = advancedForm;
    SearchResults();
});

function CheckEnd() {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        // console.log("Fim da pagina");
        SearchResults();
    }
}

async function FetchAllAds() {     // traz todos os anuncios
    try {
        let response = await fetch(`/mmx/src/php/searchAll.php?offset=${currentResultOffset}`);
        var results = await response.json();
    }
    catch (e) {
        console.log(e);
    }
    NewResults(results);
}

async function SearchResults() {    // busca os anuncios usando os filtros da pagina
    // console.log("more results");
    const formData = new FormData(currentForm);
    let searchParameters = new URLSearchParams(formData);
    searchParameters.append("offset", currentResultOffset);

    const btnSubmit = currentForm.querySelector("button");
    let results = null;

    if (currentForm == advancedForm) {
        try {
            btnSubmit.disabled = true;
            btnSubmit.textContent = "Pesquisando...";
            
            const response = await fetch(`/mmx/src/php/advancedSearch.php?${searchParameters}`);
            
            results = await response.json();  
        } catch (error) {
            console.log(error);
            alert("Erro ao tentar pesquisar anúncios :(");
        } finally {
            btnSubmit.disabled = false;
            btnSubmit.textContent = "Pesquisar";
        }
        
        NewResults(results);
    } else {
        try {
            btnSubmit.disabled = true;
            btnSubmit.textContent = "Pesquisando...";
            
            const response = await fetch(`/mmx/src/php/simpleSearch.php?${searchParameters}`);
            
            results = await response.json();  
        } catch (error) {
            console.log(error);
            alert("Erro ao tentar pesquisar anúncios :(");
        } finally {
            btnSubmit.disabled = false;
            btnSubmit.textContent = "Pesquisar";
        }

        NewResults(results);
    }
}

function NewResults(ads) {
    console.log(`Novos cards. Offset = ${currentResultOffset}`);
    console.log(ads);
    if (searchOff) { // apos clicar no botao de busca, ativa a rolagem dos resultados
        if (ads.length > 5) {
            document.addEventListener('scroll', CheckEnd);
        }
        searchOff = false;
        searchSVG.style.display = 'none';
    }

    if (ads.length == 0) {
        NoResults();
        return;
    }

    currentResultOffset++;

    // console.log(ads);
    // console.log(ads.length);
    
    for (let i = 0; i < ads.length; i++) {
        let newCard = document.createElement("a");
        let price = new Intl.NumberFormat('pt-BR', {style: 'currency',currency: 'BRL',});
        newCard.innerHTML = "<div class='card'>" +
                            `<img src="../images/${ads[i]["picture"]}" onerror="this.onerror=null; this.src='../assets/card.png'"
                                alt="imagem_produto" width="300px">` +
                            `<h1 class="titulo">${ads[i]["titleResult"]}</h1>` +
                            `<p class="descricao">${ads[i]["descr"]}</p>` +
                            `<p class="preco">${price.format(ads[i]["price"])}</p>` +
                            `</div>`;
        newCard.href = `../pages/ad.php?id=${ads[i]["code"]}`;
        cardDiv.appendChild(newCard);
    }
    
}

function NoResults() {
    if (currentResultOffset == 0) { // zero resultados encontrados na 1a busca
        errorSVG.style.display = 'block';
    }
    document.removeEventListener('scroll', CheckEnd); // para de buscar mais resultados 
}

function ClearCards() {
    console.log("Div limpo");
    cardDiv.textContent = '';
    currentResultOffset = 0;
    searchOff = true;
}