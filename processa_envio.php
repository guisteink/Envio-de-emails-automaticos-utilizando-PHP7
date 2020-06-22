<?php

/**
 * lib do phpmailer 6.0
 */
require "./lib/PHPMailer/Exception.php";
require "./lib/PHPMailer/OAuth.php";
require "./lib/PHPMailer/PHPMailer.php";
require "./lib/PHPMailer/POP3.php";
require "./lib/PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/**
 * classe mensagem default da aplicação
 */
class Mensagem
{
	private $para = null;
	private $assunto = null;
	private $mensagem = null;
	public $status = array('codigo_status' => null, 'descricao_status' => '');

	/**
	 * getter default para qualquer atributo
	 */
	public function __get($atributo)
	{
		return $this->$atributo;
	}

	/**
	 * setter default para qualquer atributo
	 */
	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

	/**
	 * validação da mensagem a ser enviada
	 */
	public function mensagemValida()
	{
		if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
			return false;
		}
		return true;
	}
}

/**
 * instancia de envio do email
 */
$mensagem = new Mensagem();

/**
 * set de atributos utilizando o método da classe
 */
$mensagem->__set('para', $_POST['para']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('mensagem', $_POST['mensagem']);

/**
 * validação pelo metodo da classe
 */
if (!$mensagem->mensagemValida()) {
	header('Location: index.php');
}

/**
 * 
 */
$mail = new PHPMailer(true);
try {
	//Server settings
	$mail->SMTPDebug = false;                             // método para debugar erros no phpmailer, parar ver os logs coloque true
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                       // Host server do e-mail que voce utilizará para envio. ex: gmail = smtp.gmail.com
	$mail->SMTPAuth = true;                               // SMTP - authentication
	$mail->Username = 'user@example.com';                 // Email padrão de envio
	$mail->Password = 'secret';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	//Recipients
	$mail->setFrom('from@example.com', 'Mailer');	      // Send from
	$mail->addAddress($mensagem->__get('para'));          // Add a recipient, name is optional

	//Attachments
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	//Content
	$mail->isHTML(true);                                    // Set email format to HTML
	$mail->Subject = $mensagem->__get('assunto');
	$mail->Body    = $mensagem->__get('mensagem');

	/**
	 * sucesso no envio
	 */
	$mail->send();
	$mensagem->status['codigo_status'] = 1;
	$mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';
} catch (Exception $e) {
	/**
	 * falha no envio
	 */
	$mensagem->status['codigo_status'] = 2;
	$mensagem->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;
}
?>


<html>

<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/jpg" href="mail.png">
	<title>App Mail Send</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

	<div class="container">
		<div class="py-3 text-center">
			<img class="d-block mx-auto mb-2" src="mail.png" alt="" width="72" height="72">
			<h2>SendMail</h2>
			<p class="lead">Envio de emails automaticamente</p>
		</div>

		<div class="row">
			<div class="col-md-12">

				<? if($mensagem->status['codigo_status'] == 1) { ?>

				<div class="container">
					<h4 class="display-4 text-success">Email enviado</h4>
					<p><?= $mensagem->status['descricao_status'] ?></p>
					<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
				</div>

				<? } ?>

				<? if($mensagem->status['codigo_status'] == 2) { ?>

				<div class="container">
					<h4 class="display-4 text-danger">Ops!</h4>
					<p><?= $mensagem->status['descricao_status'] ?></p>
					<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
				</div>

				<? } ?>

			</div>
		</div>
	</div>

</body>

</html>