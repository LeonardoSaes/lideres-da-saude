const sucessModal = new bootstrap.Modal(document.getElementById('success-modal'))
const failedModal = new bootstrap.Modal(document.getElementById('failed-modal'))
const modalErrorElement = document.getElementById('modal-body-error')
const btnCloseModal = document.getElementById('btn-close-modal')

sucessModal.show()

let form_participantes = document.getElementById('form-participantes');

form_participantes.addEventListener('submit', function (event) {
    event.preventDefault();

    let json = {
        name: form_participantes['nome-participantes'].value,
        email: form_participantes['email-participantes'].value,
        phone: form_participantes['numero-participantes'].value,
        cpf: form_participantes['cpf-participantes'].value,
        role: form_participantes['cargo-participantes'].value,
    }

    let options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(json)
    };

    fetch("http://localhost:3000/participantes/register", options)
        .then(async function (response) {
            if (response.status != 201) {
                throw await response.json();
            }
            return response.json();
        })
        .then(function (data) {
            form_participantes.reset();
            sucessModal.show()
        })
        .catch(error => {
            for (const key in error) {
                if (error.hasOwnProperty(key)) {
                    if (error[key] != "") {
                        let p = document.createElement('p');
                        p.textContent = error[key];
                        p.setAttribute('class', 'text-dark');
                        modalErrorElement.appendChild(p);
                    }
                }
            }
            failedModal.show()
        });
});


let form_patrocinador = document.getElementById('form-patrocinador');

form_patrocinador.addEventListener('submit', function (event) {
    event.preventDefault();

    let json = {
        name: form_patrocinador['nome-patrocinador'].value,
        email: form_patrocinador['email-patrocinador'].value,
        phone: form_patrocinador['numero-patrocinador'].value,
        cpf: form_patrocinador['cpf-patrocinador'].value,
        role: form_patrocinador['cargo-patrocinador'].value,
    }

    let options = {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(json)
    };

    fetch("http://localhost:3000/patrocinadores/register", options)
        .then(async function (response) {
            if (response.status != 201) {
                throw await response.json();
            }
            return response.json();
        })
        .then(function (data) {
            form_patrocinador.reset();
            sucessModal.show()
        })
        .catch(error => {
            for (const key in error) {
                if (error.hasOwnProperty(key)) {
                    if (error[key] != "") {
                        let p = document.createElement('p');
                        p.textContent = error[key];
                        p.setAttribute('class', 'text-dark');
                        modalErrorElement.appendChild(p);
                    }
                }
            }
            failedModal.show()
        });
});


btnCloseModal.addEventListener('click', () => {
    while (modalErrorElement.firstChild) {
        modalErrorElement.removeChild(modalErrorElement.firstChild);
    }
});