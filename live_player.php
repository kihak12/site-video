<?php
  $text = file_get_contents("live_player.txt");
  $live_movie = explode("%", $text);

  $live_movie[0] = str_replace('\\', '/', $live_movie[0]);
?>

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
  </script>
