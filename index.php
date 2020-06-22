<html>
	<head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/jpg" href="mail.png">
    	<title>SendMail</title>

		<!-- import do bootstrap -->
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
  				
					<div class="card-body font-weight-bold">
						<form action="processa_envio.php" method="post">
							<div class="form-group">
								<label for="para">Para</label>
								<input name="para" type="text" class="form-control" id="para" placeholder="exemplo@exemplo.com.br">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input name="assunto" type="text" class="form-control" id="assunto">
							</div>

							<div class="form-group">
								<label for="mensagem">Descrição</label>
								<textarea name="mensagem" class="form-control" id="mensagem"></textarea>
							</div>

							<button type="submit" class="btn btn-primary btn-dark">Enviar email</button>
						</form>
					</div>
				</div>
      		</div>
      	</div>

	</body>
</html>