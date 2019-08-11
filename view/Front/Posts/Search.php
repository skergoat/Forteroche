<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>search</title>

    <link rel="stylesheet" type="text/css" href="public/css/bulma/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/Front/style.css">  

    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>

  <body>

    <div class="container-container-search">

      <div class="container-button-search">
        <div class="container-close">
          <a id="search-close">
            <i class="far fa-window-close"></i>
          </a>
        </div>
      </div>

      <div class="container-search"> 
          <input class="input is-rounded input-search" id="search-value" type="email" >
          <a href="#" class="button" id="search-link">
            <i class="fas fa-search"></i>
          </a>
      </div>

    </div>

    <?php if(isset($_SESSION['admin'])) { ?>

    <div class="nav-admin">
      <a href="index.php?postaction=managearticles">
        Accéder a l'admin
      </a>
    </div>

    <?php } ?>

    <header>
      <a href="index.php">
        <div class="image-test">

          <div class="space-between">
            <h3 class="title logo">JEAN FORTEROCHE
            <span class="container-logo">
              <img src="public/img/plume.png" alt="plume"/>
            </span></h3>
          </div>
       
        </div>
      </a>
    </header>

    <div class="hero is-large"><!-- #F0AA39 -->
      <div class="hero-head" style="">

        <div class="buttons" style="display:flex;justify-content: flex-end;margin-bottom:0px;">

           <a id="search-open" class="search-button">
            <i class="fas fa-search" style="color:white;"></i>
          </a>

          <span class="navbar-burger burger" data-target="navbarMenuHeroB" style="margin-left:0px;margin-left:15px;">

            <span></span>
            <span></span>
            <span></span>
          </span>
          
        </div>
          <div class="container" id="containerNav">
            <div id="navbarMenuHeroB" class="navbar-menu">
              <div class="navbar-start">
                  <a class="navbar-item" href="index.php">
                    Accueil
                  </a>
                  <a class="navbar-item" href="index.php?websiteaction=biographie">
                    Biographie
                  </a>
                  <a class="navbar-item" href="index.php?websiteaction=publications">
                    Publications
                  </a>
                  <a class="navbar-item" href="index.php?websiteaction=contact">
                    Contact
                  </a>
                  <?php if(!isset($_SESSION['admin'])) { ?>
                  <a class="navbar-item" href="index.php?adminaction=admin">
                    Connexion
                  </a>
                  <?php } else { ?>
                  <a class="navbar-item" href="index.php?adminaction=logout">
                    Déconnexion
                  </a>
                  <?php } ?>
                  <a class="navbar-item" id="open-search">
                    <i class="fas fa-search"></i>
                  </a>
                  
                  <span class="navbar-item">
                    <a class="button is-info is-inverted" href="https://github.com/ApsaraWebDev/projet_4.git">
                      <span class="icon">
                        <i class="fab fa-github"></i>
                      </span>
                      <span>GitHub</span>
                    </a>
                  </span>

              </div>
                
              </div>
            </div>
          </div>

        </nav>
      </div>
    </div>

    <div class="div-responsive">
      <ul class="nav-responsive">
        <li>
          <a class="navbar-item" href="index.php">Accueil</a>
        </li>
        <li>
          <a class="navbar-item" href="index.php?websiteaction=biographie">Biographie</a>
        </li>
        <li>
          <a class="navbar-item" href="index.php?websiteaction=publications">Publications</a>
        </li>
        <li>
          <a class="navbar-item" href="index.php?websiteaction=contact">Contact</a>
        </li>
        <?php if(!isset($_SESSION['admin'])) { ?>
        <li>
          <a class="navbar-item" href="index.php?adminaction=admin">Connexion</a>
        </li>
        <?php } else { ?>
        <li>
          <a class="navbar-item" href="index.php?adminaction=logout">Déconnexion</a>
        </li>
        <?php } ?>

        <li>
          <a class="button is-info is-inverted github" href="https://github.com/ApsaraWebDev/projet_4.git">
            <span class="icon">
              <i class="fab fa-github"></i>
            </span>
            <span>GitHub</span>
          </a>
        </li>
      </ul>
    </div>

    <br/><br/>

		<?php if($return == false) { ?>

      <section class="container-container-title">

        <div class="container is-fluid sections page-title search-result">

          <h3 class="title is-2 is-book"> Résultats de la Recherche</h3>
          <h3 class="subtitle is-4">Desolé nous n'avons rien trouvé !</h3>

        </div>

      </section>

		<?php } else { ?>

      <section class="container-container-title">

        <div class="container is-fluid sections page-title search-result">

          <h3 class="title is-2 is-book"> Résultats de la Recherche</h3>
          <h3 class="subtitle is-4">On espère que vous trouverez votre bonheur</h3>

        </div>

      </section>

      <div class="container-result">

        <div class="columns is-multiline columns-search">

  			 <?php foreach($return as $result) { ?>

            <div class="column is-one-third card-search">

              <div class="card">
                <a href="index.php?postaction=post&amp;id=<?= $result->getId(); ?>">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <?php if($result->getPicture_url() == NULL) { ?>
                      <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
                      <?php } else { ?>
                      <img src="<?= $result->getPicture_url(); ?>" alt="<?= $result->getPicture_url(); ?>">
                      <?php } ?>
                  </figure>
                </div>
                <div class="card-content">
                  <div class="media">
                    <div class="media-content">
                      <p class="title is-4"><?= $result->getTitle(); ?></p>
                    </div>
                  </div>

                  <div class="content content-extract">
                  <?php $test = strip_tags($result->getContent()); ?>
                  <p><?= substr($test, 0, 140); ?>  <span class="readMore" title="lire la suite">[...]</span></p>
                </div>

                </div>
                </a>
              </div>
            </div>

            <?php } ?>

        </div>

      </div>

		<?php } ?>

	 <footer class="footer">
      <div class="content has-text-centered">
        <p>
          <strong>Design</strong> by <a href="https://www.skergoat.com" target="_blank">Stephane Kergoat</a>. 
        </p>
      </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!--     <script src="public/js/jquery.js"></script>  -->
    <script src="public/js/Admin.js"></script>
    <script src="public/js/Comment.js"></script>
    <script src="public/js/Thema.js"></script>
    <script src="public/js/Blog.js"></script>
    <script src="public/js/Reply.js"></script>
    <script src="public/js/Search.js"></script>
    <script src="public/js/Navbar.js"></script>

  </body>
</html>