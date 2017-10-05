const {mix} = require('laravel-mix');
const CleanWebpackPlugin = require('clean-webpack-plugin');

// paths to clean
var pathsToClean = [
    'public/assets/app/js',
    'public/assets/app/css',
    'public/assets/admin/js',
    'public/assets/admin/css',
    'public/assets/auth/css',
];

// the clean options to use
var cleanOptions = {};

mix.webpackConfig({
    plugins: [
        new CleanWebpackPlugin(pathsToClean, cleanOptions)
    ]
});

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

/*
 |--------------------------------------------------------------------------
 | Core
 |--------------------------------------------------------------------------
 |
 */

mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/pace-progress/pace.js',
], 'public/assets/app/js/app.js').version();

mix.styles([
    'node_modules/font-awesome/css/font-awesome.css',
    'node_modules/pace-progress/themes/blue/pace-theme-minimal.css',
], 'public/assets/app/css/app.css').version();

mix.copy([
    'node_modules/font-awesome/fonts/',
], 'public/assets/app/fonts');

/*
 |--------------------------------------------------------------------------
 | Auth
 |--------------------------------------------------------------------------
 |
 */

mix.styles('resources/assets/auth/css/login.css', 'public/assets/auth/css/login.css').version();
mix.styles('resources/assets/auth/css/register.css', 'public/assets/auth/css/register.css').version();
mix.styles('resources/assets/auth/css/passwords.css', 'public/assets/auth/css/passwords.css').version();

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/gentelella/vendors/animate.css/animate.css',
    'node_modules/gentelella/build/css/custom.css',
], 'public/assets/auth/css/auth.css').version();

/*
 |--------------------------------------------------------------------------
 | Admin
 |--------------------------------------------------------------------------
 |
 */

mix.scripts([
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
    'node_modules/gentelella/build/js/custom.js',
    'node_modules/gentelella/vendors/parsleyjs/dist/parsley.min.js',
    'node_modules/gentelella/vendors/parsleyjs/dist/i18n/pt-br.js',
    'node_modules/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js',
    'node_modules/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js',
    'node_modules/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
    'node_modules/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js',
    'node_modules/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
    'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js',
    'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js',
    'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js',
    'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.colVis.min.js',
    'node_modules/gentelella/vendors/pdfmake/build/pdfmake.min.js',
    'node_modules/gentelella/vendors/pdfmake/build/vfs_fonts.js',
    'node_modules/gentelella/vendors/jszip/dist/jszip.min.js',
    'node_modules/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js',
    'node_modules/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js',
    'resources/assets/admin/js/buttons.server-side.js',
    'node_modules/select2/dist/js/select2.full.min.js',
    'node_modules/select2/dist/js/i18n/pt-BR.js',
    'node_modules/jquery-confirm/dist/jquery-confirm.min.js',
    'node_modules/jquery-price-format/jquery.priceformat.min.js',
    'resources/assets/admin/js/custom.js'
], 'public/assets/admin/js/admin.js').version();

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/gentelella/vendors/animate.css/animate.css',
    'node_modules/gentelella/build/css/custom.css',
    'node_modules/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
    'node_modules/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
    'node_modules/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
    'node_modules/select2/dist/css/select2.css',
    'node_modules/jquery-confirm/dist/jquery-confirm.min.css',
    'resources/assets/admin/css/custom.css',
], 'public/assets/admin/css/admin.css').version();


mix.copy([
    'node_modules/gentelella/vendors/bootstrap/dist/fonts',
], 'public/assets/admin/fonts');


mix.scripts([
    'node_modules/select2/dist/js/select2.full.js',
    'resources/assets/admin/js/users/edit.js',
], 'public/assets/admin/js/users/edit.js').version();

mix.styles([
    'node_modules/select2/dist/css/select2.css',
], 'public/assets/admin/css/users/edit.css').version();

mix.scripts([
    'node_modules/gentelella/vendors/Flot/jquery.flot.js',
    'node_modules/gentelella/vendors/Flot/jquery.flot.time.js',
    'node_modules/gentelella/vendors/Flot/jquery.flot.pie.js',
    'node_modules/gentelella/vendors/Flot/jquery.flot.stack.js',
    'node_modules/gentelella/vendors/Flot/jquery.flot.resize.js',

    'node_modules/gentelella/production/js/flot/jquery.flot.orderBars.js',
    'node_modules/gentelella/production/js/flot/date.js',
    'node_modules/gentelella/production/js/flot/curvedLines.js',
    'node_modules/gentelella/production/js/flot/jquery.flot.spline.js',

    'node_modules/gentelella/production/js/moment/moment.min.js',
    'node_modules/gentelella/production/js/datepicker/daterangepicker.js',


    'node_modules/gentelella/vendors/Chart.js/dist/Chart.js',

    'resources/assets/admin/js/dashboard.js',
], 'public/assets/admin/js/dashboard.js').version();

mix.styles([
    'resources/assets/admin/css/dashboard.css',
], 'public/assets/admin/css/dashboard.css').version();


/*
 |--------------------------------------------------------------------------
 | Frontend
 |--------------------------------------------------------------------------
 |
 */