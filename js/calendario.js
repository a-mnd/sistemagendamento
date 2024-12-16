// Função para gerar um calendario 
function gerarCalendario() { 
    const hoje = new Date(); 
    const mesAtual = hoje.getMonth(); 
    const anoAtual = hoje.getFullYear(); 
    const primeiroDia = new Date(anoAtual, mesAtual, 1).getDay(); //obtem o primeiro dia do mês e o dia da semana que cai
    const diasNoMes = new Date(anoAtual, mesAtual + 1, 0).getDate(); //percorre a quantidade de dias até o ultimo dia do mes 

    const meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]; 
    document.getElementById('mesAno').textContent = `${meses[mesAtual]}, ${anoAtual}`; //inserindo no h2 mesAno o mes e ano atuais

    const conteudoCalendario = document.querySelector('.datatabela tbody'); //selecionamos o corpo do calendario
    conteudoCalendario.innerHTML = ''; //aqui limpa o conteudo do corpo para poder inserir as novas informações de cada mes

    let data = 1; //representa o primeiro dia do mes
    for (let i = 0; i < 6; i++) { // a quebra de semanas de um calendario pode gerar até 6 linhas de semanas
        const row = document.createElement('tr'); //cria linha

        for (let j = 0; j < 7; j++) { // condição para criar uma cécula td para cada dia da semana 
            const cell = document.createElement('td'); 
            if (i === 0 && j < primeiroDia) { // aq a verificação discorre para mostrar apenas as informacções do mes atual 
                cell.textContent = ''; 
            } else if (data > diasNoMes) { //se a repetição execede os dias do mes quebra a repetição
                break; 
            } else { // se a contagem ainda estiver dentro da verificação dos dias do mes continua
                cell.textContent = data; //insere a data
                if (data === hoje.getDate()) { 
                    cell.classList.add('hoje'); 
                } 
                data++; //soma +1 a data 
            } 
            row.appendChild(cell); //insere os dias na linhas
        } 
        conteudoCalendario.appendChild(row); //insere as linhas no corpo
    } 
} 

gerarCalendario(); 

