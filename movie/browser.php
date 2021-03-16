<?php

////FICHIER DE RECEPTION CONTENU
////ADRESSE GET
if (isset($url)) {
  $d = dir( "movie/" . $url);
}else {
  $d = dir( "movie/");
}


while($entry = $d->read()) {




    if(stristr($entry, '.mkv') == TRUE || stristr($entry, '.avi') == TRUE || stristr($entry, '.mp4') == TRUE || stristr($entry, '.webm') == TRUE ) {
    ?>
      <div class=" tm-timeline-item">
        <div class="colg-lg-12">
          <div class="tm-timeline-item-inner">
              <img src="res/pictures/movie.png" alt="Image">
              <div class="tm-timeline-connector">
                  <p class="mb-0">&nbsp;</p>
              </div>
              <div class="tm-timeline-description-wrap">
                  <a href="index2.php?vid=<?= $entry ?>"><div class="tm-bg-dark tm-timeline-description">
                      <h6 class="tm-text-green tm-font-400"><?= $entry ?></h6>
                  </div></a>
              </div>
          </div>
        </div>
      </div>
      <br>
  <?php
  }
  elseif (stristr($entry, 'zdoc12') == TRUE) {
    $name = str_replace('zdoc12', '', $entry);
  ?>
    <div class=" tm-timeline-item">
        <div class="tm-timeline-item-inner">
            <img src="res/pictures/document.png" alt="Image">
            <div class="tm-timeline-connector">
                <p class="mb-0">&nbsp;</p>
            </div>
            <div class="tm-timeline-description-wrap">
                <a href="index2.php?doc=<?= $entry ?>"><div class="tm-bg-dark tm-timeline-description">
                    <h6 class="tm-text-orange tm-font-400"><?= $name ?></h6>
                </div></a>
            </div>
        </div>
    </div>
    <br>
    <?php
  }
}
$d->close();
?>
