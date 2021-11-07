#!bin/bash 
. config/config.dev.env

function clean_dist_directory () {
  echo -e "${RED} --> [ CLEAN ] ./dist directory"
  rm -rf $DISTRIBUTION_ASSETS_TO_WATCH/*
  echo -e "${GREEN} --> [ DONE ] ./dist cleaned and ready to install new Front-end assets"
}
# REQUIRED_FILES = src/required
function copy_required-src-to-build () {
  echo -e "${BLUE} --> [ COPY ] required files ${GREEN} "
  rsync -rv --mkpath $REQUIRED_FILES/* $WORDPRESS_THEME_TARGET/ --info=progress2
}

# TEMPLATE_FILES = src/pages  <--- should remove
# NOT needed after restructuring the project folder and file structure
# function copy_templates-src-to-build () {
#   echo -e "${BLUE} --> [ COPY ] template files ${GREEN} "
#   rsync -rv --mkpath $TEMPLATE_FILES/*/*.php $WORDPRESS_THEME_TARGET --info=progress2
# }

# COMPONENT_FILES = src/ux-ui/components
function copy-components-src-to-build () {
  echo -e "${BLUE} --> [ COPY ] component files ${GREEN} "
  rsync -rv --mkpath $COMPONENT_FILES/*/*/*.php $WORDPRESS_THEME_TARGET --info=progress2
}

# DISTRIBUTION_ASSETS_TO_WATCH = src/dist
function copy_fe_assets-src-to-build () {
  echo -e "${BLUE} --> [ COPY ] assets/distribution files ${GREEN} "
  rsync -rv --mkpath $DISTRIBUTION_ASSETS_TO_WATCH/*/* $WORDPRESS_THEME_TARGET/assets --info=progress2
}

function copy_must-use-plugins-src-to-build () {
  echo -e "${BLUE} --> [ COPY ] must-use plugin files ${GREEN} "
  rsync -rv --mkpath $ROOT_DIR/src/plugins/mu-plugins $ROOT_DIR/build/wordpress/wp-content/themes/$PROJECT_NAME --info=progress2
}

function copy_plugins-src-to-build () {
  echo -e "${BLUE} --> [ COPY ] vendor plugin files ${GREEN} "
  rsync -rv --mkpath $ROOT_DIR/src/plugins/vendor-plugins/* $ROOT_DIR/build/wordpress/wp-content/plugins/ --info=progress2
}

function copy_includes-src-to-build () {
  echo -e "${BLUE} --> [ COPY ] includes files ${GREEN} "
  rsync -rv --mkpath $ROOT_DIR/src/includes $ROOT_DIR/build/wordpress/wp-content/themes/$PROJECT_NAME --info=progress2
}

function pre-install () {
  echo -e "${BLUE} --> [ PRE-INSTALL ] ${GREEN} "
  npm install --prefix $SRC_DIR
  cd $ROOT_DIR/src && npm run build
}

function install-src-to-build () {
  echo -e "${BLUE} --> [ INSTALL SRC in BUILD ] ${GREEN} "
  copy_required-src-to-build
  # copy_templates-src-to-build
  copy-components-src-to-build
  copy_fe_assets-src-to-build
  copy_must-use-plugins-src-to-build
  copy_plugins-src-to-build
  copy_includes-src-to-build
}

function install () {
  pre-install
  install-src-to-build
  echo -e "${BLUE} --> [ SRC INSTALL DONE ] ${GREEN} "
}

function uninstall () {
  echo " - backup updated plugins from ./build to ./src"
  rsync -rv --mkpath $WORDPRESS_PLUGINS/* $SRC_VENDOR_PLUGINS --info=progress2
}

# watchers configuration

# DISTRIBUTION_ASSETS_TO_WATCH=$ROOT_DIR/src/dist/assets
# THEME_BUILD_TARGET => WORDPRESS_THEME_TARGET 
# TEMPLATE_FILES=$ROOT_DIR/src/pages
# COMPONENT_FILES=$ROOT_DIR/src/ux-ui/components

# REQUIRED_FILES = src/required
# WORDPRESS_THEME_TARGET=$WORDPRESS_WP_CONTENT/themes/$PROJECT_NAME
function watch-required-files () {
  fswatch -xnr -l 2 $REQUIRED_FILES/* | while read num event
  do 
    rsync -rv --mkpath $num $WORDPRESS_THEME_TARGET/ --info=progress2
  done
}

function watch-dist-assets () {
  fswatch -xnr -o 2 $DISTRIBUTION_ASSETS_TO_WATCH/assets/* | while read num event
  do 
    copy_fe_assets-src-to-build
  done
}

# NOT needed after restructuring the project folder and file structure
# function watch-template-files () {
#   fswatch -xnr  -l 2 $TEMPLATE_FILES/*/*.php | while read num event
#   do 
#     rsync -rv --mkpath $TEMPLATE_FILES/*/*.php $WORDPRESS_THEME_TARGET --info=progress2
#   done
# }

# COMPONENT_FILES=$ROOT_DIR/src/ux-ui/components
function watch-components () {
  fswatch -xrv -l 2 $COMPONENT_FILES/*/*/*.php | while read num event 
  do 
    rsync -rv --mkpath $COMPONENT_FILES/*/*/*.php $WORDPRESS_THEME_TARGET --info=progress2
  done
}

function run_fe_watchers () {
  tab "cd ${SRC_DIR} && npm run watch"
}

function watch-dev () {
  watch-required-files & watch-dist-assets & watch-components
}

$1































# not needed because rsync --mkpath solves the problem

# function copy-source-to-build-files () {
#   	if [ -d $ROOT_DIR/build/wordpress/wp-content/themes/$PROJECT_NAME ]; then 
#     echo " <----> [ START ] <----> COPY $PROJECT_NAME theme required files"
#     echo " " 
# 		copy_src_files
#     echo " "
#     echo " <----> [ DONE ] <----> COPY $PROJECT_NAME theme required files"
# 	else 
# 		echo " <----> [CREATED new theme directory <---->]"
# 		mkdir -p $ROOT_DIR/build/wordpress/wp-content/themes/$PROJECT_NAME
# 		copy_src_files
# 	fi \
# }