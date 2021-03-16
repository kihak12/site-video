<?php
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_GET['t'])){
  $time = $_GET['t'];
}else {
  $time = '0';
}


?>
<head>

  <link rel="stylesheet" href="../css/style.css">

</head>

<div class="container">


            <div class="center">
              <a class="navbar-brand" href="javascript:history.go(-1)">Retour</a>
              <a class="navbar-brand" href="index.php#vid">Accueil</a>
            </div>

      <video controls crossorigin playsinline data-poster="" id="player" autoplay="1">
        <source src="<?php echo $_GET['vid'] . '#t=' . $time ?>" />

  <!-- Captions are optional -->



  <?php

         $folder1 = str_replace('.mp4', '.vtt', $_GET['vid']);
         $folder1 = str_replace('_', ' ', $folder1);
         $baseGET = $_GET['vid'];

           ?>


        <track label="Français" kind="subtitles" srclang="fr" src="/<?= $folder1; ?>">
      </video>


<?php


$pos = strpos($_GET['vid'], 'EP');


        if ($pos === false) {

        } else {
          $extend = '.mkv';

          $format = strpos($baseGET, '.mp4');
          if ($format == TRUE) {
            $extend = '.mp4';
          }
          $format = strpos($baseGET, '.avi');
          if ($format == TRUE) {
            $extend = '.avi';
          }
          $format = strpos($baseGET, '.mkv');
            if ($format == TRUE) {
              $extend = '.mkv';
            }

            $pos++; $pos++;
            $posdix = $pos;

            $dixaine = $_GET['vid'][$posdix];


            $pos++;
            $unité = $_GET['vid'][$pos];
            $precedant = substr_replace($_GET['vid'], $unité-1, $pos);
            $suivant = substr_replace($_GET['vid'], $unité+1, $pos);





?>

<div class="center">
  <div class="left">
    <?php echo "Episode : " . $dixaine . $unité; ?>
  </div>
  <?php

if ($dixaine == 0) {
  $nb =  $unité;
}else {
  $nb =  $dixaine . $unité;
}


            if ($unité > 1 || $dixaine != 0) {
              if ($unité == 0 && $dixaine != 0) {
                $dixaine--;
                $dixaineprecedant = substr_replace($_GET['vid'], $dixaine, $posdix);
                ?>
                  <button class="btn btn-success" onclick="window.location.href='index.php?vid=<?= $dixaineprecedant . '9' . $extend; ?>'">Episode précédant</button>
                <?php
              }else {
                ?>
                  <button class="btn btn-success" onclick="window.location.href='index.php?vid=<?= $precedant . $extend; ?>'">Episode précédant</button>
                <?php
              }
            }
            if ($unité == 9 && $_SESSION['NbePs'] >= 10) {
              $dixaine++;
              $dixsuivant = substr_replace($_GET['vid'], $dixaine, $posdix);
              $baseGET = substr_replace($baseGET, $pos, $posdix);
              ?>
                <button class="btn btn-success" onclick="window.location.href='index.php?vid=<?= $dixsuivant . '0' . $extend; ?>'">Episode suivant</button>
              <?php

            }elseif ($_SESSION['NbePs'] == $nb) {

            }else {
              ?>
                <button class="btn btn-success" onclick="window.location.href='index.php?vid=<?= $suivant . $extend; ?>'">Episode suivant</button>
              <?php
            }

        }

                $VLCPlay = str_replace(' ', '%20', $_GET['vid']);
?>

<div class="col-lg-3">
    <button class="btn btn-success" onclick="window.location.href='vlc://http://192.168.1.38/<?= $VLCPlay; ?>'">Lire avec VLC</button>
    <a class="btn btn-success" href='<?= $_GET['vid']; ?>' download>Télécharger</a>
</div>
  </div> <?php

?>

</div>

  <script>

      let vidod = document.getElementById("player");

      vidod.addEventListener("mouseover", e => {
          setTimeout(function() {
              document.body.style.cursor = "none";
              window.addEventListener("mousemove", et => {
                  document.body.style.cursor = "default";
              });
          }, 3500);
      });

  </script>
