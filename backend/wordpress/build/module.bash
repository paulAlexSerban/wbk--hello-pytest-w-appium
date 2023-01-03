#!bin/bash 
. config/config.dev.env
echo "ACCESSED assets/module.bash"

# INSTALL Scripts
# ASSETS_DIR=$ROOT_DIR/assets
# WORDPRESS_WP_CONTENT=$WORDPRESS_DIR/wp-content
function copy-backed-up-assets-src-to-build () {
  echo -e "${BLUE} --> [ --- START --- COPY ] uploads ${GREEN} "
  rsync -rv --mkpath $ASSETS_DIR/uploads $WORDPRESS_WP_CONTENT --info=progress2
  echo -e "${BLUE} --> [ --- DONE --- COPY ] uploads ${NC} "
}

function install-fonts () {
  echo -e "${BLUE} --> [ --- START --- COPY ] fonts ${GREEN} "
  rsync -rv --mkpath $ASSETS_DIR/fonts $WORDPRESS_THEME_TARGET --info=progress2
  echo -e "${BLUE} --> [ --- DONE --- COPY ] fonts ${NC} "
}

MAIN_BACKUP_FILE=$DATABASE_DIR/main/main.backup.sql
# INSTALL Scripts
# copy database to install to build
function copy-db-bkp-to-build () {
	echo -e "${BLUE} --> [ COPY DATABASE file to BUILD ] ${GREEN} "
  	rsync -rv --mkpath $MAIN_BACKUP_FILE $MYSQL_DIR/ --info=progress2
}

function restore-database-from-backup () {
	echo -e "${BLUE} --> [ RESTORE DATABASE from BACKUP ] ${GREEN} "
  if [ -f $MAIN_BACKUP_FILE ]; then
		copy-db-bkp-to-build
		docker exec -it ${COMPOSE_PROJECT_NAME}_mysql bash -c "mysql -u root --password=${MYSQL_ROOT_PASSWORD} ${COMPOSE_PROJECT_NAME} < /var/lib/mysql/main.backup.sql"; 
		echo -e "${BLUE} RESTORED database"; 
	else \
		echo -e "${BLUE} NO database to restore"; \
	fi \
}


function install () {
  echo -e "${GREEN} ------- [ install() ] -------- ${NC} "
  echo -e "${RED}💥💥💥  Removing pre-installed themes 💥💥💥"
  echo -e "💥💥💥  Removing pre-installed plugins 💥💥💥"
  rm -rfv $ROOT_DIR/build/wordpress/wp-content/plugins/*
  echo -e "${NC}"
  
  echo -e "${BLUE} --> [ --- START --- INSTALL ASSETS ] uploads/assets ${GREEN}"
  copy-backed-up-assets-src-to-build
  install-fonts
  echo -e "${BLUE} --> [ --- DONE --- ASSETS INSTALL ] ${NC} "

	echo -e "${BLUE} --> [ -- START -- DATABASE INSTALL ] ${GREEN} "
	restore-database-from-backup
	echo -e "${BLUE} --> [ -- DONE -- DATABASE INSTALL ] ${GREEN} "
}

function uninstall () {
  echo -e "${RED}<----> [ START ] <----> 💥💥💥  Removing build files from ./build 💥💥💥"
	echo " Cleaning ./build/mysql directory of temporary files "
  echo " Cleaning ./build/wordpress directory of temporary files "
  rm -Rfv $ROOT_DIR/build/mysql/*
  rm -Rfv $ROOT_DIR/build/wordpress/*
  echo "<----> [ DONE ] <----> 💥💥💥  Removing build files from ./build 💥💥💥"
}

$1