const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/pages/_homepage.scss', 'public/css/homepage.css')
    .sass('resources/sass/pages/_minors.scss', 'public/css/minors.css')
    .sass('resources/sass/pages/_map.scss', 'public/css/map.css');
