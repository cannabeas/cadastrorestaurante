function validarNome() {
 
 
    const nome = document.getElementById('nome').value;
 
 
    // Verifica se o nome tem pelo menos 3 caracteres
    if (nome.trim().length < 3) {
        alert("O nome deve ter pelo menos 3 caracteres.");
        return false;
    }
 
 
    return true;
 
}

function validarDatas() {
    const data = new Date(document.getElementById('data').value);
    const hoje = new Date();

    // Definindo a hora para a validação
    hoje.setHours(0, 0, 0, 0); // Ignora horas, minutos e segundos

    if (data < hoje) {
        alert("A data da reserva não pode ser anterior a hoje.");
        return false; // Impede o envio do formulário
    }
    return true;
    
}

 function validarTelefone() {
    const telefone = document.getElementById('telefone').value.trim();
    const regex = /^\(\d{2}\) \d{5}-\d{4}$/;
    if (!regex.test(telefone)) {
        alert("Por favor, insira um número de telefone válido no formato (XX) XXXXX-XXXX.");
        return false;
    }
    return true;

 }

 function validarEmail() {
    const email = document.getElementById('email').value.trim();
    const regex = /^[a-zA-Z0-9._%=+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex.test(email)) {
        alert("Por favor insira um email válido.");
        return false;
    }
    return true;
 }

 document.querySelector('form').addEventListener('submit',function(event){
    event.preventDefault();
    alert('Check-in realizado com sucesso! Agradecemos sua escolha.');
    this.reset();
 });

 function validarHorario() {
    const horario = document.getElementById('horario').value.trim();
    const regex = /^([01]?[0-9]|2[0-3]):([0-5]?[0-9])$/;

    // Verifica se o horário está no formato correto
    if (!regex.test(horario)) {
        alert("Por favor, insira um horário válido no formato HH:MM.");
        return false;
    }

    // Divide o horário em hora e minuto
    const [hora, minuto] = horario.split(':').map(num => parseInt(num, 10));

    // Define os horários de início e fim permitidos (12:00 a 23:59)
    const horaInicio = 12;  // 12:00
    const horaFim = 23;     // 23:59

    // Verifica se o horário está dentro do intervalo permitido
    if (hora < horaInicio || hora > horaFim || (hora === horaFim && minuto > 59) || (hora === horaInicio && minuto < 0)) {
        alert("O horário deve estar entre 12:00 e 23:59.");
        return false;
    }

    return true;
}
function validarNumeroClientes() {
    const numeroClientes = document.getElementById('numeroClientes').value.trim();
    const regex = /^[0-9]+$/;  // Expressão regular para garantir que seja um número inteiro

    // Verifica se o valor inserido é um número
    if (!regex.test(numeroClientes)) {
        alert("Por favor, insira um número válido de clientes.");
        return false;
    }

    // Verifica se o número de clientes é maior que 0 e no máximo 10
    const numClientes = parseInt(numeroClientes, 10);
    if (numClientes < 1 || numClientes > 10) {
        alert("O número de clientes deve ser entre 1 e 10.");
        return false;
    }

    return true;
}


 