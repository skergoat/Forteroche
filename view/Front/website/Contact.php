<?php $title = "Contact" ?>

<?php ob_start(); ?>

	<section class="container-container-title">

		<div class="container is-fluid sections test3">

			<h3 class="title is-1 title-homepage">Contact</h3>
			<h3 class="subtitle is-4 subtitle-homepage">Dites-moi tout</h3>

		</div>

	</section>

	<div class="container-page-form">

		<div class="container-publi">
			
			<div class="section-form-express longue">

				<div class="para-form-express">
					Pour me contacter, utilisez le formulaire ci-dessous.<br><br>
			    	Merci de ne pas m’envoyer de manuscrits, je ne suis pas agent littéraire ni éditeur, mais auteur - n'est-ce pas ? ;-) 
			    </div>

				<div class="notification is-success notification-success"></div>
				<div class="notification is-danger notification-failed"></div>

				<form action="index.php?websiteaction=sendmail" method="post" class="sendMail">

					<div class="field">
					  <label class="label">Nom</label>
					  <div class="control has-icons-left has-icons-right">
					    <input class="input" type="text" name="username" id="userpseudo" placeholder="Nom" required>
					    <span class="icon is-small is-left">
					      <i class="fas fa-user"></i>
					    </span>
					  </div>
					  <p class="help"></p>
					</div>

					<div class="field">
					  <label class="label">Email</label>
					  <div class="control has-icons-left has-icons-right">
					    <input class="input" type="email" name="usermail" id="useremail" placeholder="Email" required>
					    <span class="icon is-small is-left">
					      <i class="fas fa-envelope"></i>
					    </span>
					  </div>
					  <p class="help emailuser"></p>
					</div>

					<div class="field">
					  <label class="label">Message</label>
					  <div class="control">
					    <textarea class="textarea" placeholder="Message" id="usercontent" name="usermessage" rows="8" required></textarea>
					  </div>
					  <p class="help contentuser"></p>
					</div>

					<div class="g-recaptcha" data-sitekey="6LcQlYgUAAAAACg29p96jOvDpySEi8rk4nEx9pMF" id="recapcha"></div>

					<div class="field is-grouped">
					  <div class="control">
					    <button class="button is-link is-contact-submit">Envoyer</button>
					  </div>
					</div>

				</form>

			</div>
			
		</div>

	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/Front/layout.php'); ?>