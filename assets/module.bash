#!/bin/bash
. config/config.dev.env
echo -e " ${GREEN} ACCESSED assets/module.bash ${NC}"

# INSTALL Scripts
# ASSETS_DIR=$ROOT_DIR/assets
# WORDPRESS_WP_CONTENT=$WORDPRESS_DIR/wp-content
function copy-backed-up-assets-src-to-build () {
  echo -e "${BLUE} --> [ --- START --- COPY ] uploads ${GREEN} "
  rsync -rv --mkpath $ASSETS_DIR/uploads $WORDPRESS_WP_CONTENT --info=progress2
  echo -e "${BLUE} --> [ --- DONE --- COPY ] uploads ${NC} "
}

function install () {
  echo -e "${BLUE} --> [ --- START --- INSTALL ASSETS ] uploads/assets ${GREEN}"
  copy-backed-up-assets-src-to-build
  echo -e "${BLUE} --> [ --- DONE --- ASSETS INSTALL ] ${NC} "
}

# UNINSTALL Scripts

function backup-uploads () {
  echo -e "${BLUE} --> [ --- START --- BACKUP ASSETS ] uploads/assets ${GREEN}"
  rsync -rv --mkpath $WORDPRESS_WP_CONTENT/uploads $ASSETS_DIR --info=progress2
  echo -e "${BLUE} --> [ --- DONE --- BACKUP ASSETS ] uploads/assets ${NC}"
}

function uninstall () {
  echo -e "${BLUE} --> [ --- START --- UNINSTALL ASSETS] uploads/assets ${GREEN}"
  backup-uploads
  echo -e "${BLUE} --> [ --- DONE --- UNINSTALL ASSETS] uploads/assets ${GREEN}"
}

$1