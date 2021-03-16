let video = document.querySelector('.video');
let juice = document.querySelector('.orange-juice');
let btn = document.getElementById('play-pause');
let muteBtn = document.getElementById('mute');
let volumeslider = document.getElementById('volumeSlider');
let orangeBar = document.querySelector('.orange-bar');

function togglePlayPause() {

    if(video.paused){
        btn.className="pause";
        video.play();
    }
    else {
        btn.className = "play";
        video.pause();
    }

}

plyr.setup("#plyr-video");

btn.onclick = function(){
    togglePlayPause();
}

var timeout = null;
$(video).on('mousemove', function() {
  clearTimeout(timeout);
  $('.controls').css("bottom","0px");
  timeout = setTimeout(function() {
      $('.vidCE').css("bottom","-65px");
  }, 3000);
});

// barre orange

video.addEventListener('timeupdate', function(){

    let juicePos = video.currentTime / video.duration;

    juice.style.width = juicePos * 100 + '%';

    if(video.ended) {
        btn.className ="play";
    }


})

// mute la video


muteBtn.addEventListener('click', function(){

    if(video.muted){
        video.muted = false;
        muteBtn.innerHTML = "Mute";
    } else {
        video.muted = true;
        muteBtn.innerHTML = "Unmute";
    }

})

// Volume


volumeslider.addEventListener('change', function(){


    video.volume = volumeslider.value / 100;

})


// la barre orange clikable

let rect = orangeBar.getBoundingClientRect();
console.log(rect);

let largeur = rect.width;

orangeBar.addEventListener('click', function(e){


    // la valeur de notre click sur x par rapport a notre element

    let x = e.clientX - rect.left;

    let widthPercent = ((x*100)/largeur);

    let currentTimeTrue = (widthPercent * 63 ) / 100;

    // position en secondes
    video.currentTime = currentTimeTrue;
    // barre orange qui va la ou on clique
    juice.style.width = widthPercent + '%';

})
