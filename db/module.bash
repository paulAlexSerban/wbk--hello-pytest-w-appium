#!bin/bash 
. config/config.dev.env
echo "ACCESSED assets/module.bash"

MAIN_BACKUP_FILE=$DATABASE_DIR/main/main.backup.sql
# INSTALL Scripts
# copy database to install to build
function copy-db-bkp-to-build () {
	echo -e "${BLUE} --> [ COPY DATABASE file to BUILD ] ${GREEN} "
  	rsync -rv $MAIN_BACKUP_FILE $MYSQL_DIR/ --info=progress2
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

function pre-install () {
	echo -e "${BLUE} --> [ -- START -- DATABASE PRE-INSTALL ] ${GREEN} "
	restore-database-from-backup
	echo -e "${BLUE} --> [ -- DONE --DATABASE PRE-INSTALL ] ${GREEN} "
}

# install database
# restore-db-from-backup
function install () {
	echo -e "${BLUE} --> [ -- START -- DATABASE INSTALL ] ${GREEN} "
	pre-install
	echo -e "${BLUE} --> [ -- DONE -- DATABASE INSTALL ] ${GREEN} "
}

# UNINSTALL Scripts
# generate database backup directly to db/main
function generate_database () {
	echo -e "${BLUE} --> [ -- START -- GENERATE NEW DATABASE MAIN_BACKUP ] ${GREEN} "
  docker exec ${COMPOSE_PROJECT_NAME}_mysql /usr/bin/mysqldump -u root --password=${DATABASE_PASSWORD} ${COMPOSE_PROJECT_NAME} > $MAIN_BACKUP_FILE
	echo -e "${BLUE} --> [ -- DONE -- GENERATE NEW DATABASE MAIN_BACKUP ] ${GREEN} "
}

# save database backup
function save-fail-safe-bkp () {
		echo -e "${BLUE} --> [ -- START -- save-fail-safe-bkp ] ${GREEN} "
    echo " - creaticg Database fail-safe-backup "
  	if [ -f $MAIN_BACKUP_FILE ]; then 
		rsync -rv $MAIN_BACKUP_FILE $DATABASE_DIR/backup/saved.backup.`date +%Y-%m-%d---%T`.sql --info=progress2; 
		echo -e "${BLUE} --> [ -- SAVED -- save-fail-safe-bkp ] ${GREEN} "
	else 
		echo -e "${BLUE} --> [ -- NO DATABASE TO SAVE -- save-fail-safe-bkp ] ${GREEN} "
	fi \
}

function uninstall () {
	echo -e "${BLUE} --> [ -- START -- DATABASE UNINSTALL ] ${GREEN} "
	save-fail-safe-bkp
	generate_database
	echo -e "${BLUE} --> [ -- DONE -- DATABASE UNINSTALL ] ${GREEN} "
}

$1