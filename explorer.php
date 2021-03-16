<?php

//Dossier defini comme racine
$ROOT = "./movie/";

//Gestion du telechargement


if(isset($_GET['currentdir'])){

    //Verifie que l'on ne peut pas se rendre sous la racine
    if(substr($_GET['currentdir'], 0, strlen($ROOT)) != $ROOT){
	$_GET['currentdir'] = $ROOT;
    } else {
        while(strpos($_GET['currentdir'], "..")>-1){
	    $_GET['currentdir'] = str_replace("..",".",$_GET['currentdir']);
        }
    }
    $currentdir=$_GET['currentdir'];
} else {
    $currentdir=$ROOT;
}


?>


<hr>

  <p id='vid'>

      <div class="contain">
          <div class="col-lg-12">
              <div class="center">
                <?php if (isset($_GET['img']) || isset($_GET['currentdir'])) {
                  ?>
                    <a class="navbar-brand" href="javascript:history.go(-1)">Retour</a>
                  <?php
                } ?>
              </div>
                  <h2 class="tm-welcome-text white" >  Toutes les vidéos :</h2>



          </div>
      </div>
      <div class="row">
        <?php
          DrawListFile($currentdir, '');
          if ($_SESSION['NbePs'] == '') {
            ?>
            <div class="col-lg center">
              <h4>Aucune vidéo dans ce dossiers</h4>
            </div>
            <?php
          }

        ?>
      </div>

  <br>  <!--////////////////////////////////////////////////////////////////////////////-->
    <p id="doc">

  <hr>

  <br>
      <div class="contain">
          <div class="col-lg-12">
              <h2 class="tm-welcome-text white" >Tout les dossiers :</h2>
          </div>
      </div>
      <div class="row">
       <?php
  	     DrawListDir($currentdir, '');
	     ?>
      </div>
      <br>
      <br>
	<?php
	    if(isset($_GET['select'])){
		ShowSelectFile($_GET['select']);
	    }
	?>

</center>
</body>
</html>

<?php


function DrawListFile($currentdir, $rename){
    $files = ListFile($currentdir);
    for($i=1; $i<=$files[0]; $i++){
      if($rename!=$files[$i]){

      if(stristr($files[$i], '.mkv') == TRUE || stristr($files[$i], '.avi') == TRUE || stristr($files[$i], '.mp4') == TRUE || stristr($files[$i], '.webm') == TRUE ) {

            $movie = $files[$i];
              if (stristr($files[$i], '.mkv') == TRUE) {
                $files[$i] = str_replace('.mkv', '', $files[$i]);

              }elseif (stristr($files[$i], '.avi') == TRUE) {
                $files[$i] = str_replace('.avi', '', $files[$i]);

              }elseif (stristr($files[$i], '.webm') == TRUE) {
                $files[$i] = str_replace('.webm', '', $files[$i]);

              }elseif (stristr($files[$i], '.mp4') == TRUE) {
                $files[$i] = str_replace('.mp4', '', $files[$i]);
              }

                $dirs[$i] = $files[$i];
                include 'res/picture.php';

      ?>

        <div onclick="location.href='index.php?vid=<?= $currentdir . '/' . $movie; ?>';" class="tm-bg-dark card h-100 tm-timeline-item col-lg-2 col-md-5 mb-4" </div>
          <div class="tm-bg-dark center h-100 mt-2">
            <a href="index.php?vid=<?= $currentdir . '/' . $movie; ?>"><img class="card-img-top" src="<?= $img[$files[$i]]; ?>" height="175"></a>
            <div class="card-body">
              <hr>
              <h6 class="tm-bg-dark card-title">
                <a href="index.php?vid=<?= $currentdir . '/' . $movie; ?>"><?= $files[$i]; ?></a>
              </h6>
            </div>
          </div>
        </div>
        <?php
      }


      }
    }
    echo "</table>";
}

function DrawListDir($currentdir, $rename){
    $dirs = ListDir($currentdir);
    for($i=1; $i<=$dirs[0]; $i++){
     if($rename!=$dirs[$i]){

      if (stristr($dirs[$i], 'zdoc12') == TRUE) {
        include 'res/picture.php';
        $doc = $dirs[$i];
        $docName = str_replace('zdoc12', '', $dirs[$i]);
        $dirs[$i] = str_replace('zdoc12', '', $dirs[$i]);


        if (isset($_GET['img'])) {
          $dirs[$i] = $_GET['img'];
          $sendImg = $_GET['img'];
        }else {
          $sendImg = $dirs[$i];
        }

  ?>

  <div onclick="location.href='index.php?currentdir=<?= $currentdir . '/' . $doc . '&img=' . $sendImg; ?>#vid';" class="tm-bg-dark card h-100 tm-timeline-item col-lg-2 col-md-5 mb-4" </div>
    <div class="tm-bg-dark center h-100 mt-2">
      <a href="index.php?currentdir=<?= $currentdir . '/' . $doc . '&img=' . $sendImg; ?>#vid"><img class="card-img-top" src="<?= $img[$dirs[$i]] ?>" height="175"></a>
      <div class="card-body">
        <hr>
        <h6 class="tm-bg-dark card-title">
          <a href="index.php?currentdir=<?= $currentdir . '/' . $doc . '&img=' . $sendImg; ?>#vid"><?= $docName; ?></a>
        </h6>
      </div>
    </div>
  </div>


  <?php
}

      }
    }
    echo "</table>";
}

function FilePerm($file){

	$perms = fileperms($file);
	if (($perms & 0xC000) == 0xC000) { 	 $info = 's'; // Socket
	} elseif (($perms & 0xA000) == 0xA000) { $info = 'l'; // Lien symbolique
	} elseif (($perms & 0x8000) == 0x8000) { $info = '-'; // Régulier
	} elseif (($perms & 0x6000) == 0x6000) { $info = 'b'; // Block special
	} elseif (($perms & 0x4000) == 0x4000) { $info = 'd'; // Dossier
	} elseif (($perms & 0x2000) == 0x2000) { $info = 'c'; // Caractère spécial
	} elseif (($perms & 0x1000) == 0x1000) { $info = 'p'; // pipe FIFO
	} else {				 $info = 'u'; // Inconnu
	}

	// Autres
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));

	// Groupe
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));

	// Tout le monde
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));

        return $info;
}


function DrawTree($root, $currentdir){

	//Affichage recursif des sous dossiers
        DrawTreeRecursive($currentdir, 1);

    echo "</table>";
}

function DrawTreeRecursive($path, $level){

    $cuts = array();
    $cuts = explode("/", $path);

    $cutpath = "";
    for($i=0; $i<=$level; $i++){
        $cutpath .= $cuts[$i] . "/";
    }

    $liste = array();
    $liste = ListDir($cutpath);
    for($i=1; $i<=$liste[0]; $i++){
	if($liste[$i] == $cuts[$level+1]){
	    echo "
	      <table cellspacing=1 style=\"font-family: tahoma; font-size: 11px; text-align: left;\">
		<tr style=\"cursor: pointer;\" OnClick=\"document.location.href='index.php?currentdir={$cutpath}{$liste[$i]}/';\">
	          <td width=" . ($level*12) . "></td>
	          <td><div style=\"width:7px; height: 7px; border: solid 1px #303030; line-height: 6px; font-size: 10px; color: #303030; background-color: white; margin-top: 2px; text-align: center;\">-</div></td>
	          <td><div style=\"width: 12px; height: 10px; border: solid 1px black; background-color: yellow; margin-top: 1px;\"></div></td>
	        </tr>
	      </table>";
	}
    }
}

function Delete($path){
    if(is_file($path)){
	unlink($path);
    } else {
        if(is_dir($path)){
	    $files = array();
	    $files = ListFile($path);
	    for($i=1; $i<=$files[0]; $i++){
		unlink($path . "/" . $files[$i]);
	    }
	    $dirs = array();
	    $dirs = ListDir($path);
	    for($i=1; $i<=$dirs[0]; $i++){
		Delete($path . $dirs[$i]);
	    }
	    rmdir($path);
	}
    }
}

function ListDir($root){
    $list = array();
    $list[0] = 0;
    if(is_dir($root)){
	$mydir = opendir("./{$root}");
	while ($file = readdir($mydir)){
            if($file !='' && $file != '..' && $file !='.' ){
    	        if (is_dir("./{$root}/{$file}")){
		    $list[0]++;
		    $list[$list[0]] = $file;
	        }
            }
	}
        rewinddir($mydir);
        closedir($mydir);
    }
    return $list;
}

function ListFile($root){

  if (!isset($_SESSION['NbEps'])) {
      $nbEp = 0;
  }

    $list = array();
    $list[0] = 0;
    if(is_dir($root)){
	//affiche d'abord les dossiers
	$mydir = opendir("./{$root}");
	while ($file = readdir($mydir)){
            if($file !='' && $file != '..' && $file !='.' ){
    	        if(is_file("./{$root}/{$file}")){
		    $list[0]++;
        if(stristr($file, '.mkv') == TRUE || stristr($file, '.avi') == TRUE || stristr($file, '.mp4') == TRUE || stristr($file, '.webm') == TRUE ) {
          $nbEp++;
        }
		    $list[$list[0]] = $file;
	        }
            }
	}
        rewinddir($mydir);
        closedir($mydir);
    }
    $nbEp - 2;
    if ($nbEp != 0 || $nbEp < 0) {
    $_SESSION['NbePs'] = $nbEp;
    }


    return $list;
}


?>
