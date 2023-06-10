function handleSubmit() {
    const btnSubmit = document.getElementById("btnSubmit");

    btnSubmit.disabled = true;
    btnSubmit.textContent = "Entrando..."
}

document.getElementById("loginForm").addEventListener("submit", handleSubmit);