const Encore = require('@symfony/webpack-encore');
const path = require('path');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
     .enableSassLoader()
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/sass/tailwind.scss')
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enablePostCssLoader((options) => {
        options.postcssOptions = {
            // the directory where the postcss.config.js file is stored
            config: path.resolve(__dirname, '.', 'postcss.config.js'),
        };
    })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    });

module.exports = Encore.getWebpackConfig();

