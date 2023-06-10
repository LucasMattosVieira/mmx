const form = document.forms[0];
const errorsBox = document.getElementById("errors");

const cpfRgx = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
const telRgx = /^\(\d{2,3}\)\s\d\s\d{4}-\d{4}$/;
const emailRgx = /\w+([\.-]\w+)?@\w+([\.-]\w+)?\.\w+/;

function isEmpty(input) {
    if(input.value.trim().length === 0) {
        input.classList.add("error");
        errorsBox.insertAdjacentHTML("beforeend", `
            <li>O campo "${input.placeholder}" não foi preenchido.</li>
        `);

        return true;
    }

    return false;
}

function validateName() {
    return !isEmpty(form.name);
}

function validateCPF() {
    if(isEmpty(form.cpf)) {
        return false
    }
    
    if(!cpfRgx.test(form.cpf.value)) {
        form.cpf.classList.add("error");
        errorsBox.insertAdjacentHTML("beforeend", `
            <li>O campo "CPF" precisa ser preenchido usando o formato XXX.XXX.XXX-XX.</li>
        `);

        return false
    }

    return true;
}

function validateTel() {
    if(isEmpty(form.tel)) {
        return false
    }

    if(!telRgx.test(form.tel.value)) {
        form.tel.classList.add("error");
        errorsBox.insertAdjacentHTML("beforeend", `
            <li>O campo "Telefone" precisa ser preenchido usando o formato (XX) X XXXX-XXXX.</li>
        `);

        return false
    }

    return true;
}

function validateEmail() {
    if(isEmpty(form.email)) {
        return false
    }

    if(!emailRgx.test(form.email.value)) {
        form.email.classList.add("error");
        errorsBox.insertAdjacentHTML("beforeend", `
            <li>Formato inválido de e-mail.</li>
        `);

        return false
    }

    return !isEmpty(form.email);
}

function validatePassword() {
    if(isEmpty(form.password)) {
        return false
    }

    if(!/[a-z]/.test(form.password.value) || !/[A-Z]/.test(form.password.value) || !/[0-9]/.test(form.password.value)) {
        form.password.classList.add("error");
        errorsBox.insertAdjacentHTML("beforeend", `
            <li>A senha precisa conter números, letras minúsculas e maiúsculas.</li>
        `);

        return false
    }
    
    if(form.password.value.trim().length < 8) {
        form.password.classList.add("error");
        errorsBox.insertAdjacentHTML("beforeend", `
            <li>A senha dever ter um tamanho mínimo de 8 caracteres.</li>
        `);

        return false
    }

    return true;
}

function validateForm() {
    errorsBox.innerHTML = "";

    return [ 
        validateName(), 
        validateCPF(),
        validateTel(),
        validateEmail(), 
        validatePassword()
    ].every((validation) => validation === true);
}

function handleSubmit(event) {
    if(!validateForm()) {
        event.preventDefault();
        return false;
    }
    
    const btnSubmit = document.getElementById("btnSubmit")

    btnSubmit.disabled = true;

    // form.name.disabled = true;
    // form.cpf.disabled = true;
    // form.tel.disabled = true;
    // form.email.disabled = true;
    // form.password.disabled = true;

    btnSubmit.textContent = "Criando conta...";
}

/* Event Listeners */

form.addEventListener("submit", handleSubmit);