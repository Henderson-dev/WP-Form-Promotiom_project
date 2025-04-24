// ------------------------------------------------------
// Geração de nomes completos
// ------------------------------------------------------

// Arrays com 30 nomes brasileiros únicos
const nomes = [
"Ana", "Bruno", "Camila", "Daniel", "Eduarda", "Felipe", "Gabriela", "Henrique", "Isabela", "João",
"Karina", "Lucas", "Mariana", "Nathan", "Olívia", "Pedro", "Queila", "Rafael", "Sabrina", "Tiago",
"Ursula", "Victor", "Wesley", "Ximena", "Yasmin", "Zeca", "Amanda", "Caio", "Letícia", "Matheus"
];
  
const nomesDoMeio = [
"Almeida", "Barros", "Castro", "Dias", "Esteves", "Ferreira", "Gonçalves", "Hernandes", "Ibrahim", "Junqueira",
"Klein", "Lima", "Moraes", "Nascimento", "Oliveira", "Pereira", "Queiroz", "Ramos", "Silveira", "Teixeira",
"Uchoa", "Viana", "Wagner", "Xavier", "Yamada", "Zanetti", "Assis", "Bittencourt", "Campos", "Domingues"
];

const sobrenomes = [
"Souza", "Silva", "Costa", "Santos", "Oliveira", "Pereira", "Lima", "Carvalho", "Almeida", "Ferreira",
"Ribeiro", "Gomes", "Martins", "Barbosa", "Rocha", "Dias", "Teixeira", "Fernandes", "Araújo", "Cardoso",
"Monteiro", "Correia", "Batista", "Moura", "Andrade", "Rezende", "Machado", "Vieira", "Ramos", "Moreira"
];
  
// Função para gerar um nome completo aleatório
function gerarNomeCompleto() {
    const nome = nomes[Math.floor(Math.random() * nomes.length)];
    const nomeDoMeio = nomesDoMeio[Math.floor(Math.random() * nomesDoMeio.length)];
    const sobrenome = sobrenomes[Math.floor(Math.random() * sobrenomes.length)];
    return `${nome} ${nomeDoMeio} ${sobrenome}`;
}
  
  
// Gera o nome completo aleatório
const fullName = gerarNomeCompleto();
  
  
// -----------------------------------------------
// Geração de e-mails aleatórios
// -----------------------------------------------
function gerarEmail(nomeCompleto) {
    const dominios = ["gmail.com", "hotmail.com", "outlook.com", "yahoo.com.br", "uol.com.br"];

    // Quebra o nome completo em partes
    const partes = nomeCompleto.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").split(" ");

    const nome = partes[0];
    const sobrenome = partes[partes.length - 1];

    // Combinações possíveis
    const opcoes = [
        `${nome}.${sobrenome}`,
        `${nome}${sobrenome}`,
        `${nome}_${sobrenome}`,
        `${nome[0]}${sobrenome}`,
        `${nome}${sobrenome[0]}`,
        `${sobrenome}${nome}`
    ];

    // Seleciona uma combinação aleatória
    const base = opcoes[Math.floor(Math.random() * opcoes.length)];

    // Número aleatório para dar mais realismo
    const numero = Math.floor(Math.random() * 1000);

    // Domínio aleatório
    const dominio = dominios[Math.floor(Math.random() * dominios.length)];

    return `${base}${numero}@${dominio}`;
}

// Gera o e-mail aleatório
const email = gerarEmail(fullName);
  


// ------------------------------------------------------
// Geração de telefones aleatórios
// ------------------------------------------------------
  
function gerarTelefone() {
    // Gera um DDD aleatório entre 11 e 99 (ignorando alguns inválidos reais por simplicidade)
    const ddd = Math.floor(Math.random() * 89) + 11;

    // Decide aleatoriamente entre fixo (0) e celular (1)
    const tipo = Math.random() < 0.5 ? "fixo" : "celular";

    let numero;

    if (tipo === "celular") {
        // Celular: sempre começa com 9 e tem 5 dígitos antes do traço
        const primeiraParte = '9' + Math.floor(10000 + Math.random() * 90000);
        const segundaParte = Math.floor(1000 + Math.random() * 9000);
        numero = `(${ddd}) ${primeiraParte}-${segundaParte}`;
    } else {
        // Fixo: 4 dígitos antes do traço
        const primeiraParte = Math.floor(2000 + Math.random() * 8000);
        const segundaParte = Math.floor(1000 + Math.random() * 9000);
        numero = `(${ddd}) ${primeiraParte}-${segundaParte}`;
    }

    return numero;
}

// Gera telefone aleatório
const telefone = gerarTelefone();
  



// ------------------------------------------------------
// Geração de CPFs aleatórios
// ------------------------------------------------------
function gerarCPF() {
    function gerarDigitosBase() {
      const digitos = [];
      for (let i = 0; i < 9; i++) {
        digitos.push(Math.floor(Math.random() * 10));
      }
      return digitos;
    }
  
    function calcularDigito(digitos, pesoInicial) {
      let soma = 0;
      for (let i = 0; i < digitos.length; i++) {
        soma += digitos[i] * (pesoInicial - i);
      }
      let resto = soma % 11;
      return resto < 2 ? 0 : 11 - resto;
    }
  
    const base = gerarDigitosBase();
    const d1 = calcularDigito(base, 10);
    const d2 = calcularDigito([...base, d1], 11);
    const cpf = [...base, d1, d2];
  
    // Formatação para xxx.xxx.xxx-xx
    return cpf
      .join('')
      .replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
}

// Gera CPF aleatório
const cpf = gerarCPF();





// ------------------------------------------------------
// Função que gera data de nascimento
// ------------------------------------------------------
function gerarDataNascimento(maiorDe18 = false) {
    const hoje = new Date();
    const anoAtual = hoje.getFullYear();
  
    // Define limites de ano
    const anoMin = 1900;
    const anoMax = maiorDe18 ? anoAtual - 18 : anoAtual;
  
    // Gera ano aleatório entre os limites
    const ano = Math.floor(Math.random() * (anoMax - anoMin + 1)) + anoMin;
  
    // Gera mês e dia válidos
    const mes = Math.floor(Math.random() * 12); // 0 a 11
    const dia = Math.floor(Math.random() * new Date(ano, mes + 1, 0).getDate()) + 1;
  
    const data = new Date(ano, mes, dia);
  
    // Retorna no formato dd/mm/aaaa
    const diaStr = String(data.getDate()).padStart(2, '0');
    const mesStr = String(data.getMonth() + 1).padStart(2, '0');
    const anoStr = data.getFullYear();
  
    return `${diaStr}/${mesStr}/${anoStr}`;
  }

// Gera data de nascimento para maior de 18 anos 
const dataNascimento = gerarDataNascimento(true)



// ------------------------------------------------------
// Função que recebe ID e Value dos campos para preencher
// ------------------------------------------------------
function preencherFormulario(campos) {
    campos.forEach(([id, value, type = "text"]) => {
        let input = document.getElementById(id);
        if (input) {
            if (type === "select") {
                input.value = value;
            } else if (type === "checkbox") {
                input.checked = Boolean(value);
            } else {
                input.value = value;
            }
        }
    });
}



document.addEventListener("DOMContentLoaded", function () {

    // Array com os campos a serem preenchidos
    const camposParaPreencher = [
        
        ["nome", fullName],
        ["email", email],
        ["telefone", telefone],
        ["cpf", cpf],
        ["nascimento", dataNascimento],
        ["cidade", "Americana", "select"],

        ["regulamento", true, "checkbox"],
        ["privacidade", true, "checkbox"],
        
        ["estabelecimento", "Supermercado Pague Menos"],
        ["regulamento2", true, "checkbox"],

        ["arroz_integral", "0000125984154"],
        ["qt_arroz_integral", "3"]

    ];

    // Preecher campos do formulário automaticamente
    preencherFormulario(camposParaPreencher);

});