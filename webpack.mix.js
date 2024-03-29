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

mix.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/pages/_homepage.scss', 'public/css/homepage.css')
    .sass('resources/sass/pages/_minors.scss', 'public/css/minors.css')
    .sass('resources/sass/pages/_map.scss', 'public/css/map.css')
    .sass('resources/sass/pages/_organisations.scss', 'public/css/organisations.css')
    .sass('resources/sass/pages/_articles.scss', 'public/css/articles.css');

