<?php

  require_once('Controller/CommentController.php');

  use Controller\CommentController;

  $alertComments = new CommentController; 

  $alert = $alertComments->alert();

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script id="facebook-jssdk" async="" src="//connect.facebook.net/fr_FR/sdk.js"></script>
    <link rel="canonical" href="https:www.skergoat.com/projet_4/index.php">
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="accueil" />
    <meta property="og:description" content="site de Jean forteroche" />
    <meta property="og:url" content="https://www.skergoat.com/projet_4/index.php" />
    <meta property="og:image" content="https://www.skergoat.com/projet_4/public/img/admin.png" />
    <meta property="og:site_name" content="Jean Forteroche" />
    <title><?= $title ?></title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">   

    <!-- <link rel="stylesheet" type="text/css" href="public/css/bulma-0.7.2/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/fontawesome/css/fontawesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="public/css/Back/style.css">
    
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <?= $tiny ?>

  </head>
  <body>

    <div class="hero-head">
      <nav class="navbar  nav-admin">
        <div class="container-fluid container-nav-admin">
          <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
              JEAN FORTEROCHE
            </a>

        <?php if(isset($_SESSION['admin'])) { ?>

            <span class="navbar-burger burger navbar-burger-back" data-target="navbarMenuHeroA">
              <span></span>
              <span></span>
              <span></span>
            </span>

        <?php } ?>

          </div>
          <div id="navbarMenuHeroA" class="navbar-menu navbar-back">
            <div class="navbar-end">

         <?php if(isset($_SESSION['admin'])) { // not on "signin" page ?>

              <a class="navbar-item" href="index.php?postaction=managearticles">
                Les Articles
              </a>
              <?php if($alert == 0) { ?>
              <a class="navbar-item" href="index.php?comaction=moderate&action=moderate">
                Les Commentaires
              </a>
              <?php } else { ?>
              <a class="navbar-item comment-item" href="index.php?comaction=moderate&action=moderate">
                Les Commentaires
                <i class="fas fa-exclamation-circle alert-icon"></i>
              </a>
              <?php } ?>
              <a class="navbar-item" href="index.php?adminaction=createadmin">
                Les Administrateurs
              </a>

            <div class="navbar-item">
              <div class="buttons">
                <a class="button deconnect" href="index.php?adminaction=logout">
                  Déconnexion
                </a>
              </div>
            </div>

            <?php } ?>
              
            </div>
          </div>
        </div>
      </nav>
    </div>

    <div class="div-responsive">
      <ul class="nav-responsive">
        <li>
          <a class="navbar-item" href="index.php?postaction=managearticles">
            Les Articles
          </a>
        </li>
        <li>
          <a class="navbar-item" href="index.php?comaction=moderate&action=moderate">
            Les Commentaires
            <?php if($alert != 0) { ?><i class="fas fa-exclamation-circle alert-icon-responsive"></i><?php } ?>
          </a>
        </li>
        <li>
          <a class="navbar-item" href="index.php?adminaction=createadmin">
            Les Administrateurs
          </a>
        </li>
        <li>
          <a class="navbar-item" href="index.php?adminaction=logout">
            Déconnexion
          </a>
        </li>
      </ul>
    </div>

    <section class="hero is-link">
      <div class="hero-body">
          <div class="container">
            <h1 class="title">
              <?= $bigTitle ?>
            </h1>
          </div>
      </div>
      <div class="alertInfo"><?= $alertComments->alert(); ?></div>
    </section><br/><br/>

    <?= $content ?>
    
    <br/><br/>
    <footer class="footer">
      <div class="content has-text-centered">
        <p>
          <strong>© 2019 </strong><a href="index.php">Jean Forteroche</a>
        </p>
      </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="public/js/Admin.js"></script>
    <script src="public/js/Comment.js"></script>
    <script src="public/js/Thema.js"></script>
    <script src="public/js/Blog.js"></script>
    <script src="public/js/Reply.js"></script>
    <script src="public/js/Navbar.js"></script> 

  </body>
</html>
