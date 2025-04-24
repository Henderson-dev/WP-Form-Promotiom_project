
//------------------------------------------------------------------------
// Quando a página carregar, chama funções
//------------------------------------------------------------------------
document.addEventListener("DOMContentLoaded", async function () {


        // -----------------------------------------------------------
    // Botões de navegação entre formulários
    // -----------------------------------------------------------
    // Seleciona o botão pelo ID
    const btnAvancar = document.getElementById("bto-enviar");
    
    // Adiciona um evento de clique ao botão
    btnAvancar.addEventListener("click", function () {

        // Define campos que precisam ser validados
        const fieldsConatct = [
            { input_name: 'nome', input_type: 'text', input_msg: 'Informe o seu nome e sobrenome' },
            { input_name: 'telefone', input_type: 'text', input_msg: 'Preenhca o telefone de contato no formato solicitado.' },
            { input_name: 'email', input_type: 'email', input_msg: 'Informe o campo e-mail' },
            { input_name: 'nascimento', input_type: 'text', input_msg: 'Informe a sua data de nascimento' },
            { input_name: 'cpf', input_type: 'text', input_msg: 'Informe um CPF válido' },
            { input_name: 'cidade', input_type: 'select', input_msg: 'Selecione a cidade onde você reside' }
        ];

        // Chama a função para validar os campos e passa o id do campo de mensagen
        const validationResult = validateForm(fieldsConatct, 'msg-alert');
                
        if (validationResult.valid) {
            console.log("Validado")
        }

    });

});



//----------------------------------------------------------
// Função genérica para validação de campos de formulário
//----------------------------------------------------------
// Recebe um array com o nome do campo e o tipo do campo
function validateForm(fields, boxmsg) {
    for (const field of fields) {
        const { input_name, input_type, input_msg} = field;
        const inp_field = document.getElementById(`${input_name}`);
        const msg_container = document.getElementById(boxmsg);
        const msg_field = msg_container ? msg_container.querySelector("span") : null;

        // Adiciona classe ao box de mensagem
        msg_container.classList.add("show-validation");

        const value = inp_field.value.trim();
        let fieldValid = value !== '';


        if (!fieldValid && msg_field) {
            msg_field.textContent = input_msg;
            msg_field.style.display = "block";
            inp_field.classList.add("alert-input");
            focusInInput(input_name);
            return { valid: false, field: input_name };

        } else if (msg_field) {
            msg_field.textContent = '';
            msg_field.style.display = "none";
            inp_field.classList.remove("alert-input");
        }

    }
    return { valid: true, field: null };
}
