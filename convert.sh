#!/bin/bash

# part of streamin.gg, open source
# alec armbruster, al-ec on github
# this is not for copyright infringement!

URL=$1
# navigate to temporary file folder
cd /var/www/streamingg/dl/ # change me
find -mmin +59 -type f -exec rm -fv {} \
# do mp3 conversion with youtube-dl
youtube-dl --extract-audio --audio-format mp3 --prefer-ffmpeg --output %\(id\)s.%\(ext\)s ${URL}
youtube-dl -f 'bestvideo[ext=mp4]+bestaudio[ext=m4a]/mp4' --output %\(id\)s.%\(ext\)s ${URL}
# return last string to php!
youtube-dl -x --get-id ${URL}
