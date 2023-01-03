/* eslint-disable import/no-extraneous-dependencies */
/* eslint-disable no-underscore-dangle */
const path = require('path');
const _MiniCssExtractPlugin = require('mini-css-extract-plugin');
const _StyleLintPlugin = require('stylelint-webpack-plugin');
const _ESLintPlugin = require('eslint-webpack-plugin');

const MiniCssExtractPlugin = new _MiniCssExtractPlugin({
  filename: 'styles/[name].style.css',
  chunkFilename: '[id].css',
});

const ESLintPlugin = new _ESLintPlugin({
  overrideConfigFile: path.resolve(__dirname, '.eslintrc'),
  context: path.resolve(__dirname, '../ux-ui/'),
  files: '*/**/*.*.js',
});

const StyleLintPlugin = new _StyleLintPlugin({
  configFile: path.resolve(__dirname, 'stylelint.config.js'),
  context: path.resolve(__dirname, '../ux-ui/'),
  files: '*/**/*.*.scss',
});

module.exports = {
  MiniCssExtractPlugin,
  StyleLintPlugin,
  ESLintPlugin,
};
