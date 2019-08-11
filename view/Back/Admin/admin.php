<?php $title = "Admin" ?>

<?php $tiny = "" ?>

<?php $bigTitle = "Admin" ?>


<?php ob_start(); ?>

	<div class="container-auth">

		<div class="container-form-auth">

			<div class="notification is-success notification-success"></div>
			<div class="notification is-danger notification-failed"></div>

			<form action="index.php?adminaction=authentication" id="signIn" method="post" class="formulaire">

				<label class="label">Nom</label>
				  <div class="field">
				    <input class="input first" type="text" id="name" name="name" placeholder="Nom" required>
				  </div><br/>

				<label class="label">Mot de Passe</label>
				<div class="field">
				    <input class="input second" type="password" id="password" name="password" placeholder="Mot de passe" required>
				</div><br/>

				<div class="field is-grouped">
				  <div class="control">
				    <button class="button is-link" id="submit">Submit</button>
				  </div>
				</div>

			</form><br/>

			<a href="index.php?adminaction=recover">Mot de passe oublié ?</a>

		</div>

	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>