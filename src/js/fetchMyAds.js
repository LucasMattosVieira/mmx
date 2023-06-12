const cardDiv = document.getElementById("cards");

const errorSVG = document.getElementById("no_results");

errorSVG.style.display = 'none';

let currentResultOffset = 0;
let firstFetch = true;

window.onload = FetchMyAds();

function CheckEnd() {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        // console.log("Fim da pagina");
        FetchMyAds();
    }
}

async function FetchMyAds() {     // traz todos os anuncios do usuario
    try {
        let response = await fetch(`/mmx/src/php/fetchMyAds.php?offset=${currentResultOffset}`);
        var results = await response.json();
    }
    catch (e) {
        console.log(e);
    }
    NewResults(results);
}

function NewResults(ads) {
    console.log(`Novos cards. Offset = ${currentResultOffset}`);
    console.log(ads);

    if (firstFetch) {
        if (ads.length == 0) {
            errorSVG.style.display = 'block';
            return;
        }
        if (ads.length > 5) {
            document.addEventListener('scroll', CheckEnd);
        }
        firstFetch = false;
    }

    if (ads.length == 0) {
        document.removeEventListener('scroll', CheckEnd);
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