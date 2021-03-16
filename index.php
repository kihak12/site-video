<?php
if (isset($_POST['password'])) {
  include "res/usrs.php";

  if ($pass === $_POST['password']) {
    $_SESSION['user'] = true;
  }
}

require 'base/header.php';

?>

<body>

  <div class="col-lg-12 padd-1">

<div id="refresh"></div>
<?php

$text = file_get_contents("live_player.txt");
$live_movie = explode("%", $text);

$live_movie[0] = str_replace('\\', '/', $live_movie[0]);

$total_time = 1000 * $live_movie[1];
$actual_time = 1000 * $live_movie[2];



  if (isset($_GET['vid'])) {

      include 'movie/lecteur.php';

    ?>
    <head>
          <link rel="stylesheet" href="css/plyr.css" content="summary_large_image"/>
    </head>


    <?php
    }else {
      ?>
        <div class="center medium">
          <div id="live">
            <video class="size_vid" id="player_live" controls crossorigin playsinline muted ata-poster="" autoplay="1">
              <source src="<?= $live_movie[0] . "#t=" . $live_movie[2] ?>" />
            </video>
          </div>

      <script>

          var aud = document.getElementById("player_live");
          aud.onended = function() {
              setTimeout(function(){ $('#live').load('live_player.php'); }, 1200);

          };



          function update() {
              $('#refresh').load('refresh.php');
              }

          var vid = document.getElementById("player_live");

          setInterval('update()', 2000);
      </script>

          <br>
            <a href="about.php" style="font-size:32px; color: #5cb85c">A lire</a>
            <br>
            <p>
              Le site a été mit en ligne beaucoup plus tôt par rapport à ce qui était prévue.
              <br>Beaucoup de correctifs, d'ajouts, et d'amélioration sont à venir.
              <br>
              <a href="https://www.utip.io/kihak12" target="_blank" style="font-size:24px; color: #5cb85c">Me Soutenir</a>
            </p>
          <br>
          <br>
        </div>



      <?php
        include 'explorer.php';/////AFFICHAGE DE TOUS LES DOSSIER ET VIDEO
  }




?>

</div>

    <script src="https://cdn.plyr.io/3.6.3/demo.js" crossorigin="anonymous"></script>

</body>

</html>
