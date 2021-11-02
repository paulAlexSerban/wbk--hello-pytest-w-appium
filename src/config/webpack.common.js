/* eslint-disable no-shadow */
/* eslint-disable import/no-extraneous-dependencies */
const path = require('path');
const glob = require('glob');
const webpack = require('webpack'); // to access built-in plugins
const loaders = require('./loaders');
const plugins = require('./plugins');

const getEntries = (path) => glob.sync(path).reduce((acc, item) => {
  const path = item.split('/');
  path.pop();
  const name = path.pop();
  acc[name] = item;
  return acc;
}, {});

console.log({ ...getEntries('./ux-ui/components/pages/*/*.js'), ...getEntries('./ux-ui/vendors/*/*.vendor.js') });

module.exports = {
  entry: { ...getEntries('./ux-ui/components/pages/*/*.js') },
  optimization: {
    splitChunks: {
      chunks: 'all',
    },
  },
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
  ],
};
