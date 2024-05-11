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

    console.log(json)

    fetch("http://localhost:3000/participantes/register", options)
        .then(function (response) {
            console.log(response);
        })
        .catch(error => {
            alert('erro')
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

    console.log(json)

    fetch("http://localhost:3000/patrocinadores/register", options)
        .then(function (response) {
            console.log(response);
        })
        .catch(error => {
            alert("ESTAMOS COM PROBLEMAS INTERNOS, TENTE NOVAMENTE MAIS TARDE")
        });
});

