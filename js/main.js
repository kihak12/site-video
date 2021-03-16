var section = document.querySelector('.section');
var sections = document.querySelectorAll('.section');
var sectionsNumber = Array.from(sections).map(function (value, index) {
	return index;
});
var tab = document.querySelector('#tab');
var video = document.querySelector('video');

var progressBarIndicator = document.querySelector('#progress-bar div');
var percent = 0;

var url = location.href;
var ext = '';

var replaceVideo = function (name) {
	Array.from(video.children).forEach(function (child) {
		ext = child.src.substr(child.src.lastIndexOf('.'));

		child.src = 'videos/' + name + ext;

		video.load();
	});
};

video.addEventListener('timeupdate', function () {
	percent = Math.floor((100 / this.duration) * this.currentTime);
	progressBarIndicator.style.width = percent + '%';
});

window.addEventListener('scroll', function () {
    if (window.pageYOffset > (section.offsetHeight / 2))
    {
    	tab.classList.add('fixed');
    }
    else
    {
        tab.classList.remove('fixed');
    }

    if (window.pageYOffset > 0 && window.pageYOffset < section.offsetHeight)
    {
    	video.play();
    }
    else if (window.pageYOffset <= 0)
    {
    	video.pause();
    }
});

sectionsNumber.forEach(function (s) {
	window.addEventListener('scroll', function () {
		if (window.pageYOffset >= (section.offsetHeight - 1) * s)
		{
			if (video.children[0].src != url + 'videos/video-' + s + '.mp4' &&
				video.children[1].src != url + 'videos/video-' + s + '.webm')
			{
				replaceVideo('video-' + s);

				video.oncanplay = function () {
					this.play();
					duration = this.duration;
				}
			}
			s++;
		}
		else
			s--;
	});
});