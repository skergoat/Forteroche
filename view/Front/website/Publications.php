<?php $title = "Publications" ?>

<?php ob_start(); ?>

	<section class="container-container-title">

		<div class="container is-fluid sections test3">

			<h3 class="title is-1 title-homepage">Publications</h3>
			<h3 class="subtitle is-4 subtitle-homepage">Au fil de la plume</h3>

		</div>

	</section>

	<div class="container-page-bio">

		<div class="container-publi">
			
			<section class="section-bio-express longue">

				<!-- <div>
					<h1 class="title is-4 title-bio-express">Bio Version Longue</h1>
				</div> -->
				
				<div class="bio-longue">

					<figure class="figure-publi first-figure">

				      	<img src="public/img/froid.png" alt="Placeholder image" class="picture-publi">

				    </figure>

				    <div class="container-publi-content">

					    <div>
							<h1 class="title is-4 title-public-express">Résumé</h1>
						</div>

					    <div class="para-publi-longue first-para">
					    	 L'Alaska est mon pays d'adoption. Je suis tombé amoureux de cet endroit, des gens, des paysages âpres et silencieux. C'est ce qui m'a poussé à entreprendre un voyage de 30 jours, seul, dans les glaciers et les montagnes. Au cours de ce périple j'ai découvert des endroits à couper le souffle et j'ai fait des rencontres merveilleuses. Mais plus que tout, je me suis retrouvé moi-meme. Accompagnez-moi dans ce voyage qui fut autant intérieur qu'extérieur. Peut-être découvrirez-vous votre verité ?  
					    </div>

					</div>

				</div>

				<div class="bio-longue">

					<figure class="figure-publi">

				      	<img src="public/img/appeldularge.png" alt="Placeholder image" class="picture-publi">

				    </figure>

				    <div class="container-publi-content publi-content">

					    <div>
							<h1 class="title is-4 title-public-express">Résumé</h1>
						</div>

					    <div class="para-publi-longue">
					    	Partir à 34 ans, à l'autre bout du monde, en laissant derriere soi sa vie, son boulot, vous croyez que c'est impossible ? C'est pourtant ce que j'ai fait. Un beau matin, j'ai sauté dans le premier avion pour l'Alaska et hop, parti pour l'aventure ! Cela faisait trop longtemps que je me lamentais sur ma routine quotidienne sans rien faire. A un moment, si l'on veut vraiment vivre, il faut faire des choix. Ce choix, ce saut, je le raconte dans mon premier roman. Aurez-vous le courage de me suivre sans être, à votre tour, tenté par l'aventure ?           
					    </div>

					</div>

				</div>

			</section>
			
		</div>

	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/Front/layout.php'); ?>