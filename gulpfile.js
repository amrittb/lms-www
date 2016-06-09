var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

var paths = {
    bootstrap: "./node_modules/bootstrap-sass/assets/stylesheets"
};

elixir(function(mix) {
    mixCss(mix);
    mixScripts(mix);
    mix.version(['css/app.css','js/app.js']);
});

function mixCss(mix) {
    mix.sass('app.scss',null, {
        includePaths: [].concat(paths.bootstrap)
    });
}

function mixScripts(mix) {
    mix.browserify('app.js');
}
