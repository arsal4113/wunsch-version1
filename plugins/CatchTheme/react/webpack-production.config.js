'use strict';

const webpackConfig = require('./webpack.config.js');

// set node env to production
webpackConfig.mode = 'production';

module.exports = webpackConfig;
