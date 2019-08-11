<?php $title = "Modifier un article" ?>

<?php $tiny = "" ?>

<?php $bigTitle = "Mettre les articles à jour" ?>

<?php ob_start(); ?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea'});</script>

<?php $tiny = ob_get_clean(); ?>


<?php ob_start(); ?>

	<div class="buttons-centered">

	    <a class="button createArticle" href="index.php?postaction=post&amp;id=<?= $updateMessage->getId(); ?>">
            <strong>Voir l'Article</strong>
        </a>
          
        <?php if($updateMessage->getPublished() == 0){ ?>
			<a class="button is-success is-outlined blogJS public" id="published" href="index.php?postaction=published&amp;id=<?= $updateMessage->getId(); ?>&amp;action=true">
			<strong>Publier</strong>
			</a>
		<?php } else { ?>
			<a class="button is-danger is-outlined blogJS public" id="private" href="index.php?postaction=published&amp;id=<?= $updateMessage->getId(); ?>&amp;action=false">
			<strong>Suspendre la Publication</strong>
			</a>
		<?php } ?>

    </div>

	<br/>

	<section class="container is-fluid container-update">

		<div class="columns columns-update">

	  		<div class="column column-update column-bigest">

				<div class="notification is-success notification-success"></div>
				<div class="notification is-danger notification-failed"></div>

				<form action="index.php?postaction=updatepost&amp;id=<?= $updateMessage->getId(); ?>" class="blogForm" id="updatePost" method="post">

					<div class="field">
					  <label class="label title is-3">Titre</label>
					  <div class="control">
					    <input class="input first" type="text" name="title" id="updateTitle" value="<?= $updateMessage->getTitle(); ?>" placeholder="Text input">
					  </div>
					</div>

					<div class="field field-contenu">
					  <label class="label title is-3">Contenu</label>
					  <div class="control">
					    <textarea class="textarea second" name="content" id="updateContent" placeholder="Textarea" rows="35"><?= $updateMessage->getContent(); ?></textarea>
					  </div>
					</div>

					<div class="field is-grouped">
					  <div class="control">
					    <button class="button is-link">Enregistrer</button>
					    <a class="button deconnect DeletePost" href="index.php?postaction=destroy&amp;id=<?= $updateMessage->getId(); ?>">
				            Supprimer L'Article
				        </a>
					  </div>
					</div>

				</form>

			</div>

			<div class="column column-update column-smallest">

				<div class="card">
				  <div class="card-content">
				    <p class="title">
				      Thèmes
				    </p>


				   <div class="card">
					  <div class="card-content">
					    <p class="subtitle">
					      Créer un thème
					    </p>
					  </div>
				  	  <footer class="card-footer">
				    	<form action="index.php?themeaction=createthema" method="post" id="createThema" class="manageThema managePostPage">
				    		<div class="field createThema">
							  <div class="control">
							    <input type="text" class="input" name="thema" id="thema">
							    <input type="hidden" value="<?= $updateMessage->getId(); ?>" class="input" name="id" id="id">
							  </div>
							</div>
							<div class="field">
							  <div class="control">
							    <input type="submit" class="button is-info button-connect" value="Envoyer">
							  </div>
							</div>
				    	</form>
				 	  </footer>
					</div><br/><br/>

					<div class="notification is-success themaSuccess"></div>

					<div class="card" > 
					  <div class="card-content" >
					    <p class="subtitle">
					      Attribuer un thème
					    </p>
					  </div>
					  <footer class="card-footer card-footer-connect">
					   	<form action="index.php?themeaction=themepost&id=<?= $updateMessage->getId(); ?>" method="post" class="manageThema managePostPage" id="giveThema">
				    		<div class="field">
							  <div class="control">

							  	 <div  id="controlThema">

							  		<label class="radio radio-checked">
									    <input type="radio" name="theme" value="0" id="theme0" checked>
									    Aucun theme
									</label><br/>
														
								<div id="containerRadio">
							  	<?php foreach($themas as $thema) { ?>

							  		<label class="radio" id="unchecked<?= $thema->getId(); ?>">

							  			<a class="delete deleteThema" id="deleteThema<?= $thema->getId(); ?>" href="index.php?themeaction=deletethema&amp;id=<?= $thema->getId(); ?>&amp;id_post=<?= $updateMessage->getId(); ?>">
							  				<span id="<?= $thema->getId(); ?>"></span>
							  			</a>
									    <input type="radio" name="theme" value="<?= $thema->getId(); ?>" class="<?= $thema->getId(); ?>" id="theme<?= $thema->getId(); ?>">
									    <?= $thema->getTheme_label(); ?>

									</label><br id="testBr<?= $thema->getId(); ?>"/>

								<?php } ?>
								</div>

							   </div>
														
							  </div>
							</div>
							<div class="field">
							  <div class="control">		
							    <input type="submit" class="button is-info button-connect" value="Envoyer">
							  </div>
							</div>
				    	</form>
					  </footer>
					</div><br/><br/>

					<div class="notification is-danger alertPicture"></div>

					<div class="card">
						<div class="card-content">
							<h2 class="subtitle">Image à la une</h2>
						</div>
					    <div class="card-footer select-picture">
					      	<form action="index.php?postaction=updatepicture&id=<?= $updateMessage->getId(); ?>" method="post" enctype="multipart/form-data" class="pictures managePostPage" id="updatePicture"><br/>
				          	        <input type="file" name="monfichier" id="monfichier"/><br /><br />
						            <div class="container-buttons">
					                <input type="submit" class="button is-info sendPictures" value="Envoyer" />
						            <a href="index.php?postaction=deletepicture&id=<?= $updateMessage->getId(); ?>" method="post" class="button is-danger deletePictures" id="deletePicture">
										Effacer
										<span id="<?= $updateMessage->getId(); ?>"></span>
									</a>
								</div>
							</form>
					    </div><br />
						<div class="card-image">
						    <figure class="image is-4by3" id="illustrate<?= $updateMessage->getId(); ?>">
						    	<?php if($updateMessage->getPicture_url() == NULL) { ?>
						      	<img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
						      	<?php } else { ?>
						      	<img src="<?= $updateMessage->getPicture_url(); ?>" alt="<?= $updateMessage->getPicture_url(); ?>">
						      	<?php } ?>
						    </figure>
						</div>
					</div>

				</div>

			</div>

			<div id="essai"><?= $updateMessage->getTheme_id(); ?></div>

		</div>

	</section><br/>

<?php $content = ob_get_clean(); ?>

<?php require('view/Back/layout.php'); ?>