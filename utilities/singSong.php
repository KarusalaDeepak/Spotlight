<?php
require_once("config.php");
$songID = $_POST["songID"];
$songID = intval(substr($songID, 4));
$query = $con->prepare("SELECT * FROM music WHERE id=:musicID");
$query->bindParam(":musicID", $songID);
$query->execute();
$sqldata = $query->fetch(PDO::FETCH_ASSOC);
$albumID = $sqldata["album"];
$query1 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
$query1->bindParam(":albumID", $albumID);
$query1->execute();
$sqldata1 = $query1->fetch(PDO::FETCH_ASSOC);
$album = "";
$musics = "";
$tracks = "[";
$trackIterator = 0;
$currentTrack = 0;
$albumCover = $sqldata1["cover"];
$album .= "<div class='app-card activeAlbumResult' id='searchAlbum$albumID'>
                <img src='$albumCover'/>
            </div>";
$query2 = $con->prepare("SELECT * FROM music WHERE album=:albumID");
$query2->bindParam(":albumID", $albumID);
$query2->execute();
$sqldata2 = $query2->fetchAll(PDO::FETCH_ASSOC);
foreach($sqldata2 as $row2)
{
    if($songID==$row2["id"])
    {
        $currentTrack = $trackIterator;
    }
    $trackName = $row2["name"];
    $trackComposer = $row2["composer"];
    $trackDuration = $row2["duration"];
    $trackDuration = substr($trackDuration, 3);
    $trackURL = $row2["musicURL"];
    $musics .= "<li id='$trackIterator' class='searchAlbum$albumID' style='display:none;'>
                    <div class='box'>
                        <div class='content'>
                            <div style='margin-right:auto;'>
                                <h3 style='margin-bottom:5px;'>$trackName</h3>
                                <h6>$trackComposer</h6>
                            </div>
                            <div>
                                <h5>$trackDuration</h5>
                            </div>
                        <div>
                    </div>
                </li>";
    $tracks .= "{
                    name: \"$trackName\",
                    artist: \"$trackComposer\",
                    duration: \"$trackDuration\",
                    image: \"$albumCover\",
                    url: \"$trackURL\",
                    album: \"$albumID\"
                },";
    $trackIterator++;
}
$tracks = substr($tracks, 0,-1);
$tracks .= "]";
$returnHTML = "
<main>
    <div id='searchPageLeftPanel'>
        $album
    </div>
    <div id='searchPageRightPanel'>
        <ul id=\"musiclist\">
            $musics        
        </ul>
    </div>
</main>
<div class=\"music\">
    <div>
        <div id=\"abl\" class=\"album\">
            <div class=\"circle\"></div>
            <img class=\"cover\"/>
            <img class=\"shadow\"></img>
        </div>
        <div class=\"musicname\"></div>
        <div class=\"artist\"></div>
        <div class=\"controll-panel\">
            <div class=\"center\">
                <span class=\"prev-btn controll-btn\">
                    <i class=\"fas fa-step-backward\"></i>
                </span>
            </div>
            <div class=\"center\">
                <span class=\"play-btn controll-btn\">
                    <i class=\"far fa-play-circle\"></i>
                </span>
                <span class=\"pause-btn controll-btn hidden\">
                    <i class=\"far fa-pause-circle\"></i>
                </span>
            </div>
            <div class=\"center\">
                <span class=\"next-btn controll-btn\">
                    <i class=\"fas fa-step-forward\"></i>
                </span>
            </div>
        </div>
        <div class=\"container\">
            <div class=\"player\">
                <div class=\"header-player\">
                    <div class=\"audio-record\">
                        <input type=\"checkbox\" id=\"audio_record-icon\" name=\"audio_record-icon\">
                        <label for=\"audio_record-icon\" class=\"player-icon audio_record-icon\">
                            <i class=\"material-icons\" title=\"Sing!\">mic</i>
                        </label>
                    </div>
                    <div class=\"audio-properties\">
                        <div class=\"audio_record-control\">
                            <button class=\"btn btn-default play-circle save\" id=\"play-recording\">
                                <i class=\"material-icons\" title=\"Play\">play_circle</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id=\"record-audio\" style='display:none;'></div>
        <div class=\"progress-panel\">
            <progress id=\"progress-bar\" value=\"0\" max=\"100\"></progress>
            <div class=\"time\">
                <label id=\"start-time\">00:00</label>
                <label>/</label>
                <label id=\"end-time\">00:00</label>
            </div>
        </div>
    </div>
</div>
<audio id=\"music\"></audio>
<script>
var musicbar = document.querySelector(\"#searchPage .music\");
var musicname = document.querySelector(\"#searchPage .musicname\");
var artis = document.querySelector(\"#searchPage .artist\");
var img = document.querySelector(\"#searchPage .cover\");
var imgs = document.querySelector(\"#searchPage .shadow\");
var rote = document.querySelector(\"#searchPage .cover\");
var playBtn = document.querySelector(\"#searchPage .play-btn\");
var pauseBtn = document.querySelector(\"#searchPage .pause-btn\");
var preBtn = document.querySelector(\"#searchPage .prev-btn\");
var nextBtn = document.querySelector(\"#searchPage .next-btn\");
var music = document.getElementById(\"music\");
var musicList = document.querySelectorAll(\"#searchPage li\");
var progressBar = document.getElementById(\"progress-bar\");
var currentTrack = 0;
var currentList;
var tracks = $tracks;
var mediaRecorder=null;
function initAudio()
{
    if (currentTrack === 0)
    {
        music.src = tracks[0].url;
        music.load();
    }
    for (var musicIndex = 0; musicIndex < musicList.length; musicIndex++)
    {
        musicList[musicIndex].addEventListener(\"click\", switchMusic, false);
    }
}
function switchMusic(e)
{
    if (currentList !== undefined)
    {
        removePlayedBackground();
        music.pause();
    }
    currentTrack = this.id;
    music.src = tracks[currentTrack].url;
    music.load();
    if(mediaRecorder)
    {
        stopRecording();
    }
    $(\"#record-audio\").html(\"\");
    play();
}  
function addChoosedBackground()
{
    currentList = document.getElementById(currentTrack);
    currentList.classList.add(\"song-play-now\");
}  
function removePlayedBackground()
{
    currentList.classList.remove(\"song-play-now\");
}  
function play()
{
    img.src = tracks[currentTrack].image;
    imgs.src = tracks[currentTrack].image;
    artis.innerHTML = tracks[currentTrack].artist;
    musicname.innerHTML = tracks[currentTrack].name;
    rote.classList.add(\"rote\");
    playBtn.classList.add(\"hidden\");
    pauseBtn.classList.remove(\"hidden\");
    musicbar.classList.add(\"openn\");
    if(document.querySelector(\"#record-audio audio\"))
    {
        recordAudio = document.querySelector(\"#record-audio audio\");
        recordAudio.pause();
    }
    else if(mediaRecorder !== null)
    {
        mediaRecorder.resume();
    }
    music.play();
    musicIsPlaying = true;
    addChoosedBackground();
    document.getElementById(\"end-time\").innerHTML = tracks[currentTrack].duration;
    $.post(\"utilities/songPlayed.php\", {userMail: sessionStorage.getItem('userMail'), albumID: tracks[currentTrack].album, musicURL: tracks[currentTrack].url});
}
function pause()
{
    rote.classList.remove(\"rote\");
    pauseBtn.classList.add(\"hidden\");
    playBtn.classList.remove(\"hidden\");
    musicIsPlaying = false;
    if(document.querySelector(\"#record-audio audio\"))
    {
        recordAudio = document.querySelector(\"#record-audio audio\");
        recordAudio.pause();
    }
    else if(mediaRecorder !== null)
    {
        mediaRecorder.pause();
    }
    music.pause();
}
function prePlay()
{
    removePlayedBackground();
    music.pause();
    if (currentTrack > 0)
    {
        currentTrack--;
    }
    else
    {
        currentTrack = tracks.length - 1;
    }
    music.src = tracks[currentTrack].url;
    music.load();
    if(mediaRecorder)
    {
        stopRecording();
    }
    $(\"#record-audio\").html(\"\");
    play();
}  
function nextPlay()
{
    removePlayedBackground();
    music.pause();
    if (currentTrack < tracks.length - 1)
    {
        currentTrack++;
    }
    else
    {
        currentTrack = 0;
    }
    music.src = tracks[currentTrack].url;
    music.load();
    if(mediaRecorder)
    {
        stopRecording();
    }
    $(\"#record-audio\").html(\"\");
    play();
}
function calculateTotalValue(length)
{
    var minutes = Math.floor(length / 60);
    var seconds_int = length - minutes * 60
    var seconds_str = seconds_int.toString()
    var seconds = seconds_str.substring(0, 2);
    time = minutes + \":\" + seconds;
    return time;
}
function formatTime()
{
    var timeline = document.getElementById(\"start-time\");
    var s = parseInt(music.currentTime % 60);
    var m = parseInt((music.currentTime / 60) % 60);
    if (s < 10)
    {
        timeline.innerHTML = m + \":0\" + s;
    }
    else
    {
        timeline.innerHTML = m + \":\" + s;
    }
}
function updateProgress()
{
    var current = music.currentTime;
    var percent = (current / music.duration) * 100;
    progressBar.setAttribute(\"value\", percent);
}
playBtn.addEventListener(\"click\", play, false);
pauseBtn.addEventListener(\"click\", pause, false);
preBtn.addEventListener(\"click\", prePlay, false);
nextBtn.addEventListener(\"click\", nextPlay, false);
music.addEventListener(\"ended\", pause, false);
music.addEventListener(\"timeupdate\", formatTime, false);
music.addEventListener(\"timeupdate\", updateProgress, false);
initAudio();
var mediaConstraints = {audio: true};
document.querySelector('#play-recording').onclick = function()
{
    if(document.querySelector(\"#record-audio audio\"))
    {
        music.src = tracks[currentTrack].url;
        music.load();
        music.volume = 0.3;
        recordAudio = document.querySelector(\"#record-audio audio\");
        recordAudio.volume = 0.7;
        play();
        recordAudio.play();
    }
    else
    {
        alert(\"Sing the song first!\");
    }
};
function startRecording(idx)
{
    navigator.mediaDevices.getUserMedia(mediaConstraints).then(onMediaSuccess).catch(onMediaError);
};
function stopRecording()
{
    mediaRecorder.stop();
    mediaRecorder.stream.stop();
};
function onMediaSuccess(stream)
{
    mediaRecorder = new MediaStreamRecorder(stream);
    mediaRecorder.stream = stream;
    mediaRecorder.mimeType = 'audio/wav';  
    mediaRecorder.audioChannels = 1;
    mediaRecorder.ondataavailable = function(blob)
    {
        $('#record-audio').html(\"<audio controls=''><source src=\" + URL.createObjectURL(blob) + \"></source></audio>\");
    };
    var timeInterval = 360 * 1000;
    mediaRecorder.start(timeInterval);
}
function onMediaError(e)
{
    console.error('media error', e);
}
$(document).on('click','input[name=\"audio_record-icon\"]',function()
{
    var checked = $('#audio_record-icon').prop('checked');
    if(checked == true)
    {
        startRecording();
        console.log('start');
    }
    else
    {
        stopRecording();
        mediaRecorder=null;
        music.pause();
        music.src = tracks[currentTrack].url;
        music.load();
        console.log('stop');
    }
});
music.src = tracks[currentTrack].url;
music.load();
play();
</script>";
echo $returnHTML;
?>