#!bin/bash 
. config/config.dev.env
echo "ACCESSED assets/module.bash"

function install () {
  echo -e "${GREEN} ------- [ install() ] -------- ${NC} "
  echo -e "${RED}💥💥💥  Removing pre-installed themes 💥💥💥"
  echo -e "💥💥💥  Removing pre-installed plugins 💥💥💥"
  rm -rfv $ROOT_DIR/build/wordpress/wp-content/plugins/*
  echo -e "${NC}"

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