<?php
use Alltube\Config;
use Alltube\VideoDownload;
require_once __DIR__.'/vendor/autoload.php';
$downloader = new VideoDownload(
new Config(
[
'youtubedl' => '/usr/lib/python3/dist-packages/youtube_dl/__main__.py',
'python'    => '/usr/bin/python',
]
)
);
$noVideoMsg = 1;
if (isset($_GET['videoURL']) && strpos($_GET['URL'], 'http') === 0) {
$videoURL = $_GET['videoURL'];
$noVideoMsg = 0;
$videoandaudio = array_shift($downloader->getURL($videoURL,'best'));
$video = array_shift($downloader->getURL($videoURL,'bestvideo+bestaudio'));
$audio = array_pop($downloader->getURL($videoURL,'bestvideo+bestaudio'));
if (empty($videoandaudio)|| empty($video) || empty($audio)) {
$noVideoMsg == 1;
} else {
$noVideoMsg = 0;
}
} if (isset($_POST['URL']) && strpos($_POST['URL'], 'http') === 0) {
$videoURL = $_POST['URL'];
$videoandaudio = array_shift($downloader->getURL($videoURL,'best'));
$video = array_shift($downloader->getURL($videoURL,'bestvideo+bestaudio'));
$audio = array_pop($downloader->getURL($videoURL,'bestvideo+bestaudio'));
if (empty($videoandaudio)|| empty($video) || empty($audio)) {
$noVideoMsg == 1;
} else {
$noVideoMsg = 0;
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>streamin.gg
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js">
    </script>
  </head>
  <body>
    <section class="section">
      <div class="container">
        <h1 class="title">streamin.gg
        </h1>
        <p class="subtitle">Paste your video link in the box here:
        </p>
        <div class="field has-addons">
          <div class="control is-expanded has-icons-left">
            <form action="index.php" method="post">
              <input class="input is-medium" type="text" name="URL" placeholder="Paste video link directly from browser"> 
              <span class="icon is-left">
                <i class="fas fa-video">
                </i>
              </span> 
              </div>
            <div class="control"> 
              <button type="submit" name"submit" class="button is-medium">Download
                </a> 
            </div>
          </div>
          <?php if($noVideoMsg == "1") {
echo "<br><article class='message has-icons-right is-small is-alert'><div class='message-header'><span class='icon is-right'>
<i class='fas fa-warning'></i>
</span> <p>No video link detected</p></div><div class='message-body'>We can't bake without any ingredients! :(</div></article>";
} else {
echo "<br><article class='message is-success'><div class='message-header'><p>Fresh out of the video oven!</p></div><div class='message-body '><div class='columns'>";
echo "<div class='column is-half'><a href='";
echo $videoandaudio;
echo "' class='button is-link'>Highest Quality<span class='tag' style='margin-left: 5px;'>mp4</span></a></div>";
echo "<div class='column is-quarter'><a href='";
echo $video;
echo "' class='button'>Video Only<span class='tag' style='margin-left: 5px;'>mp4</span></a></div>";
echo "<div class='column is-quarter'><a href='";
echo $audio;
echo "' class='button is-info'>Audio Only<span class='tag' style='margin-left: 5px;'>mp3</span></a></div>";
echo "</div></div>";
echo "<pre>";
echo $_POST['URL'];
echo "</pre>";
echo "</article>"; 
} ?>
          </section>
        </body>
      </html>
