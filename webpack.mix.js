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
mix.styles(
	'../vendor/techlab/smartwizard/dist/css/smart_wizard.css',
	asset('css/smart_wizard/smart_wizard.css'));
mix.js('../vendor/techlab/smartwizard/dist/js', asset('js'));