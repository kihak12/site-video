
<?php
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['NbEps'])) {
    $nbEp = 0;
}


while (isset($files2[$row2]))
{

  if(stristr($files2[$row2], '.mkv') == TRUE || stristr($files2[$row2], '.avi') == TRUE || stristr($files2[$row2], '.mp4') == TRUE || stristr($files2[$row2], '.webm') == TRUE ) {

    $files3 = $files2[$row2];

  ?>

  <div class=" tm-timeline-item">
    <div class="colg-lg-12">
      <div class="tm-timeline-item-inner">
          <img src="res/pictures/movie.png" alt="Image">
          <div class="tm-timeline-connector">
              <p class="mb-0">&nbsp;</p>
          </div>
          <div class="tm-timeline-description-wrap">
              <a href="index.php?vid=<?= $scanDoc . '/' . $files2[$row2]?>"><div class="tm-bg-dark tm-timeline-description">
                  <h6 class="tm-text-green tm-font-400"><?php echo $files3; ?></h6>
              </div></a>
          </div>
      </div>
    </div>
  </div>
  <br>
<?php
       $nbEp++;
}
elseif (stristr($files2[$row2], 'zdoc12') == TRUE) {

  ?>
  <div class=" tm-timeline-item">
      <div class="grey tm-timeline-item-inner">
          <img src="res/pictures/document.png" alt="Image">
          <div class="tm-timeline-connector">
              <p class="mb-0">&nbsp;</p>
          </div>
          <div class="tm-timeline-description-wrap">
              <a href="index.php?doc=<?= $files2[$row2]?>"><div class="tm-bg-dark tm-timeline-description">
                  <h6 class="tm-text-orange tm-font-400"><?= $files2[$row2]; ?></h6>
              </div></a>
          </div>
      </div>
  </div>
</div>
  <?php
}
  $row2++;
}

////////////PREMIERE PAGE :
?>
  <div class="row center">

<?php

if (!isset($_GET["doc"])  && !isset($_GET['vid'])) {
  while (isset($files1[$row]))
  {
    if(stristr($files1[$row], '.mkv') == TRUE || stristr($files1[$row], '.avi') == TRUE || stristr($files1[$row], '.mp4') == TRUE || stristr($files1[$row], '.webm') == TRUE ) {

      $nbEp++;
      $files3 = $files1[$row];


      if (stristr($files3, '.mkv') == TRUE) {
        $files3 = str_replace('.mkv', '', $files3);

      }elseif (stristr($files3, '.avi') == TRUE) {
        $files3 = str_replace('.avi', '', $files3);

      }elseif (stristr($files3, '.webm') == TRUE) {
        $files3 = str_replace('.webm', '', $files3);

      }elseif (stristr($files3, '.mp4') == TRUE) {
        $files3 = str_replace('.mp4', '', $files3);
      }


      include "res/picture.php";

    ?>


      <div onclick="location.href='index.php?vid=<?= $files1[$row]?>';" class="tm-bg-dark card h-100 tm-timeline-item col-lg-2 col-md-5 mb-4" </div>
        <div class="tm-bg-dark card h-100 mt-2">
          <a href="index.php?vid=<?= $files1[$row]?>"><img class="card-img-top" src="<?= $img[$files3] ?>" height="175"></a>
          <div class="card-body">
            <hr>
            <h6 class="tm-bg-dark card-title">
              <a href="index.php?vid=<?= $files1[$row]?>"><?= $files3; ?></a>
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
  <br>
  <br>
    <p id="back_doc">
  <hr>
  <div class="contain">
      <div class="col-lg-12">
          <h2 class="tm-welcome-text white">Tout les dossiers :</h2>


      </div>
  </div>
  <div class="row center">
<?php

  $row = 0;

  while (isset($files1[$row]))
  {

    if (stristr($files1[$row], 'zdoc12') == TRUE) {

       $folder1 = str_replace('zdoc12', '', $files1[$row]);


       $nbEp++;

      ?>

      <div onclick="location.href='index.php?doc=<?= $files1[$row]?>';" class="tm-bg-dark card h-100 tm-timeline-item col-lg-2 col-md-5 mb-4" </div>
        <div class="tm-bg-dark card h-100 mt-2">
          <a href="index.php?doc=<?= $files1[$row]?>"><img class="card-img-top" src="<?= $img[$files1[$row]] ?>" height="175"></a>
          <div class="card-body">
            <hr>
            <h6 class="tm-bg-dark card-title">
              <a href="index.php?doc=<?= $files1[$row]?>"><?= $folder1; ?></a>
            </h6>
          </div>
        </div>
      </div>



      <?php
    }//IF
      $row++;

  }//while

  /////FIN PREMIERE PAGE.

?>
</div>
<?php

}
if ($nbEp != 0 ) {
$_SESSION['NbePs'] = $nbEp;
}
