<?php $title = "Recover" ?>

<?php $tiny = "" ?>

<?php $bigTitle = "Récupérer son mot de passe" ?>

<?php ob_start(); ?>
		
	<h3 class="title is-4">Entrez votre email</h3>

	<div class="container-recover">

		<div class="notification is-success notification-success"></div>
		<div class="notification is-danger notification-failed"></div>

		<form action="index.php?adminaction=postrecover" id="recover" method="post" class="formulaire">

			<label class="label">Email</label>
			  <div class="control">
			    <input class="input first" type="email" id="recoverMail" name="recoverMail" placeholder="Email" required>
			  </div>
			  <p class="help mail is-danger"></p>
			  <p class="help">Vous recevrez un code par email</p>
			<br/>

			<div class="field">
			  <div class="control">
			    <button class="button is-link" id="submit">Envoyer</button>
			  </div>
			</div>

		</form><br/>

	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>