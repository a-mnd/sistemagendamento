<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modais</title>
    <link rel="stylesheet" href="../css/modais.css">
    <link rel="shortcut icon" href="/imgs/VH.svg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/224a2d2542.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once 'menu.php';
    ?>
    <main>
        <section>
            <!--MODAL DE AGENDAMENTO-->
            <!--<dialog>
                <form>
                <div class="data">
                    <h1 class="dia">09</h1>
                    <div class="mes">
                        <p>de</p>
                        <p>Novembro</p>
                    </div>
                </div>
                <div class="nome">
                    <label for="nome">Nome</label>
                    <input type="text" class="nome">
                </div>
                <div class="dois">
                    <div class="profissional">
                        <label for="func">Profissional</label>
                        <select name="profissional"  id="funcionario">
                            <option value=""></option>
                            <option value="">Juliana</option>
                            <option value="">Marisa</option>
                            <option value="">Roberto</option>
                        </select>
                    </div>
                    <div class="servico">
                        <label for="serv">Procedimento</label>
                        <select name="servico" id="serv" class="servicos">
                            <option value=""></option>
                            <option value="">Corte</option>
                            <option value="">Tintura</option>
                            <option value="">Mão</option>
                        </select>
                    </div>
                </div>
                <div class="telefone">
                    <label for="contato">Contato</label>
                    <input type="text" name="contato" id="contato" class="tel">
                </div>

                <div class="horarios">
                    <select name="hora" id="hora" class="horario">
                        <option value="">Horário</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                    </select>
                </div>
                <button type="submit" class="confirmar">Agendar</button>
                <button class="fechar" id="fechar"><i class="fa-solid fa-xmark"></i></button>
                </form>
            </dialog>-->


            <!--MODAL DE CANCELAMENTO-->

            <!--<dialog open class="cancelar">
                <h1 class="certeza">Você tem certeza?</h1>
                <button type="submit" class="naocancela">Não</button>
                <button type="submit" class="confirmar">Sim</button>
                <button class="fechar" id="fechar"><i class="fa-solid fa-xmark"></i></button>

            </dialog>-->


            <!--MODAL DE REAGENDAMENTO-->

            <!--<dialog>
            <div class="novadata">
                <h1 class="escolha"> Escolha uma data</h1>
                <select name="data" id="dia" class="novodia">
                    <option value="">Data</option>
                    <option value="">12/12/2024</option>
                    <option value="">22/12/2024</option>
                    <option value="">31/01/2025</option>
                </select>
            </div>
                <div class="nome">
                    <label for="nome">Nome</label>
                    <input type="text" class="nome">
                </div>
                <div class="dois">
                    <div class="profissional">
                        <label for="func">Profissional</label>
                        <select name="profissional" id="func" class="funcionario">
                            <option value=""></option>
                            <option value="">Juliana</option>
                            <option value="">Marisa</option>
                            <option value="">Roberto</option>
                        </select>
                    </div>
                    <div class="servico">
                        <label for="serv">Procedimento</label>
                        <select name="servico" id="serv" class="servicos">
                            <option value=""></option>
                            <option value="">Corte</option>
                            <option value="">Tintura</option>
                            <option value="">Mão</option>
                        </select>
                    </div>
                </div>
                <div class="telefone">
                    <label for="contato">Contato</label>
                    <input type="text" name="contato" id="contato" class="tel">
                </div>

                <div class="horarios">
                    <select name="hora" id="hora" class="horario">
                        <option value="">Horário</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                    </select>
                </div>
                <button type="submit" class="confirmar">Reagendar</button>
                <button class="fechar" id="fechar"><i class="fa-solid fa-xmark"></i></button>
            </dialog>-->


            <!--MODAL DE EDIÇÃO-->

            <dialog open>
                <div class="funcionario">
                    <img src="../imgs/fotocolab.svg" alt="funcionario" class="img">
                    <form method="post" action="#" enctype="multipart/form-data"><!--action=upload de foto-->
                        <input type="file" name="foto" id="foto"><i class="fa-solid fa-user-pen" style="color: #f2f2f2;" id="icon"></i>
                    </form>
                    <div class="nome">
                        <label for="nome">Nome</label>
                        <input type="text" class="nome"><!--trazer do php-->
                    </div>
                </div>
                <div class="infotres">
                    <div class="contato">
                        <label for="contato">Contato</label>
                        <input type="text" name="contato" id="contato" class="tel">
                    </div>
                    <div class="status">
                        <select name="situacao" id="situ" class="situacao">
                            <option value="">Situação</option>
                            <option value="">Ativo</option>
                            <option value="">Inativo</option>
                        </select>
                    </div>
                    <div class="cargos">
                        <select name="cargo" id="cargo" class="cargo">
                            <option value="">Cargo</option>
                            <option value="">Manicure</option>
                            <option value="">Maquiador</option>
                            <option value="">Gerente</option>
                            <option value="">Recepcionista</option>
                        </select>
                    </div>
                </div>
                <div class="infodois">
                    <div class="correiodigital">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="email">
                    </div>
                    <div class="ceps">
                        <label for="cep">CEP</label>
                        <input type="text" name="cep" id="cep" class="cep">
                    </div>
                </div>
                <div class="infodois">
                    <div class="enderecos">
                        <label for="endereco">Endereço</label>
                        <input type="endereco" name="endereco" id="endereco" class="endereco">
                    </div>
                    <div class="comp">
                        <label for="comp">Complemento</label>
                        <input type="text" name="complemento" id="comp" class="complemento">
                    </div>
                </div>
                <div class="infotres">
                    <div class="bairros">
                        <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="bairro">
                    </div>
                    <div class="cidades">
                    <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="cidade">
                    </div>
                    <div class="ufa">
                    <label for="uf">UF</label>
                        <input type="text" name="uf" id="uf" class="uf">
                    </div>
                </div>

                <button type="submit" class="confirmar">Confirmar</button>
                <button type="submit" class="cancelas">Cancelar</button>
                <button class="fechar" id="fechar"><i class="fa-solid fa-xmark"></i></button>

            </dialog>

        </section>
    </main>
    <?php
    include_once 'footer.php';
    ?>
</body>

</html>