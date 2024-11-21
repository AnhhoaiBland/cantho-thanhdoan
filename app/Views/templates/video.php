<!-- Ads Start -->
<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Truyền hình thanh niên</h4>
    </div>
    <div class="bg-white text-center border border-top-0 p-3">
        <iframe width="450" height="390" src="https://www.youtube.com/embed/Ag-YD1UR9Cc?list=PLNIMv2IQBhfN3czrh3wKFI9gy32JeYfR3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
<!-- Ads End -->

<!-- YouTube Playlist Start -->
<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Đại Hội Đoàn TP Cần Thơ Lần XI</h4>
    </div>
    <div class="bg-white text-center border border-top-0 p-3">
        <div id="player"></div>
    </div>
</div>
<!-- YouTube Playlist End -->

<script>
  // Load the IFrame Player API code asynchronously.
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // Replace the 'player' element with an <iframe> and
  // YouTube player after the API code downloads.
  var player;
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
      height: '390',
      width: '450',
      playerVars: {
        'listType': 'playlist',
        'list': 'PLNIMv2IQBhfOSvpQdk_8lZauAtIj4KAHk', // New playlist ID
        'autoplay': 1,
        'mute': 1,
        'controls': 1
      },
      events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      }
    });
  }

  function onPlayerReady(event) {
    console.log('Player is ready');
    event.target.playVideo();
  }

  function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.ENDED) {
      player.nextVideo();
    }
  }

  // Function to toggle fullscreen
  function toggleFullScreen() {
    var iframe = document.getElementById('player');
    if (iframe.requestFullscreen) {
      iframe.requestFullscreen();
    } else if (iframe.mozRequestFullScreen) { // Firefox
      iframe.mozRequestFullScreen();
    } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari and Opera
      iframe.webkitRequestFullscreen();
    } else if (iframe.msRequestFullscreen) { // IE/Edge
      iframe.msRequestFullscreen();
    }
  }

  // Add event listener to the player to toggle fullscreen on click
  document.getElementById('player').addEventListener('click', toggleFullScreen);
</script>