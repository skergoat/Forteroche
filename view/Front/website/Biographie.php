<?php $title = "biographie" ?>

<?php ob_start(); ?>

	<section class="container-container-title">

		<div class="container is-fluid sections test3">

			<h3 class="title is-1 title-homepage">Biographie</h3>
			<h3 class="subtitle is-4 subtitle-homepage">Comment devenir ce que l'on est</h3>

		</div>

	</section>

	<div class="container-page-bio">

		<div class="container-bio">
		
			<section class="section-bio-express">

				<div>
					<h1 class="title is-4 title-bio-express">Bio Express</h1>
				</div>

			</section>

			<div class="bio-express">
				
				<figure class="figure-identity">

			      	<img src="public/img/identite.jpg" alt="Placeholder image" class="picture-identity">

			    </figure>

			    <div class="para-bio-express">
			    	Après des études de philosophie et un début de carrière dans l'enseignement, je décide de me consacrer au voyage et à l’écriture. <em><a href="https://www.skergoat.com/projet_4/index.php?websiteaction=publications">L'appel du large</a></em> est mon premier roman, il obtient le Prix Goncourt en 2010. Depuis j'ai publié <em><a href="https://www.skergoat.com/projet_4/index.php?websiteaction=publications">Le pays du Grand Froid</a></em> qui a obtenu plusieurs prix littéraires en Europe. Mes thèmes de prédilection sont le voyage, les relations humaines, la liberté, et la quête de sens. J’ai 35 ans, j’ai grandi dans le sud de la France, et je voyage régulièrement avec ma femme et mon fils. 
			    </div>

			</div>
			
			<section class="section-bio-express longue">

				<div>
					<h1 class="title is-4 title-bio-express">Bio Version Longue</h1>
				</div>
				
				<div class="bio-longue">
				
				    <div class="para-bio-longue">
				    	<strong class="time">1983</strong> – Naissance à Toulon, France.
				    </div><br>

				    <figure class="figure-bio figure-after">

				      	<img src="public/img/enfance.png" alt="Placeholder image" class="picture-identity picture-after">

				    </figure>

				</div>

				<div class="bio-longue figure-after">
				
				    <div class="para-bio-longue">
				    	<strong class="time">Enfance</strong> – Un jour, je me mets à écrire des nouvelles. Tout le monde s’extasie, et je me dis qu’ils exagèrent. J’ai juste mis des mots les uns à la suite des autres, certains dont je ne connais même pas la signification. Mais je suis très fier car je sais utiliser une machine à écrire.<br><br>

						J’écris plein de petits contes et aventures. Mon premier chef d’oeuvre s’intitule <em>L'histoire Fantastique</em>, et c’est incompréhensible. Je suis très fier car il y a beaucoup de pages.<br><br>

						<strong class="time">Adolescence</strong> – Période un peu naze de ma vie. Je n’écris pas de roman mais je remplis une dizaine de journaux intimes. La machine a écrire est mise de côté. J’apprends cependant à taper sur un clavier avec les 10 doigts sans regarder. Ça fait comme dans les séries américaines et c’est la classe.<br><br>

						<strong class="time">2001</strong> – Je quitte le sud de la France pour faire des études de philosophie à Paris. Ça y est, je suis adulte, c’est le début de l’indépendance. J’apprends à cuisiner les pâtes et le riz.<br><br>

						<strong class="time">2007</strong> – Je suis diplômé et officiellement "philosophe". La même année j'obtiens un poste vacant de professeur de philosophie. J'y resterai pendant 10 ans.<br> <br>
				    </div>

				    <figure class="figure-bio figure-after">

				      	<img src="public/img/diplome.png" alt="Placeholder image" class="picture-identity picture-after diploma">

				    </figure>

				</div>

				<div class="bio-longue">
				
				    <div class="para-bio-longue">
				    	<strong class="time">2010</strong> – J’obtiens la cinquième place à un concours de nouvelles. J’y crois à fond. J’écris un nouveau premier chapitre de roman. C’est nul.<br> <br>

				    	<strong class="time">Mariage</strong> – Je porte un beau smoking comme dans James Bond. Je ne sauve pas le monde, mais je plais beaucoup à ma femme.<br> <br>

						<strong class="time">2011</strong> – Changement de paysage, destination l'amerique. Je pars vivre à Anchorage, en Alaska, pour donner des cours d'informatique (qui est ma seconde passion après la philosophie). Je tombe amoureux du pays et je décide de consacrer ma vie au voyage et à l'écriture.<br><br>

						<strong class="time">2012</strong> – Je commence l’écriture du roman qui deviendra <em><a href="http://localhost.test/index.php?websiteaction=publications">L'appel du Large</a></em>. Ma passion pour Microsoft Word se concrétise.<br><br>
				    </div>

				    <figure class="figure-bio figure-after">

				      	<img src="public/img/aventure.jpg" alt="Placeholder image" class="picture-identity picture-after">

				    </figure>

				</div>

				<div class="bio-longue">
				
				    <div class="para-bio-longue">

						<strong class="time">2013</strong> – Mon roman est encensé par la presse et reçoit le Prix Goncourt. Ma femme est tres fiere. Moi je n'en reviens pas.<br><br>  

						<strong class="time">2014</strong> – Naissance de mon fils. Début de mon second roman.<br> <br>

						<strong class="time">2016</strong> – Sortie de mon second roman qui reçoit plusieurs prix littéraires. Je découvre Scrinever et abandonne Word, sans pitié.<br> <br>

						<strong class="time">2017</strong> – A suivre…

				    </div>

				</div>

			</section>
			
		</div>

	</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/Front/layout.php'); ?>