function handleSubmit(event) {
    const form = document.forms[0];
    
    if(form.email.trim() === "" || form.password.trim() === "") {
        event.preventDefault();
        console.error("Há campos obrigatórios não preenchidos.");
    }
}

document.getElementById("loginForm").addEventListener("submit", handleSubmit);