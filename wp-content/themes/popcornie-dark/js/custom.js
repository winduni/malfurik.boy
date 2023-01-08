$( document ).ready(function() {
const player = new Plyr('#player', {
    invertTime: false,
    // debug: true,
    seekTime: 1,
    controls: [
        'play-large', // The large play button in the center
        'restart', // Restart playback
        'rewind', // Rewind by the seek time (default 10 seconds)
        'play', // Play/pause playback
        'fast-forward', // Fast forward by the seek time (default 10 seconds)
        'progress', // The progress bar and scrubber for playback and buffering
        'current-time', // The current time of playback
        'duration', // The full duration of the media
        'mute', // Toggle mute
        'volume', // Volume control
        'captions', // Toggle captions
        'settings', // Settings menu
        'pip', // Picture-in-picture (currently Safari only)
        'airplay', // Airplay (currently Safari only)
        //'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
        'fullscreen' // Toggle fullscreen
    ]
    //  duration:true
    // keyboard: { focused: true, global: false }
});

$('.timecode').click(function () {

    let timecode = $(this).attr('data-timecode');
    player.currentTime = parseInt(timecode);
});
window.addEventListener('keydown', (e) => {
    if (e.keyCode === 32 && e.target === document.body) {
        e.preventDefault();
    }
});

(function () {
    var isCommenting;
    $(document).on('blur', '.ql-editor', function (event) {
        isCommenting = false;
    });

    $(document).on('focus', '.ql-editor', function (event) {
        isCommenting = true;
    });

    $(document).on('blur', '#wpdiscuz-subscribe-form', function (event) {
        isCommenting = false;
        console.log(isCommenting);
    });
    $(document).on('focus', '#wpdiscuz-subscribe-form', function (event) {
        isCommenting = true;
        console.log(isCommenting);
    });

    document.onkeydown = function iziz(iz) {
        if (iz.keyCode == '32' && !isCommenting) {
            if (player.playing) {
                player.pause();
            } else {
                player.play();
            }


        }
    };
})();


player.source = {
    type: 'video',
    // poster: 'Outback.jpg', // Путь к постеру по умолчанию
    sources: [
        {
            src: $('#pmovie__select-items option').val(), // Путь к постеру по умолчанию
            type: 'video/mp4',
            size: 720
        }
    ]
};


$(function () {
    // Включение трека по клику
    $('#pmovie__select-items').change(function () {

        let number = $('#pmovie__select-items option:selected').attr('data-number');

        let videourl = $(this).val();


        let timecode_actual = $(".timecode_parent").find("div[data-number='" + number + "']");
        $('.timecode_series').removeClass('show');
        console.log(number);
        timecode_actual.addClass('show');

        player.source = {
            type: 'video',
            //  poster: $(this).val(),
            sources: [
                {
                    src: videourl,
                    type: 'video/mp4',
                    size: 720
                }
            ]
        };
        player.play(); // если нужно запускать видео сразу по клику, раскомментируйте эту строчку
    });
    // Переключение аидео на следующее по окончанию
    player.on('ended', event => {

        let nextvideo = $('#pmovie__select-items option:selected').next();
        nextvideo.attr('selected', true);
        let urlnextvideo = nextvideo.attr('data-src');
        //console.log(urlnextvideo);
        //  let urlnextposter = nextvideo.attr('data-poster');

        ///
        let number = nextvideo.attr('data-number');
        let timecode_actual = $(".timecode_parent").find("div[data-number='" + number + "']");
        $('.timecode_series').removeClass('show');
        timecode_actual.addClass('show');
        ////


        if (!urlnextvideo) {
            player.stop();
        } else {


            player.source = {
                type: 'video',
                //   poster: urlnextposter,
                sources: [
                    {
                        src: urlnextvideo,
                        type: 'video/mp4',
                        size: 720
                    }
                ]
            };
            player.play(); // если нужно сразу запускать следующее видео, раскомментируйте эту строчку
        }
    });
});



});