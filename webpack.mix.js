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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version()    // version()，每次静态文件发生更改就生成新的文件名称，防止浏览器缓存
    .copyDirectory('resources/editor/js', 'public/js')    // 将编辑器的js文件复制到public
    .copyDirectory('resources/editor/css', 'public/css');    // 将编辑器的css文件复制到public