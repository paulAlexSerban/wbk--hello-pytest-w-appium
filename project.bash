#!bin/bash
. config/config.dev.env
echo -e "${BLUE}ACCESSED project.bash ${NC}"

function install () {
  for t in ${INSTALL_PROJECT_MODULES[@]}; do
    bash $t/module.bash install
  done
}

function uninstall () {
  for t in ${UNINSTALL_PROJECT_MODULES[@]}; do
    bash $t/module.bash uninstall
  done
}

function watch-dev () {
  for t in ${INSTALL_PROJECT_MODULES[@]}; do
    bash $t/module.bash watch-dev
  done
}

# function deploy () {
#   echo "this should be the script to prepare the project for deployment to production"
#   echo "done in an integration or release environment"
#   echo "copies the final package to the remote repository for sharing with other developers and projects"
# }

# function pre-site () {
#   echo "execute processes needed prior to the actual project site generation - clean dist and build/*/*/wordpress"
# }

# function site () {
#   echo "generate the project's site - fe-build compilation to dist"
# }

# function post-site () {
#   echo "execute processes needed to finalize the site generation, and to prepare for site deployment"
# }

# function site-deploy () {
#   echo "deploy the generated site files to the build/*/*/wordpress"
# }

# function clean () {
#   echo "echo execute processes needed to do the project cleaning"
# }

$1