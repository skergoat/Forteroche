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
				
				<h3 class="title is-4">Infos personnelles</h3>

				<div class="notification is-success notification-success"></div>
				<div class="notification is-danger notification-failed"></div>

				<form action="index.php?adminaction=storeupdate&amp;id=<?= $updateAuth->getId() ?>" method="post" class="formulaire" id="updateAdmin">

					<div class="field">
					  <label class="label">Nom</label>
					  <div class="control">
					    <input class="input first" type="text" name="updateName" id="updateName" value="<?= $updateAuth->getName() ?>" placeholder="Name">
					  </div>
					  <p class="help name is-danger"></p>
					</div>

					<div class="field">
					  <label class="label">Email</label>
					  <div class="control">
					    <input class="input second" type="mail" value="<?= $updateAuth->getEmail() ?>" name="updateMail" id="updateMail" placeholder="Email">
					  </div>
					  <p class="help mail is-danger"></p>
					</div>

					<div class="field is-grouped">
					  <div class="control">
					    <button class="button is-link">Envoyer</button>
					  </div>
					</div>

				</form>
				
			</section>

		</div>

	</div><br><br>

	
<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>