let mesSelecionado = document.getElementById("mesSelecionado");
const hoje = new Date(); //hoje
let mesAtual = hoje.getMonth(); //mes hoje
let anoAtual = hoje.getFullYear(); // ano atual
mesSelecionado.value = mesAtual; // Adiciona o mes atual ao select

// console.log(hoje.getDate())

for (let m = 0; m < mesAtual; m++) {
  let option = mesSelecionado.querySelector(`option[value="${m}"]`);
  if (option) {
    option.disabled = true; // Desabilita a opção
  }
}

function mudarMes() {
  mesAtual = parseInt(mesSelecionado.value); //mes selecionado na option
  gerarCalendario(mesAtual); // gera o calendario a partir da seleção
}

function gerarCalendario(mesAtual) {
  //gera calendario
  const anoAtual = hoje.getFullYear(); //ano
  const primeiroDia = new Date(anoAtual, mesAtual, 1).getDay(); //ve o primeiro dia do mes
  const diasNoMes = new Date(anoAtual, mesAtual + 1, 0).getDate(); //percorre q qtde de dias no mes

  const conteudoCalendario = document.querySelector(".datatabela tbody"); //insere o calendario
  conteudoCalendario.innerHTML = "";

  let data = 1;
  for (let i = 0; i < 6; i++) {
    // linhas de quebra de um calendario
    const row = document.createElement("tr");

    for (let j = 0; j < 7; j++) {
      // dias da semana
      const cell = document.createElement("td");
      if (i === 0 && j < primeiroDia) {
        cell.textContent = ""; //limpa
      } else if (data > diasNoMes) {
        break; //quebra se tiver ultrapassado os  dias do mes
      } else {
        cell.textContent = data; //poe  a data na celula
        cell.addEventListener(
          "click",
          (function (dia) {
            // ao clicar abre modal
            return function () {
              let mesCerto = mesAtual + 1;
              abrirModal(dia, mesAtual);
              console.log(dia+" "+mesCerto);
              const hora = document.getElementById("hora");
              fetch("optionHora.php?dia=" + dia + "&mesCerto=" + mesCerto)
                .then((resposta) => {
                  if (resposta.ok) {
                    return resposta.text();
                  }
                })
                .then((dados) => {
                    hora.innerHTML = dados;
                });
            };
          })(data)
        );
        data++; //data +1 repetição
      }
      row.appendChild(cell);
    }
    conteudoCalendario.appendChild(row);
  }

  /* ======= Parte de manipulação do calendário ======= */
  const rows = document.querySelectorAll('tr'); 
  const mesHJ = new Date().getMonth();
  const mesSelecionadoValue = parseInt(mesSelecionado.value, 10); 
  
  if (mesSelecionadoValue === mesHJ) {
      let tds = document.querySelectorAll('table tbody td');
  
      tds.forEach(function(td) {
        /* Verifica qual mês estamos e aplica opacidade e não deixa interagir com os td */
        for(let i = 0; i < hoje.getDate(); i++) {
          if(td.textContent == i) {
            td.classList.add('desabilitado');
            }
          }
      });
  }

  /* Gerando um loop em todos os tr  */
  rows.forEach((row) => {
      /* Pegando todos os td dentro desse loop que percorre o tr */
      const cells = row.querySelectorAll('td');

      /* Percorrendo todos os td e pegando o index dele */
      cells.forEach((cell, index) => {
        /* Neste, ele pega os td de indice 1 e verifica de há conteúdo nele, caso houver ele coloca uma cor e de deixa sem interação */
        if (index === 1 && cell.textContent !== "") {
          cell.classList.add('desabilitado-fechado');
        }
      });
  });

  
}

function abrirModal(dia, mes) {
  const mesTexto = mesSelecionado.options[mes].text;
  document.getElementById("diaSelecionado").value = dia;
  document.getElementById("mesSelecionadoTexto").value = mesTexto;
  document.getElementById("agendamentoDialog").showModal();
}
// function abrirModal(dia, mes) {
//   const nomesMeses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
//   const mesTexto = nomesMeses[mes - 1]; // Ajuste o índice para obter o nome correto do mês
//   document.getElementById("diaSelecionado").value = dia;
//   document.getElementById("mesSelecionadoTexto").value = mesTexto;
//   document.getElementById("agendamentoDialog").style.display = "block";
//   document.getElementById("agendamentoDialog").showModal();
// }

function fecharModal() {
  document.getElementById("agendamentoDialog").close();
}

document.getElementById("escolhadata").addEventListener("click", function () {
  const diaSelecionado = parseInt(
    document.querySelector(".datatabela td.selected").textContent
  );
  abrirModal(diaSelecionado, mesAtual);
});

gerarCalendario(mesAtual);