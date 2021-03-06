<?php 
  global $template; $template_name = explode('.', basename($template)); 
?>

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container navbar-adjust">
    <a class="new-navbar-logo" href="/"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span><i class="fa fa-bars" aria-hidden="true"></i></span>
  </button>
    <div class="collapse navbar-collapse"  id="navbarText" data-menu="<?php echo $template_name[0]; ?>">
      <ul class="navbar-nav">
        <li class="nav-item" >
          <a href="/" data-link="index" class="nav-link index">Home</a>
        </li>
      </ul>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="/podcasts" data-link="podcasts" class="nav-link podcasts ?>">Podcasts</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right ul-links">
        <li class="nav-item">
          <div class="separator">

          </div>
        </li>
        <li class="nav-item text-center">
          <a href="https://open.spotify.com/show/5XLM8K4Y3dqKEru8ehtFmo" target="new" class="icon-link-sociais mr-3"><i class="fab fa-spotify"></i></a>
          <a href="https://www.youtube.com/channel/UCAa1CAt8eil7zz9AbYwAujw" target="new" class="icon-link-sociais mr-3"><i class="fab fa-youtube"></i></a>
          <a href="https://www.instagram.com/miticamentepodcast/?hl=pt-br" target="new" class="icon-link-sociais mr-3"><i class="fab fa-instagram"></i></a>
          <a href="https://www.facebook.com/Castmiticamente/" target="new" class="icon-link-sociais mr-3"><i class="fab fa-facebook"></i></a>
          <a href="https://twitter.com/Castmiticamente" target="new" class="icon-link-sociais mr-3"><i class="fab fa-twitter-square"></i></a>
        </li>
      </ul>
    </div>
  </div>

</nav>
