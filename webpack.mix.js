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

mix.scripts([
    'resources/js/backend_js/jquery.min.js',
    'resources/js/backend_js/popper.min.js',
    'resources/js/backend_js/bootstrap.min.js',
    'resources/js/backend_js/Chart.min.js',
    'resources/js/backend_js/pace.min.js',
    'resources/js/backend_js/template.js'
   
    
],'public/js/mora.js')

.styles([
    'resources/css/backend_css/font-awesome.min.css',
    'resources/css/backend_css/simple-line-icons.min.css',
    'resources/css/backend_css/style.css',
    'resources/bootstrap/dist/css/bootstrap.css',
    'resources/bootstrap-vue/dist/bootstrap-vue.css',
    'node_modules/vuetify/dist/vuetify.min.css" '
],'public/css/mora.css')
.js(['resources/js/app.js'],'public/js/app.js');