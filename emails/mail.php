<?php
include_once '../admin/conexao.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 

$emailEmpresa = 'vennushair.contato@gmail.com'; // Adicionem o email pessoal para fazer testes
$emailDestinatario = $email; // Adicionem o email pessoal para fazer testes

//Load Composer's autoloader
require '../vendor/autoload.php';

$linkValidacao = "https://agendamento.liliaborges.com.br/public/loginValidacao.php?cli=" . $cod_validacao;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    $mail->CharSet = 'UTF-8';
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $emailEmpresa;                     //SMTP username
    /* Colocar senha de app de terceiros do google smtp para atulização  */
    $mail->Password   = 'cqnp pddq yzem ufyd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($emailEmpresa, 'Vênus Hair');
    // $mail->addAddress($emailDestinatario, 'Nome do destinatário');     //Add a recipient
    $mail->addAddress($emailDestinatario);               //Name is optional


    // Captura o conteúdo PHP de 'conteudo.php'
    ob_start(); // Começa a captura de saída
    include 'validacao.php'; // Aqui você inclui o arquivo PHP
    $conteudoEmail = ob_get_clean(); // Captura a saída gerada e armazena na variável
    // $mail->addEmbeddedImage('./imgs/img.png', 'logo', 'imagem.png');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Valide seu perfil!';
    // $mail->Body    = 'Teste <b>PHPMailer</b>';
    // $mail->msgHTML(file_get_contents('conteudo.php'), __DIR__); // Pegar o arquivo onde estará a estrutura do e-mail
    $mail->msgHTML($conteudoEmail); // Pegar o arquivo onde estará a estrutura do e-mail
    $mail->AltBody = 'Vennus Hair - Habilite mais opções para o seu perfil! ;)';

    $mail->send();
    // echo 'Mensagem enviada';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}