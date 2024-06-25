const sucessModal = new bootstrap.Modal(document.getElementById('success-modal'))
const failedModal = new bootstrap.Modal(document.getElementById('failed-modal'))

const modalErrorElement = document.getElementById('modal-body-error')
const btnCloseModal = document.getElementById('btn-close-modal')
const loadingModal = document.getElementById('loading-modal')

$("#form-participantes").on("submit", function (event) {
    event.preventDefault();
    loadingModal.classList.add("enable");

    var formData = new FormData();

    let form = document.getElementById('form-participantes');

    formData.append('name', form['nome-participantes'].value);
    formData.append('email', form['email-participantes'].value);
    formData.append('cpf', form['cpf-participantes'].value);
    formData.append('phone', form['numero-participantes'].value);
    formData.append('role', form['cargo-participantes'].value);
    formData.append('suggestion', form['textarea-participantes'].value);

    fetch('php/Ajax/AjaxParticipantes.php', {
        method: 'POST',
        body: formData
    })
    .then( async (response) => { 
        loadingModal.classList.remove("enable");
        return await response.json();
    })
    .then(data => {
    
        if (data.status === "success") {
            form.reset();
            sucessModal.show(); // Mostra o modal de sucesso
        } else {  
            // Itera sobre os erros recebidos e os adiciona ao modal de erro
            for (const key in data.erros) {
                if (data.erros.hasOwnProperty(key)) {
                    if (data.erros[key] !== "") {
                        let p = document.createElement('p');
                        p.textContent = data.erros[key];
                        p.setAttribute('class', 'text-dark');
                        modalErrorElement.appendChild(p);
                    }
                }
            }
    
            failedModal.show(); // Mostra o modal de falha
        }
    })
    .catch(error => {
        console.error('Erro na requisição AJAX:', error);
    });

})

$("#form-patrocinador").on("submit", function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    loadingModal.classList.add("enable");

    var formData = new FormData();

    let form = document.getElementById('form-patrocinador');

    formData.append('name', form['nome-patrocinador'].value);
    formData.append('email', form['email-patrocinador'].value);
    formData.append('cpf', form['cpf-patrocinador'].value);
    formData.append('phone', form['numero-patrocinador'].value);
    formData.append('role', form['cargo-patrocinador'].value);
    formData.append('suggestion', form['textarea-patrocinadores'].value);

    fetch('php/Ajax/AjaxPatrocinadores.php', {
        method: 'POST',
        body: formData
    })
    .then( async (response) => { 
        loadingModal.classList.remove("enable");
        return await response.json();
    })
    .then(data => {
    
        if (data.status === "success") {
            form.reset();
            sucessModal.show(); // Mostra o modal de sucesso
        } else {
    
            // Itera sobre os erros recebidos e os adiciona ao modal de erro
            for (const key in data.erros) {
                if (data.erros.hasOwnProperty(key)) {
                    if (data.erros[key] !== "") {
                        let p = document.createElement('p');
                        p.textContent = data.erros[key];
                        p.setAttribute('class', 'text-dark');
                        modalErrorElement.appendChild(p);
                    }
                }
            }
    
            failedModal.show(); // Mostra o modal de falha
        }
    })
    .catch(error => {
        console.error('Erro na requisição AJAX:', error);
    });
})

btnCloseModal.addEventListener('click', () => {
    while (modalErrorElement.firstChild) {
        modalErrorElement.removeChild(modalErrorElement.firstChild);
    }
});