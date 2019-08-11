<?php $title = "Mettre a jour un admin" ?>

<?php $bigTitle = "Modifier un administrateur" ?>

<?php $tiny = "" ?>

<?php ob_start(); ?>

	<div class="container-page-updateAdmin">

		<div class="container-update-admin">

			<section class="container-menu-admin">

		        <div class="tabs is-toggle is-toggle-rounded">
		          <ul>
				    <li> 
			          <a href="index.php?adminaction=createadmin">
			            <strong>Voir les admins</strong>
			          </a>
				    </li>
				    <li>
				      <a href="index.php?adminaction=updateadmin&id=<?= $updateAuth->getId() ?>">
			            <strong>Infos Personnelles</strong>
			          </a>
				    </li>
				    <li>
				      <a href="index.php?adminaction=updatepasspage&id=<?= $updateAuth->getId() ?>">
			            <strong>Mots de Passe</strong>
			          </a>
				    </li>
				  </ul>
				</div>

			</section><br/><br/>

			<section>
				
				<h3 class="title is-4">Modifier le mot de passe</h3>

				<div class="notification is-success notification-success"></div>
				<div class="notification is-danger notification-failed"></div>

				<form action="index.php?adminaction=updatepassword&id=<?= $updateAuth->getID() ?>&nom=<?= $updateAuth->getName() ?>" method="post" class="formulaire" id="updatePassword">

					<div class="field">
					  <label class="label">Ancien mot de passe</label>
					  <div class="control">
					    <input class="input first" type="password" name="formerPassword" id="formerPassword" required>
					  </div>
					  <p class="help lastPassword is-danger"></p>
					</div>

					<div class="field">
					  <label class="label">Nouveau mot de passe</label>
					  <div class="control">
					    <input class="input second" type="password" name="newPassword" id="newPassword" required>
					  </div>
					  <p class="help password is-danger"></p>
					</div>

					<div class="field is-grouped">
					  <div class="control">
					    <button class="button is-info">Envoyer</button>
					  </div>
					</div>

				</form>
				
			</section>

		</div>

	</div><br><br>

	
<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>