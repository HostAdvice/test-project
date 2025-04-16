const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    mode: process.env.NODE_ENV || 'development',
    entry: {
        main: [
            path.resolve(__dirname, 'wp-content/themes/vpn-providers/assets/js/main.js'),
            path.resolve(__dirname, 'wp-content/themes/vpn-providers/assets/scss/main.scss')
        ]
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'wp-content/themes/vpn-providers/dist'),
        publicPath: '/wp-content/themes/vpn-providers/dist/'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: true,
                            sassOptions: {
                                silenceDeprecations: ['legacy-js-api'],
                            }
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css'
        })
    ],
    devServer: {
        hot: true,
        proxy: {
            '/': 'http://localhost:8080'
        }
    }
};