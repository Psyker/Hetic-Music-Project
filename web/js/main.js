// Charger les audios en JS
function playAllSounds(audios) {
    $.each(audios, function (key, el) {
        el.play();
    });
}

function pauseAllSounds(audios) {
    $.each(audios, function (key, el) {
        el.pause();
    });
}

function pauseAll(video, audios) {
    video.pause();
    pauseAllSounds(audios);
}

function playAll(video, audios) {
    video.play();
    playAllSounds(audios);
}

function muteSong(el) {
    el.muted = true;
}

function unmuteSong(el) {
    el.muted = false;
}

function pauseSong(el) {
    el.pause();
}

function playSong(el) {
    el.play();
}

$(document).ready(function() {
    var video = document.getElementById("myVid"),
        audios = {};

    var webm = $('#webm');
    webm.volume = 0.0;

    $(".sound").each(function (key, el) {
        var $el = $(el);
        var id = $el.data("id"),
            src = $el.data("src"),
            sound = new Audio(),
            source = document.createElement("source");

        source.type = "audio/mp3";
        source.src = src;
        sound.appendChild(source);
        sound.loop = true;

        audios[id] = sound;

        playSong(sound);

        if (key != 0) {
            muteSong(sound);
        }
    });

    /*$("#owl-example").owlCarousel({

    });*/

    $(video).click(function () {
        if (video.paused) {
            video.play();
            playAllSounds(audios);
        } else {
            video.pause();
            pauseAllSounds(audios);
        }
    });

    $(".player").click(function() {
        $(this).toggleClass("player2");

        if (video.paused) {
            playAll(video, audios);
        } else {
            pauseAll(video, audios);
        }
    });

    // mute functions

    $(".sound").click(function () {
        var $this = $(this);
        var id = $this.data("id");

        $this.addClass("active");

        audios[id].muted = false;

        $(".sound[data-id!=" + id + "]").each(function (key, el) {
            var currentId = $(el).data("id");
            $(this).removeClass("active");

            audios[currentId].muted = true;
        });
    });

    // Synchroniser restart loop video et son
    if (video != null) {
        video.addEventListener("ended", function() {
            $.each(audios, function (key, el) {
                el.currentTime = 0;
                el.play();
            });
            this.pause();
            this.currentTime = 0;
            this.load();
        }, false);
    }
    //vidéo en plein ecran
    $(".full-screen").on('click', function() {
        var elem = document.getElementById("myVid");
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        }
    });

});

// SLIDER

function loopNext(){
    $('#sliderWrapper').stop().animate({scrollLeft:'+=60'}, 'fast', 'linear', loopNext);
}

function loopPrev(){
    $('#sliderWrapper').stop().animate({scrollLeft:'-=60'}, 'fast', 'linear', loopPrev);
}

function stop(){
    $('#sliderWrapper').stop();
}


$('#next').hover(function () {
    loopNext();
},function () {
    stop();
});

$('#prev').hover(function () {
    loopPrev();
},function () {
    stop();
});
