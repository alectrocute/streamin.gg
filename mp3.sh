#!/bin/bash

# part of streamin.gg, open source
# alec armbruster, al-ec on github
# this is not for copyright infringement!

URL=$1
# delete old files
find /var/www/streamingg/dl/*.mp3 -type f -mmin +20 -exec rm {} \; # change me
# navigate to temporary file folder
cd /var/www/streamingg/dl/ # change me
# do mp3 conversion with youtube-dl
youtube-dl -x --audio-format mp3 --output %\(id\)s.mp3 ${URL}
# return last string to php!
youtube-dl -x --get-id ${URL}
