const fs = require("fs");
const path = require("path");

const copyUiKit = () => {
  const sourceFile = path.join(
    __dirname,
    "../node_modules/uikit/dist/js/uikit.min.js"
  );
  const destinationDirectory = path.join(__dirname, "../dist/assets/scripts/");
  const destinationFile = path.join(
    __dirname,
    "../dist/assets/scripts/uikit.script.js"
  );

  if (!fs.existsSync(destinationDirectory)) {
    fs.mkdirSync(destinationDirectory, { recursive: true });
  }

  fs.copyFile(sourceFile, destinationFile, (err) => {
    if (err) throw err;
  });
};

module.exports = {
  copyUiKit,
};
