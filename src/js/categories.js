const categorySelect = document.getElementById("category");

window.onload = GetCategories(); // carrega as categorias do banco de dados

async function GetCategories() {
    try {
        let response = await fetch(`/mmx/src/php/getCategories.php`);
        var results = await response.json();  
    }
    catch (e) {
        console.log(e);
    }

    for (let i = 0; i < results.length; i++) {
        let option = document.createElement("option");
        option.value = results[i]["code"];
        option.innerHTML = results[i]["name"];
        categorySelect.appendChild(option);
    }

    if(categorySelect.dataset.selected.length > 0) {
        categorySelect.value = categorySelect.dataset.selected
        categorySelect.removeAttribute("data-selected")
    }
    
}