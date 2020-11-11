let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
if (process.env.npm_lifecycle_event !== 'hot') {
    mix.version()
}
const path = require('path');
// fix css files 404 issue
mix.webpackConfig({
    devServer: {
        contentBase: path.resolve(__dirname, 'public'),

    }
});

const BundleAnalyzerPlugin=require('webpack-bundle-analyzer').BundleAnalyzerPlugin
const webpack=require('webpack')

mix
    .disableNotifications()
    .js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')

