<?php

$id = $_GET['c'];

?>

<html>
<head>
<title>CricHD</title>
<script src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@clappr/hlsjs-playback@1.2.0/dist/hlsjs-playback.min.js"></script>
<script type="text/javascript"src="https://cdn.jsdelivr.net/gh/clappr/clappr-level-selector-plugin@latest/dist/level-selector.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@c3voc/clappr-audio-track-selector@0.2.4/dist/audio-track-selector.min.js"></script>
<script>document.write(atob("PHNjcmlwdCB0eXBlPSd0ZXh0L2phdmFzY3JpcHQnIHNyYz0nLy92YWxsZXlhcm1pZXNzdW5mbG93ZXIuY29tL2MyLzRiL2FiL2MyNGJhYjQ4ZmY3ZDU4MTA0NmEwZjNiMGM4Y2VlY2RlLmpzJz48L3NjcmlwdD4="));</script>

<script>document.write(atob("PHNjcmlwdCB0eXBlPSd0ZXh0L2phdmFzY3JpcHQnIHNyYz0nLy92YWxsZXlhcm1pZXNzdW5mbG93ZXIuY29tLzMwLzRkLzNhLzMwNGQzYWZkYmQ0NWI3OTY3NzBjZmE0YzM3MzJhM2U5LmpzJz48L3NjcmlwdD4="));</script>
<style>
        body {
            margin: 0; /* Remove default margin */
            background-color: #000000; /* Dark gray background */
            height: 100vh; /* Full viewport height */
            overflow: hidden; /* Prevent scrolling */
        }

        #player-wrapper {
            height: 100%; /* Full height */
            width: 100%; /* Full width */
            position: relative;
            background-color: #fff; /* White background for the player */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            overflow: hidden; /* Prevent overflow */
        }
</style>
</head>  

<body>
<div id="player-wrapper">
    <div id="player" style="height: 100%; width: 100%;"></div>
</div> 

 <script>
      
    var player = new Clappr.Player({
    source: 'm3u8.php/<?php echo $id ; ?>.m3u8',
    plugins: [HlsjsPlayback, LevelSelector, AudioTrackSelector],
    width: '100%',
    height: '100%',
    autoPlay: true,
    mimeType: "application/x-mpegURL",
    mediacontrol: { seekbar: "#ff0000", buttons: "#eee" },
    parentId: "#player",
    hlsUseNextLevel: false,
    hlsMinimumDvrSize: 60,
    hlsRecoverAttempts: 16,
    hlsPlayback: {
        preload: true,
        customListeners: [],
    },
    playback: {
        extrapolatedWindowNumSegments: 2,
        triggerFatalErrorOnResourceDenied: false,
        hlsjsConfig: {
            // hls.js specific options
        },
    },
});

 </script>
</body>
</html>
