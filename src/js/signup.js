function handleSubmit(event) {
    const form = document.forms[0];
    
    if(form.name.trim() === "" || form.cpf.trim() === "" || form.tel.trim() === "" ||
       form.email.trim() === "" || form.password.trim() === "") {
        event.preventDefault();
        console.error("Há campos obrigatórios não preenchidos.");
    }
}

document.getElementById("signupForm").addEventListener("submit", handleSubmit);