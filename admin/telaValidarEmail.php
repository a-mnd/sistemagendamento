<main>
    <dialog id="avisos"></dialog>
    <section id='semAcesso'>
        <div>
            <i class="fa-solid fa-user-xmark"></i>
            <h3>Valide seu usuário!</h3>
        </div>
        <h4>
            Para ter acesso a esta página <br>Por favor, <span>valide seu usuário</span>.
            <br>
            <form action="../emails/emailValidInterna.php" method="post" id="formValidar">
                <?php
                if (!isset($_SESSION['contato']) || !isset($_SESSION['email'])) {
                    echo "<hr style='margin-block: 10px;'>";
                    echo "<p>Mas primeiro faça seu login.</p>";
                    echo "<a href='./login.php' id='btnLogar'>Logar<a/>";
                } else {
                ?>

                    <input type="hidden" value="<?= $_SESSION['contato'] ?>" name="contato">
                    <input type="hidden" value="<?= $_SESSION['email'] ?>" name="email">
                    <button id="validar" type="submit">Validar-se</button>
                <?php } ?>

            </form>
        </h4>
    </section>
</main>

<script>
    const form_agendamento = document.getElementById('formValidar');
    const btnValidar = document.getElementById('validar');
    const avisos = document.getElementById('avisos');

    form_agendamento.addEventListener('submit', (e) => {
        e.preventDefault();
        btnValidar.innerHTML = "Aguarde" + '<i class="fa-solid fa-spinner fa-spin"></i>';
        btnValidar.style.pointerEvents = "none";

        avisos.innerHTML = "<i class='fa-solid fa-spinner fa-spin'></i>" + "Eviando e-mail. Aguarde";
        avisos.open = true;
        let dados_form = new FormData(form_agendamento);
        fetch("../emails/emailValidInterna.php", {
                body: dados_form,
                method: 'POST'
            })
            .then((resposta) => {
                if (resposta.ok) {
                    return resposta.text()
                }
            })
            .then((dados) => {
                avisos.innerHTML = "<i class='fa-regular fa-calendar-check fa-bounce'></i>" + dados;
                avisos.open = true;
                setTimeout(() => {
                    avisos.open = false;
                }, 3000);
                btnValidar.style.pointerEvents = "auto";
                btnValidar.innerHTML = "Agendar";
            })
    });
</script>
</body>

</html>