// Charger les audios en JS

var snd1 = new Audio();
var src1 = document.createElement("source");
src1.type = "audio/mp3";
src1.src = "../extraitsSara/fallen/fallen2.mp3";
snd1.appendChild(src1);
snd1.loop = true;

var snd2 = new Audio();
var src2 = document.createElement("source");
src2.type = "audio/mp3";
src2.src = "../extraitsSara/fallen/fallenettajames.mp3";
snd2.appendChild(src2);
snd2.loop = true;

var snd3 = new Audio();
var src3 = document.createElement("source");
src3.type = "audio/mp3";
src3.src = "../extraitsSara/fallen/fallenronetrash.mp3";
snd3.appendChild(src3);
snd3.loop = true;

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

// play - stop au click
$(document).ready(function() {
    playSong(snd1);
    muteSong(snd2);
    playSong(snd2);
    muteSong(snd3);
    playSong(snd3);

    $(".player").on('click', function() {
        var video = document.querySelector('#myVid');
        $(this).toggleClass("player2");

        if (video.paused) {
            video.play();
            snd1.play();
            snd2.play();
            snd3.play();
        } else {
            video.pause();
            snd1.pause();
            snd2.pause();
            snd3.pause();
        }
    });

    // mute functions

    $(".sound").on('click', function() {
        var id = $(this).data("id");
        $(this).addClass("active");
        window["snd" + id].muted = false;

        $(".sound[data-id!=" + id + "]").each(function(key, el) {
            var currentId = $(el).data("id");
            $(this).removeClass("active");

            window["snd" + currentId].muted = true;
        });
    });

    // Synchroniser restart loop video et son
    var videoLoop = document.querySelector("#myVid");
    videoLoop.addEventListener('ended', function() {
        snd1.currentTime = 0;
        snd2.currentTime = 0;
        snd3.currentTime = 0;
        this.play();
        snd1.play();
        snd2.play();
        snd3.play();
    }, false);

    ////vidéo en plein ecran
    //
    //$(".full-screen").on(click, function(
    //var elem = document.getElementById("myvid");
    //if (elem.requestFullscreen) {
    //  elem.requestFullscreen();
    //} else if (elem.mozRequestFullScreen) {
    //  elem.mozRequestFullScreen();
    //} else if (elem.webkitRequestFullscreen) {
    //  elem.webkitRequestFullscreen();
    //}
    //	));
});
