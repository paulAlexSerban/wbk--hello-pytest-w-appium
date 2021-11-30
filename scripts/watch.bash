#!/bin/bash

function watch-includes () {
  
}

function watch-plugins () {
  # copy_must-use-plugins-src-to-build
  # copy_plugins-src-to-build
}

function uni-web-start-watchers () {
  # add watchers as you get developing
  # for example the first steps developin a new theme needs only the required files
  watch-required-files & watch-template-files & watch-components & watch-dist-assets
} 

function uni-web-stop-warchers () {
  ps ax | grep fswatch
  killall fswatch
}











