var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	mix.copy('node_modules/datatables/media', 'public/js/datatables');
	mix.copy('node_modules/datatables/node_modules/jquery/dist', 'public/js');
    mix.sass('app.scss');
});
