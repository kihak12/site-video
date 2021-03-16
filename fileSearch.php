<div class="row center">

  <?php

  $dir_only_movie = 'movie/';
  $onlyMovie = scandir($dir_only_movie);

  $row = 0;


  while (isset($onlyMovie[$row]))
  {
    if(stristr($onlyMovie[$row], '.mkv') == TRUE || stristr($onlyMovie[$row], '.avi') == TRUE || stristr($onlyMovie[$row], '.mp4') == TRUE || stristr($onlyMovie[$row], '.webm') == TRUE ) {

      $files3 = $onlyMovie[$row];


      if (stristr($files3, '.mkv') == TRUE) {
        $files3 = str_replace('.mkv', '', $files3);

      }elseif (stristr($files3, '.avi') == TRUE) {
        $files3 = str_replace('.avi', '', $files3);

      }elseif (stristr($files3, '.webm') == TRUE) {
        $files3 = str_replace('.webm', '', $files3);

      }elseif (stristr($files3, '.mp4') == TRUE) {
        $files3 = str_replace('.mp4', '', $files3);
      }

      include "res/picture.php";///// Lien vers banque image


    ?>


      <div onclick="location.href='index.php?vid=movie/<?= $onlyMovie[$row]?>';" class="tm-bg-dark card h-100 tm-timeline-item col-lg-2 col-md-5 mb-4" </div>
        <div class="tm-bg-dark card h-100 mt-2">
          <a href="index.php?vid=movie/<?= $onlyMovie[$row]?>"><img class="card-img-top" src="<?= $img[$files3] ?>" height="175"></a>
          <div class="card-body">
            <hr>
            <h6 class="tm-bg-dark card-title">
              <a href="index.php?vid=movie/<?= $onlyMovie[$row]?>"><?= $files3; ?></a>
            </h6>
          </div>
        </div>
      </div>


      <?php
    }//IF
      $row++;

  }//while
  ?>
</div>
