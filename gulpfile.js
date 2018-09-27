var elixir = require('laravel-elixir');


elixir(function(mix) {
    mix.sass('app.scss')

     .scripts([
        'libs/jquery.js',
        'libs/bootstrap.js',
        'libs/bootstrap.min.js',
        'libs/metisMenu.js',
        'libs/sb-admin-2.js',
        'libs/scripts.js'
        ],'public/js/libs.js')


    .styles([
    	'libs/blog-post.css',
    	'libs/bootstrap.css',
    	'libs/bootstrap.min.css',
    	'libs/font-awesome.css',
    	'libs/metisMenu.css',
    	'libs/sb-admin-2.css',
    	'libs/styles.css'


    ], 'public/css/libs.css')






});
