let mix = require('laravel-mix');

//! Sincronización de navegadores para desarrollo
mix.browserSync('localhost');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'resources/assets/css/orders/header.css',
    'resources/assets/css/orders/main.css'
], 'public/css/orders.css')
.js('resources/assets/js/tienda.js', 'public/js');

mix.styles('resources/assets/css/admin-menu.css', 'public/css/admin-menu.css')
.scripts('resources/assets/js/libreries/template.js', 'public/js/admin-menu.js');

mix.styles('resources/assets/css/error.css', 'public/css/error.css')
   .js('resources/assets/js/error.js', 'public/js/error.js');