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
  rsync -rv --mkpath $ROOT_DIR/src/plugins/mu-plugins/* $ROOT_DIR/build/wordpress/wp-content/mu-plugins/ --info=progress2
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

function backup-uploads () {
  echo -e "${BLUE} --> [ --- START --- BACKUP ASSETS ] uploads/assets ${GREEN}"
  rsync -rv --mkpath $WORDPRESS_WP_CONTENT/uploads $ASSETS_DIR --info=progress2
  echo -e "${BLUE} --> [ --- DONE --- BACKUP ASSETS ] uploads/assets ${NC}"
}

function generate_database () {
	echo -e "${BLUE} --> [ -- START -- GENERATE NEW DATABASE MAIN_BACKUP ] ${GREEN} "
  docker exec ${COMPOSE_PROJECT_NAME}_mysql /usr/bin/mysqldump -u root --password=${DATABASE_PASSWORD} ${COMPOSE_PROJECT_NAME} > $MAIN_BACKUP_FILE
	echo -e "${BLUE} --> [ -- DONE -- GENERATE NEW DATABASE MAIN_BACKUP ] ${GREEN} "
}

MAIN_BACKUP_FILE=$DATABASE_DIR/main/main.backup.sql
function save-fail-safe-bkp () {
		echo -e "${BLUE} --> [ -- START -- save-fail-safe-bkp ] ${GREEN} "
    echo " - creaticg Database fail-safe-backup "
  	if [ -f $MAIN_BACKUP_FILE ]; then 
		rsync -rv --mkpath $ROOT_DIR/../assets/database/main/main.backup.sql $ROOT_DIR/../assets/database/backup/saved.elvirtuoso.backup.`date +%Y-%m-%d---%T`.sql --info=progress2; 
		echo -e "${BLUE} --> [ -- SAVED -- save-fail-safe-bkp ] ${GREEN} "
	else 
		echo -e "${BLUE} --> [ -- NO DATABASE TO SAVE -- save-fail-safe-bkp ] ${GREEN} "
	fi \
}




function install () {
  pre-install
  install-src-to-build
  echo -e "${BLUE} --> [ SRC INSTALL DONE ] ${GREEN} "
}

function uninstall () {
  echo -e "${BLUE} --> [ -- START -- DATABASE UNINSTALL ] ${GREEN} "
	save-fail-safe-bkp
	generate_database
	echo -e "${BLUE} --> [ -- DONE -- DATABASE UNINSTALL ] ${GREEN} "

  echo -e "${BLUE} --> [ --- START --- UNINSTALL ASSETS] uploads/assets ${GREEN}"
  backup-uploads
  echo -e "${BLUE} --> [ --- DONE --- UNINSTALL ASSETS] uploads/assets ${GREEN}"

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

function watch-mu-plugin () {
  fswatch -xrv -l 2 $ROOT_DIR/src/plugins/mu-plugins/*.php | while read num event 
  do 
    rsync -rv --mkpath $ROOT_DIR/src/plugins/mu-plugins/*.php $ROOT_DIR/build/wordpress/wp-content/mu-plugins/ --info=progress2
  done
}


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
  watch-required-files & watch-dist-assets & watch-components & watch-mu-plugin
}

function test () {
  ls -la $ROOT_DIR/../assets
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

