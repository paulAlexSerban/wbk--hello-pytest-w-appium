#!bin/bash 
. config/config.dev.env
echo "ACCESSED docker/module.bash"

function start () {
  echo -e "${BLUE} --> [ -- START -- DOCKER start() ] ${GREEN} "
  echo " - build the images before starting docker containers"
  echo " - aggregates the output of each docker container in detach mode"
  echo " - starting the docker containers in the background and leaving them running ${NC}"
  docker-compose --env-file $ROOT_DIR/config/config.dev.env -f $ROOT_DIR/docker/docker-compose.yml up -d --build
  echo -e "${BLUE} --> [ -- DONE -- DOCKER start() ] ${GREEN} "
}

function pre-install () {
  echo -e "${BLUE} --> [ -- START -- DOCKER pre-install() ] ${GREEN} "
  start
  echo -e "${BLUE} --> [ -- DONE -- DOCKER pre-install() ] ${GREEN} "
}

function configure-wp () {
  echo -e "${BLUE} --> [ -- START -- DOCKER configure-wp() ] ${GREEN} "
  echo " - start and run in a new container the wordpress auto configuration docker container"
  echo " - the container gets removed after configuratoin is done ${NC}"
  docker-compose --env-file $ROOT_DIR/config/config.dev.env -f $ROOT_DIR/docker/docker-compose.yml -f $ROOT_DIR/docker/wp-auto-config.yml run --rm wp-auto-config
  echo -e "${BLUE} --> [ -- DONE -- DOCKER configure-wp() ] ${GREEN} "
}

function install () {
  echo -e "${BLUE} --> [ -- START -- DOCKER install() ] ${GREEN} "
  pre-install
  configure-wp
  echo -e "${BLUE} --> [ -- DONE -- DOCKER install() ] ${GREEN} "
}






function stop ()  {
  echo -e "${BLUE} --> [ -- START -- DOCKER stop() ] ${GREEN} "
  echo " - stop containers and removes containers, networks, volumes, and images"
  docker-compose --env-file $ROOT_DIR/config/config.dev.env -f $ROOT_DIR/docker/docker-compose.yml down -v 
  echo -e "${BLUE} --> [ -- DONE -- DOCKER stop() ] ${GREEN} "
}

function remove-docker-volumes () {
  echo -e "${BLUE} --> [ -- START -- DOCKER remove-docker-volumes() ] ${GREEN} "
  echo " - remove all unused docker volumes"
  docker volume prune -f
  echo -e "${BLUE} --> [ -- DONE -- DOCKER remove-docker-volumes() ] ${GREEN} "
}

function remove-docker-images () {
  echo -e "${BLUE} --> [ -- START -- DOCKER remove-docker-volumes() ] ${GREEN} "
  echo "- remove all images"
  docker image prune -af
  echo -e "${BLUE} --> [ -- DONE -- DOCKER remove-docker-volumes() ] ${GREEN} "
}

function uninstall () {
  echo -e "${BLUE} --> [ -- START -- DOCKER uninstall() ] ${GREEN} "
  stop
  echo -e "${BLUE} --> [ -- START -- DOCKER uninstall() ] ${GREEN} "
}

function clean () {
  remove-docker-volumes
  remove-docker-images
}

$1