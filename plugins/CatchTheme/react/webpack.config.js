'use strict';

const path = require('path');
const webpack = require('webpack');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');

module.exports = {
    mode: 'development',
    entry: {
        checkout: path.join(__dirname, 'src/Checkout/container/Checkout/main.js'),
        success: path.join(__dirname, 'src/Success/main.js'),
        vip: path.join(__dirname, 'src/Vip/container/Vip/index.js')
    },
    output: {
        path: path.join(__dirname, '../webroot/js/build/'),
        filename: '[name].[chunkhash].bundle.js',
        publicPath: '/catch_theme/js/build/'
    },
    plugins: [
        new CleanWebpackPlugin(),
        new ManifestPlugin(),
        new webpack.DefinePlugin({
            LANGUAGE_STAMP: JSON.stringify(Date.now())
        }),
        new CopyPlugin([
            {
                from: '**/*',
                to: '../../translations/',
                context: 'src/translations/'
            }
        ]),
    ],
    optimization: {
        splitChunks: {
            cacheGroups: {
                vendor: {
                    test: /node_modules/,
                    chunks: 'initial',
                    name: 'vendor',
                    priority: 10,
                    enforce: true
                }
            }
        }
    },
    module: {
        rules: [
            /*{
                enforce: 'pre',
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                loader: 'eslint-loader',
                options: {
                    emitWarning: false
                }
            },*/
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                loader: 'babel-loader'
            },
            {
                test: /\.css$/,
                include: /node_modules/,
                loaders: ['style-loader', 'css-loader']
            },
            {
                test: /\.s[ac]ss$/i,
                exclude: /node_modules/,
                use: [
                    // Creates `style` nodes from JS strings
                    'style-loader',
                    // Translates CSS into CommonJS
                    {
                        loader: 'css-loader',
                        options: {
                            importLoaders: 2,
                            sourceMap: true
                        }
                    },
                    // Compiles Sass to CSS
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                ]

            },
            {
                test: /\.(png|svg|jpg|gif)$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 5000,
                            fallback: 'file-loader',
                            useRelativePath: true,
                            outputPath: '../../img/',
                            publicPath: '/catch_theme/img/'
                        }
                    }
                ]
            }
        ]
    },
    // needed to make request-promise work
    node: {
        fs: 'empty',
        net: 'empty',
        tls: 'empty'
    }
};
