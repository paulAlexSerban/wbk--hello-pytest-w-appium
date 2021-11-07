/* eslint-disable no-shadow */
/* eslint-disable import/no-extraneous-dependencies */
const path = require('path');
const glob = require('glob');
const webpack = require('webpack'); // to access built-in plugins
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const fs = require('fs');
const loaders = require('./loaders');
const plugins = require('./plugins');

const copyUiKit = () => {
  const sourceFile = path.join(__dirname, '../node_modules/uikit/dist/js/uikit.min.js');
  const destinationDirectory = path.join(__dirname, '../dist/assets/scripts/');
  const destinationFile = path.join(__dirname, '../dist/assets/scripts/uikit.script.js');

  if (!fs.existsSync(destinationDirectory)) {
    fs.mkdirSync(destinationDirectory, { recursive: true });
  }

  fs.copyFile(sourceFile, destinationFile, (err) => {
    if (err) throw err;
  });
};

const getEntries = (path) => glob.sync(path).reduce((acc, item) => {
  const path = item.split('/');
  path.pop();
  const name = path.pop();
  acc[name] = item;
  copyUiKit();
  return acc;
}, {});

module.exports = {
  entry: { ...getEntries('./ux-ui/components/pages/*/*.js') },
  module: {
    rules: [
      loaders.JSLoader,
      loaders.CSSLoader,
    ],
  },
  output: {
    path: path.resolve(__dirname, '../dist/assets'),
    filename: 'scripts/[name].script.js',
  },
  plugins: [
    new webpack.ProgressPlugin(),
    plugins.ESLintPlugin,
    plugins.MiniCssExtractPlugin,
    plugins.StyleLintPlugin,
    new WebpackManifestPlugin({ publicPath: '' }),
  ],
};
