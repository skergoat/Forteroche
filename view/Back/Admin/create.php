<?php $title = "Créer un administrateur" ?>

<?php $tiny = "" ?>

<?php $bigTitle = "Créer un administrateur" ?>


<?php ob_start(); ?>

<div class="container container-admin">

	<section>

		<!-- <div class="title is-4">Créer un administrateur</div> -->

		<div class="notification is-success notification-success is-admin"></div>
		<div class="notification is-danger notification-failed is-admin"></div>

		<form action="index.php?adminaction=storeadmin" method="post" class="formulaire" id="createAdmin">

			<div class="field">
			  <label class="label">Nom</label>
			  <div class="control">
			    <input class="input first" type="text" id="nameAdmin" name="nameAdmin" placeholder="Nom" required>
			  </div>
				  <p class="help name is-danger"></p>
			</div>

			<div class="field">
			  <label class="label">Mot de Passe</label>
			  <div class="control">
			    <input class="input second" type="password" id="passwordAdmin" name="passwordAdmin" placeholder="Mot de Passe" required>
			  </div>
			  <p class="help password is-danger"></p>
			</div>

			<div class="field">
			  <label class="label">Email</label>
			  <div class="control">
			    <input class="input third" type="email" id="mailAdmin" name="mailAdmin" placeholder="Email" required>
			  </div>
			  <p class="help mail is-danger"></p>
			</div>

			<div class="field is-grouped">
			  <div class="control">
			    <button class="button is-link">Envoyer</button>
			  </div>
			</div>

		</form>

	</section><br/><br/>

	<section>

		<!-- <div class="title is-4">Gérer les administrateurs</div> -->

		<table class="table is-bordered table-admin">
		  <thead>
		    <tr>
		      <th>Nom</th>
		      <th>Email</th>
		      <th>Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($listAdmin as $admins) { ?>
		    <tr id="delete-admin<?= $admins->getID(); ?>">
		      <th class="info-table"><a href="index.php?adminaction=updateadmin&amp;id=<?= $admins->getID(); ?>" class="modifier"><?= $admins->getName(); ?></a></th>
		      <td class="info-table"><?= $admins->getEmail(); ?></td>
		      <td class="info-table">
		      	<div class="column-item">
		      	  <div class="container-actions">
			          <a class="modifier" href="index.php?adminaction=updateadmin&amp;id=<?= $admins->getID(); ?>">
			            Modifier
			          </a>
			          <a class="supprimer AdminJS deleteArticle" id="suppressAdminButton<?= $admins->getID(); ?>" href="index.php?adminaction=deleteadmin&amp;id=<?= $admins->getID(); ?>">
			            Supprimer<span id="<?= $admins->getID(); ?>"></span>
			          </a>
			          
		    	  </div>
	      		</div>
		      </td>
		    </tr>
		    <?php } ?>
		  </tbody>
		</table>

	</section>

</div>	

<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>