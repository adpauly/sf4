// Commande à (re)exécuter après chaque changement : yarn encore dev --watch

var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())
    // .createSharedEntry('vendor', './assets/js/webpack.shared_entry.js', './assets/js/functions/welcome.js')
    .addEntry('app', './assets/js/app.js')
    .addEntry('login', './assets/js/login.js')
    .addEntry('index', './assets/js/index.js')
    .addEntry('works_list', './assets/js/works_list.js')
    .addEntry('works_edit', './assets/js/works_edit.js')
    // .addStyleEntry('css/app', './assets/css/app.scss') Déconseillé (il vaut mieux utiliser un .js qui inclut un .css)
    .enableSassLoader() // yarn add sass-loader + yarn add node-sass
    .autoProvidejQuery()
    // alternative
    .autoProvideVariables({
        // Possibilité d'importer la variable jQuery ou n'importe quelle autre lib/fonction manuellement
        // $: 'jquery',
        // jQuery: 'jquery',
        // 'window.jQuery': 'jquery',
    })
    .copyFiles({
        from: './img',
        to: 'assets/images/[path][name].[ext]'
    });
;

module.exports = Encore.getWebpackConfig();
