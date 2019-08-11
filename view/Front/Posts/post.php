<?php 

	// implement controller to show replies 

	use Controller\RepliesController;

	require_once('Controller/RepliesController.php');

	$newReply = new RepliesController; 

?>

<?php $title = $singleMessage->getTitle(); ?>

<?php $bigTitle = "Lire les articles" ?>

<?php ob_start(); ?>

	<?php if(isset($_SESSION['admin'])) { ?>

    <div class="column-item update-button">
      <a class="button createArticle" href="index.php?postaction=update&amp;id=<?= $singleMessage->getId(); ?>">
        <strong>Modifier</strong>
      </a>
    </div>

	<?php } ?>

	<section class="container-container-title">

		<div class="container is-fluid sections test3">

			<h3 class="title is-1 title-homepage"><?= $singleMessage->getTitle(); ?></h3>

		</div>

	</section>

	<div class="container is-fluid container-index container-main-post">

		<div class="layout-index">

	  		<div class="test1 test1-post"> <!-- section -->

				<div>

				  <div class="chapitres"><!-- artticle -->

				  	<div class="container-post-picture">

					  	<figure class="is-4by3 picture-post-index">
					      <?php if($singleMessage->getPicture_url() == NULL) { ?>
					      	<img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
					      	<?php } else { ?>
					      	<img src="<?= $singleMessage->getPicture_url(); ?>" alt="<?= $singleMessage->getPicture_url(); ?>">
					      	<?php } ?>
					    </figure>

					</div>

					<div class="container-reader" title="ouvrir le lecteur">
						<div class="container-icon-reader" id="open-reader">
							<i class="fas fa-book-open icon-reader"></i>
						</div>
					</div>

				    <?= $variable = $singleMessage->getContent(); ?>

				  </div>

				</div>

			</div>

			<!-- <div class="test2 test2-post">  -->

				<div class="test2 test2-post">

				<aside id="menuTry">

					<p class="title is-6 title-index title-index-post"><a href="index.php">Sommaire du Roman</a></p>

					<div class="container-list-index" id="menuIndex">

					<?php require('getIndex.php'); ?>

					</div>

				</aside>

			</div>

		</div>

	</div>

	<div class="column is-9 container-send-comments">

		<div class="container-comments">
		
			<div id="commentMedia"><!-- section -->

				<?php if($nbComments[0] > 0) { ?>

				<div><h3 class="title is-3 title-index-post">Commentaires</h3></div><br/><br/>

				<?php } ?>

			<?php foreach($showComment as $comment) { ?>

			<!-- Commentaires -->

				<div class="box commentBox" id="media<?= $comment->getID(); ?>">
					<div class="media containerButton"> <!-- artticle -->
					  <figure class="media-left user-picture">
					    <p class="image is-64x64">
					      <img src="public/img/user.png" alt="user picture">
					    </p>
					  </figure>
					  <div class="media-content content-post-comment">
					    <div class="content">
					    	<div class="container-post-comment">
						      	<p class="para-author"><strong><?= $comment->getAuthor(); ?></strong></p>
					      		<div class="buttons">
					      			
						    		<div class="dropdown commentActions" id="actions<?= $comment->getID(); ?>">
									  <div class="dropdown-trigger" id="trigger<?= $comment->getID(); ?>">
									    <button class="button choice-button" aria-haspopup="true" aria-controls="dropdown-menu<?= $comment->getID(); ?>">
									      <span>Actions</span>
									      <span class="icon is-small">
									        <i class="fas fa-angle-down" aria-hidden="true"></i>
									      </span>
									    </button>
									  </div>
									  <div class="dropdown-menu" id="dropdown-menu<?= $comment->getID(); ?>" role="menu">
									    <div class="dropdown-content">
											<a class="dropdown-item commentButton report" title="signaler" id="report<?= $comment->getID(); ?>" href="index.php?comaction=moderate&amp;id=<?= $comment->getID(); ?>&amp;postid=<?= $comment->getPost_id(); ?>&amp;action=report">
								    		Signaler
								    		<span id="<?= $comment->getID(); ?>"></span>
								    		</a>
									      <a class="dropdown-item" id="repondre<?= $comment->getID(); ?>" href="#commentFormula">
									        Répondre
									        <span class="<?= $comment->getID(); ?>"></span>
									      </a>
									    </div>
									  </div>
									</div> 
						      	<?php if(isset($_SESSION['admin'])){ ?>
						      		<a class="delete commentButton deleteCom" id="post<?= $comment->getID(); ?>" href="index.php?comaction=delete&amp;id=<?= $comment->getID(); ?>&amp;page=post&amp;postid=<?= $comment->getPost_id(); ?>">
						      			<span id="<?= $comment->getID(); ?>"></span>
						      		</a>
						      	<?php } ?>
						      	</div>
						     </div>
					       
					        <p class="content-comment"><?= $comment->getContent(); ?></p>
					    </div>
					  </div>
					</div>
					<!--</div>-->
						<?php 

							$count = $newReply->countReplies($comment->getID());

						if($count > 0) {

						?>
						<div class="box replyBox" id="replyBox<?= $comment->getID(); ?>">
						<?php 

							$replies = $newReply->getRepliesByComment($comment->getID());

						foreach($replies as $reply) { ?>

					<!-- Reponses -->

						<div class="media containerButton replyNumber<?= $comment->getID(); ?> content-article" id="replies<?= $reply->getId(); ?>">
						  <figure class="media-left user-picture">
						    <p class="image is-64x64">
						      <img src="public/img/admin.png" alt="admin picture">
						    </p>
						  </figure>
						  <div class="media-content content-reply">
						    <div class="content content-reply">	  
						    	<p class="content-content-reply">
						    		<strong>Admin</strong>
						      		<strong><?= $reply->getUser_name(); ?></strong>
						      	<?php if(isset($_SESSION['admin'])){ ?>
		<!-- commentButton -->		<a class="delete deleteReply" id="deleteReply<?= $reply->getId(); ?>" href="index.php?replyaction=deletereply&id=<?= $reply->getId(); ?>&postid=<?= $singleMessage->getId(); ?>">
						      			<span id="<?= $reply->getId(); ?>"></span>
						      			<span id="<?= $comment->getID() ?>"></span>
						      		</a>
						      	<?php } ?>	
						      	</p>
						        <p class="content-comment"><?= $reply->getReply(); ?></p>
						    </div>
						  </div>
						</div> <!-- artticle -->

						<?php } ?>
					</div>
					<?php } ?>
					<div class="buttonAdminReply" id="buttonAdminReply<?= $comment->getID(); ?>">
						<div class="buttons">
					    	<?php if(isset($_SESSION['admin'])) { ?>
					    	<a class="button is-primary is-outlined answer buttonResponse<?= $comment->getID(); ?>" id="<?= $comment->getID(); ?>">
					    	Répondre
					    	</a>
					    	<?php } ?>
					    </div>
				   </div>
				</div>

		 <!-- max reply id to JS -->

			<!-- Formulaire -->
				<?php if(isset($_SESSION['admin'])) { ?>													
				<div id="reportResponse<?= $comment->getID(); ?>" class="replyForm">
					<form action="index.php?replyaction=postreply&id=<?= $comment->getID(); ?>&postid=<?= $comment->getPost_id(); ?>" class="createReply" id="createReply<?= $comment->getID(); ?>" method="post">
					    <div class="field">
					    	<div class="columns is-multiline">
					    		<div class="column is-three-quarters">
							      <p class="control">

							      	<input class="infoReply" type="hidden" id="idReply" value="<?= $comment->getID(); ?>" name="idReply">
							       <input class="postReply" type="hidden" id="#" value="<?= $singleMessage->getId(); ?>" name="postReply" placeholder="Mail">
							      <?php if(isset($_SESSION['admin'])){ ?>
							      	 <input class="adminReply" type="hidden" id="adminReplyTrue" value="1" name="adminReply">
							      <?php } else { ?>
							      	<input class="adminReply" type="hidden" id="adminReplyFalse" value="0" name="adminReply">
							      <?php } ?>
							        <textarea class="textarea messageInput" id="message<?= $comment->getID(); ?>" name="message" rows="4"></textarea>
							      </p></p><p class="help is-danger helpMessage"></p>
							    </div>
							    <div class="column">
							      <p class="control">
							        <input type="submit" value="Envoyer" class="button is-link">
							      </p>
							    </div>
						    </div>
					    </div>
					</form>
				</div> <!-- artticle -->

			<?php } } ?>

			</div><br/><br/>

			<div><h3 class="title is-3 title-post-comment">Envoyer un Commentaire</h3></div><br/><br/>

			<div class="notification is-success success notification-success"></div>
			<div class="notification is-danger notification-failed"></div>

			<div class="media" id="commentFormula">
			  <div class="media-content">
			  	<form action="index.php?postaction=postcomment&id=<?= $singleMessage->getId(); ?>" id="postComment" class="sendComment" method="post">
				    <div class="field">
				      <p class="control">
				      	<input class="input first" type="text" id="author" name="author" placeholder="Author">
				      </p><br/>
				      <p class="control">
				      	<input class="input second" type="text" id="mail" name="mail" placeholder="Mail">
				      </p><p class="help mail is-danger"></p><br/>
				      <p class="control">
				        <textarea class="textarea third" id="contentComment" name="contentComment" rows="7"></textarea>
				      </p>
				    </div>
				    <div class="field">
				      <p class="control">
				        <input type="submit" value="Envoyer" class="button is-link">
				      </p>
				    </div>
				</form>
			  </div>
			</div><br/><br/><br/> <!-- artticle -->

		</div>

	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/Front/layout.php'); ?>