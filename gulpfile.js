var gulp = require("gulp");
var bower = require("gulp-bower");
var elixir = require("laravel-elixir");

gulp.task('bower', function () {
    return bower();
});
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 */
var vendors = '../../assets/vendors/';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'animate': vendors + 'animate.css',
    'acc-wizard': vendors + 'acc-wizard/release',
    'animationChart' : vendors + 'animatechart',
    'autogrow': vendors + 'autogrow/',
    'backbone' : vendors + 'backbone/',
    'canvas' : vendors + 'blueimp-canvas-to-blob/',
    'fileUpload' : vendors + 'blueimp-file-upload/',
    'imgLoad' : vendors + 'blueimp-load-image/',
    'bootstrap': vendors + 'bootstrap/dist',
    'bootstrapFormBuilder': vendors + 'bootstrap-form-builder/assets',
    'formBuilder': vendors + 'form-builder/assets/',
    'wysihtml5' : vendors + 'bootstrap3-wysihtml5-bower/dist',
    'daterangepicker' : vendors + 'bootstrap-daterangepicker/',
    'magnify' : vendors + 'bootstrap-magnify/',
    'markdown' : vendors + 'bootstrap-markdown/',
    'maxlength' : vendors + 'bootstrap-maxlength/',
    'multiselect' : vendors + 'bootstrap-multiselect/',
    'progressbar': vendors +'bootstrap-progressbar/',
    'rating' : vendors + 'bootstrap-rating/',
    'switch' : vendors + 'bootstrap-switch/dist',
    'tagsinput' : vendors + 'bootstrap-tagsinput/dist',
    'timepicker' : vendors + 'bootstrap-timepicker/',
    'touchspin': vendors +'bootstrap-touchspin/dist',
    'jvectormap' : vendors + 'bower-jvectormap/',
    'buttons' : vendors + 'Buttons/',
    'card' : vendors + 'card/lib',
    'chart': vendors +'Chart.js/',
    'ckeditor': vendors +'ckeditor/',
    'clockface': vendors +'clockface.js/',
    'colorpicker': vendors +'colorpicker/',
    'fontawesome': vendors + 'font-awesome',
    'flotchart': vendors + 'flotchart/',
    'countUp': vendors +'countUp.js/dist',
    'dataTables': vendors + 'datatables/media',
    'datepicker':vendors+'datepicker',
    'devicon': vendors +'devicon/',
    'dropzone': vendors + 'dropzone/dist',
    'fortjs': vendors +'fort.js/',
    'fancybox': vendors +'fancybox/source',
    'fastclick': vendors +'fastclick/lib',
    'gmaps': vendors +'gmaps/',
    'gridmanager' : vendors + 'gridmanager.js/dist',
    'handlebars' : vendors + 'handlebars/',
    'holderjs' : vendors + 'holderjs/',
    'html5sortable' : vendors + 'html5sortable/',
    'iCheck': vendors +'iCheck/',
    'intltelinput': vendors +'intl-tel-input/build',
    'rangeslider' : vendors + 'ion.rangeslider/',
    'ionicons' : vendors + 'ionicons/',
    'Jcrop' : vendors + 'Jcrop/',
    'jquery' : vendors + 'jquery/',
    'inputmask': vendors +'jquery.inputmask/dist/inputmask',
    'knob': vendors +'jquery-knob/dist',
    'select2': vendors + 'select2/dist',
    'eonasdanBootstrapDatetimepicker': vendors + 'eonasdan-bootstrap-datetimepicker/build',
    'fullcalendar': vendors + 'fullcalendar/dist',
    'summernote': vendors + 'summernote/dist',
    'icheck': vendors + 'iCheck',
    'jasnyBootstrap': vendors + 'jasny-bootstrap/dist',
    'toastr': vendors + 'toastr/',
    'bootstrapValidator' : vendors + 'bootstrapvalidator/dist',
    'select2BootstrapTheme': vendors + 'select2-bootstrap-theme/dist',
    'c3': vendors + '/c3/',
    'spinner': vendors +'jquery-spinner/dist',
    'jqueryui' : vendors + 'jquery-ui/',
    'Loader' : vendors + 'Loader/',
    'mixitup' : vendors + 'mixitup/build',
    'colorpicker1': vendors +'mjolnic-bootstrap-colorpicker/dist',
    'modal': vendors +'modal/',
    'moment' : vendors + 'moment/',
    'timezone' : vendors + 'moment-timezone/',
    'nestable' : vendors + 'nestable/',
    'noty' : vendors + 'noty/',
    'owl.carousel': vendors +'owl.carousel/dist',
    'pace': vendors +'PACE/',
    'rangy': vendors +'rangy-1.3/',
    'seiyriaBootstrapSlider': vendors +'seiyria-bootstrap-slider/dist',
    'trumbowyg': vendors +'trumbowyg/dist',
    'simplelineicons': vendors +'simple-line-icons/',
    'Sortable': vendors +'Sortable/',
    'transitionize': vendors +'transitionize/dist',
    'switchery': vendors +'switchery/dist',
    'twitterBootstrapWizard': vendors +'twitter-bootstrap-wizard/',
    'underscore' : vendors + 'underscore/',
    'wysihtml5x' : vendors + 'wysihtml5x/dist',
    'x-editable' : vendors + 'x-editable/dist',
    'nestable-list' : vendors + 'nestable-list/',
    'secureimage' : vendors + 'secureimage/',
    'sparkline' : vendors + 'sparkline/src',
    'tinymce': vendors + 'tinymce/'
};

elixir.config.sourcemaps = false;

elixir(function (mix) {

    // Run bower install
    mix.task('bower');



    // Copy fonts straight to public
    mix.copy('resources/assets/vendors/bootstrap/fonts', 'public/assets/fonts');
    mix.copy('resources/assets/vendors/font-awesome/fonts', 'public/assets/fonts');
    mix.copy('resources/assets/vendors/ionicons/fonts', 'public/assets/fonts');
    mix.copy('resources/assets/css/fonts.css', 'public/assets/css');

    // Copy images straight to public
    mix.copy('resources/assets/vendors/jquery-ui/themes/base/images', 'public/assets/img');
    mix.copy('resources/assets/vendors/datatables/media/images', 'public/assets/img');
    mix.copy('resources/assets/img', 'public/assets/img');
    mix.copy('resources/assets/images', 'public/assets/images');

    // daterange picker
    mix.copy('resources/assets/vendors/bootstrap-daterangepicker/daterangepicker.js', 'public/assets/vendors/daterangepicker/js');
    mix.copy('resources/assets/vendors/bootstrap-daterangepicker/daterangepicker.css', 'public/assets/vendors/daterangepicker/css');

    // tinymce
    mix.copy('resources/assets/vendors/tinymce-dist/tinymce.min.js', 'public/assets/vendors/tinymce');
    mix.copy('resources/assets/vendors/tinymce-dist/plugins', 'public/assets/vendors/tinymce/plugins');
    mix.copy('resources/assets/vendors/tinymce-dist/themes', 'public/assets/vendors/tinymce/themes');
    mix.copy('resources/assets/vendors/tinymce-dist/skins', 'public/assets/vendors/tinymce/skins');


    // metis menu
    mix.copy('resources/assets/js/metisMenu.js', 'public/assets/js');

    //bootstrap-form-builder
    mix.copy('resources/assets/vendors/bootstrap-form-builder/assets/css/custom.css', 'public/assets/vendors/bootstrap-form-builder/css');
    mix.copy('resources/assets/vendors/bootstrap-form-builder/assets/js/main-built.js', 'public/assets/vendors/bootstrap-form-builder/js');
    mix.copy('resources/assets/vendors/bootstrap-form-builder/assets/js/lib/require.js', 'public/assets/vendors/bootstrap-form-builder/js');
    mix.copy('resources/assets/vendors/bootstrap-form-builder/assets/js/templates/app/render.html', 'public/assets/vendors/bootstrap-form-builder/js/templates/app');
    mix.copy('resources/assets/vendors/bootstrap-form-builder/assets/js/templates/app/renderform.html', 'public/assets/vendors/bootstrap-form-builder/js/templates/app');
    mix.copy('resources/assets/vendors/bootstrap-form-builder/assets/js/templates/app/tab-nav.html', 'public/assets/vendors/bootstrap-form-builder/js/templates/app');
    mix.copy('resources/assets/vendors/bootstrap-form-builder/assets/js/templates/app/temp.html', 'public/assets/vendors/bootstrap-form-builder/js/templates/app');
    mix.copy('resources/assets/css/pages/formbuilder.css', 'public/assets/css/pages');

    // form builder
    mix.copy('resources/assets/vendors/form-builder/js/lib/beautify-html.js', 'public/assets/vendors/form-builder/js');
    mix.copy('resources/assets/vendors/form-builder/js/lib/beautify-css.js', 'public/assets/vendors/form-builder/js');
    mix.copy('resources/assets/vendors/form-builder/js/lib/beautify.js', 'public/assets/vendors/form-builder/js');

    // backbone
    mix.copy('resources/assets/vendors/backbone/backbone-min.js', 'public/assets/vendors/backbone/js');

    // dropzone
    mix.copy('resources/assets/vendors/dropzone/dist/dropzone.css', 'public/assets/vendors/dropzone/css');
    mix.copy('resources/assets/vendors/dropzone/dist/dropzone.js', 'public/assets/vendors/dropzone/js');

    // jquery file upload
    mix.copy('resources/assets/vendors/blueimp-file-upload/css/jquery.fileupload.css', 'public/assets/vendors/blueimp-file-upload/css');
    mix.copy('resources/assets/vendors/blueimp-file-upload/css/jquery.fileupload-ui.css', 'public/assets/vendors/blueimp-file-upload/css');
    mix.copy('resources/assets/vendors/blueimp-file-upload/css/jquery.fileupload-noscript.css', 'public/assets/vendors/blueimp-file-upload/css');
    mix.copy('resources/assets/vendors/blueimp-file-upload/css/jquery.fileupload-ui-noscript.css', 'public/assets/vendors/blueimp-file-upload/css');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/vendor/jquery.ui.widget.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/jquery.iframe-transport.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/jquery.fileupload.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/jquery.fileupload-process.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/jquery.fileupload-image.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/jquery.fileupload-audio.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/jquery.fileupload-video.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/jquery.fileupload-validate.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/js/jquery.fileupload-ui.js', 'public/assets/vendors/blueimp-file-upload/js');
    mix.copy('resources/assets/vendors/blueimp-file-upload/img/loading.gif', 'public/assets/vendors/blueimp-file-upload/img');
    mix.copy('resources/assets/vendors/blueimp-file-upload/img/loading.gif', 'public/assets/img');

    // blueimp-tmpl
    mix.copy('resources/assets/vendors/blueimp-tmpl/js/tmpl.min.js', 'public/assets/vendors/blueimp-tmpl/js');

    // blueimp-load-image
    mix.copy('resources/assets/vendors/blueimp-load-image/js/load-image.all.min.js', 'public/assets/vendors/blueimp-load-image/js');
    mix.copy('resources/assets/vendors/blueimp-load-image/js/load-image.js', 'public/assets/vendors/blueimp-load-image/js');

    // blueimp-canvas-to-blob
    mix.copy('resources/assets/vendors/blueimp-canvas-to-blob/js/canvas-to-blob.min.js', 'public/assets/vendors/blueimp-canvas-to-blob/js');

    // blueimp-gallery-with-desc
    mix.copy('resources/assets/vendors/blueimp-gallery-with-desc/css/blueimp-gallery.min.css', 'public/assets/vendors/blueimp-gallery-with-desc/css');
    mix.copy('resources/assets/vendors/blueimp-gallery-with-desc/js/jquery.blueimp-gallery.min.js', 'public/assets/vendors/blueimp-gallery-with-desc/js');


    // file upload page
   // mix.copy('resources/assets/css/pages/blueimp-gallery.min.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/main.js', 'public/assets/js/pages');


    //fancybox
    mix.copy('resources/assets/vendors/fancybox/source', 'public/assets/vendors/fancybox');
    mix.copy('resources/assets/vendors/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', 'public/assets/vendors/fancybox');

    //grid manager
    mix.copy('resources/assets/vendors/gridmanager.js/dist/css/jquery.gridmanager.css', 'public/assets/vendors/gridmanager/css');
    mix.copy('resources/assets/vendors/gridmanager.js/demo/css/demo.css', 'public/assets/vendors/gridmanager/css');
    mix.copy('resources/assets/vendors/gridmanager.js/dist/js/jquery.gridmanager.js', 'public/assets/vendors/gridmanager/js');

    //jasny-bootstrap
    mix.copy('resources/assets/vendors/jasny-bootstrap/dist/css/jasny-bootstrap.css', 'public/assets/vendors/jasny-bootstrap/css');
    mix.copy('resources/assets/vendors/jasny-bootstrap/dist/js/jasny-bootstrap.js', 'public/assets/vendors/jasny-bootstrap/js');

    // bootstrap3-wysihtml5-bower
    mix.copy('resources/assets/vendors/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css', 'public/assets/vendors/bootstrap3-wysihtml5-bower/css');
    mix.copy('resources/assets/vendors/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js', 'public/assets/vendors/bootstrap3-wysihtml5-bower/js');
    mix.copy('resources/assets/vendors/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.js', 'public/assets/vendors/bootstrap3-wysihtml5-bower/js');

    // summer note
    mix.copy('resources/assets/vendors/summernote/dist/summernote.css', 'public/assets/vendors/summernote');
    mix.copy('resources/assets/vendors/summernote/dist/summernote.min.js', 'public/assets/vendors/summernote');

    // ckeditor
    mix.copy('resources/assets/vendors/ckeditor/ckeditor.js', 'public/assets/vendors/ckeditor/js');
    mix.copy('resources/assets/vendors/ckeditor/adapters/jquery.js', 'public/assets/vendors/ckeditor/js');
    mix.copy('resources/assets/vendors/ckeditor/config.js', 'public/assets/vendors/ckeditor/js');
    mix.copy('resources/assets/vendors/ckeditor/skins/', 'public/assets/vendors/ckeditor/js/skins');
    mix.copy('resources/assets/vendors/ckeditor/lang', 'public/assets/vendors/ckeditor/js/lang');
    mix.copy('resources/assets/vendors/ckeditor/styles.js', 'public/assets/vendors/ckeditor/js');
    mix.copy('resources/assets/vendors/ckeditor/contents.css', 'public/assets/vendors/ckeditor/js');


    //autogrow
    mix.copy('resources/assets/vendors/autogrow/autogrow.min.js', 'public/assets/vendors/autogrow/autogrow.min.js');




    // trumbowyg
    mix.copy('resources/assets/vendors/trumbowyg/dist/ui/trumbowyg.min.css', 'public/assets/vendors/trumbowyg/css');
    mix.copy('resources/assets/vendors/trumbowyg/dist/trumbowyg.js', 'public/assets/vendors/trumbowyg/js');
    mix.copy('resources/assets/vendors/trumbowyg/dist/ui/images/icons-black.png', 'public/assets/vendors/trumbowyg/css/images');

    // intl-tel-input
    mix.copy('resources/assets/vendors/intl-tel-input/build/css/intlTelInput.css', 'public/assets/vendors/intl-tel-input/css');
    mix.copy('resources/assets/vendors/intl-tel-input/build/js/intlTelInput.min.js', 'public/assets/vendors/intl-tel-input/js');

    // bootstrapvalidator
    mix.copy('resources/assets/vendors/bootstrapvalidator/dist/css/bootstrapValidator.min.css', 'public/assets/vendors/bootstrapvalidator/css');
    mix.copy('resources/assets/vendors/bootstrapvalidator/dist/js/bootstrapValidator.min.js', 'public/assets/vendors/bootstrapvalidator/js');

    //select2
    mix.copy('resources/assets/vendors/select2/dist/css/select2.min.css', 'public/assets/vendors/select2/css');
    mix.copy('resources/assets/vendors/select2/dist/js/select2.js', 'public/assets/vendors/select2/js');
    mix.copy('resources/assets/vendors/select2-bootstrap-theme/dist/select2-bootstrap.css', 'public/assets/vendors/select2/css');

    //icheck
    mix.copy('resources/assets/vendors/iCheck/icheck.js','public/assets/vendors/iCheck/js');
    mix.copy('resources/assets/vendors/iCheck/skins/*','public/assets/vendors/iCheck/css');


    // countUp js
    mix.copy('resources/assets/vendors/countUp.js/dist/countUp.js', 'public/assets/vendors/countUp.js/js');

    // bower-jquery-easyPieChart
    mix.copy('resources/assets/vendors/bower-jquery-easyPieChart/dist/jquery.easypiechart.min.js', 'public/assets/vendors/bower-jquery-easyPieChart/js');
    mix.copy('resources/assets/vendors/bower-jquery-easyPieChart/dist/easypiechart.min.js', 'public/assets/vendors/bower-jquery-easyPieChart/js');
    mix.copy('resources/assets/js/pages/jquery.easingpie.js', 'public/assets/vendors/bower-jquery-easyPieChart/js');

    // moment
    mix.copy('resources/assets/vendors/moment/min/moment.min.js', 'public/assets/vendors/moment/js');

    // underscore
    mix.copy('resources/assets/vendors/underscore/underscore-min.js','public/assets/vendors/underscore/js');

    // datepicker
    mix.copy('resources/assets/js/pages/datepicker.js', 'public/assets/js/pages');

    // bootstrap-datetimepicker
    mix.copy('resources/assets/vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'public/assets/vendors/datetimepicker/css');
    mix.copy('resources/assets/vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/assets/vendors/datetimepicker/js');
    mix.copy('resources/assets/vendors/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js', 'public/assets/vendors/datetimepicker/js');

    // clockface
    mix.copy('resources/assets/vendors/clockface.js/css/clockface.css', 'public/assets/vendors/clockface/css');
    mix.copy('resources/assets/vendors/clockface.js/js/clockface.js', 'public/assets/vendors/clockface/js');

    // Buttons
    mix.copy('resources/assets/vendors/Buttons/css/buttons.css', 'public/assets/vendors/Buttons/css');
    mix.copy('resources/assets/vendors/Buttons/showcase/js/scrollto.js', 'public/assets/vendors/Buttons/js');
    mix.copy('resources/assets/vendors/Buttons/js/buttons.js', 'public/assets/vendors/Buttons/js');

    // bootstrap color picker
    mix.copy('resources/assets/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css', 'public/assets/vendors/colorpicker/css');
    mix.copy('resources/assets/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js', 'public/assets/vendors/colorpicker/js');
    mix.copy('resources/assets/vendors/mjolnic-bootstrap-colorpicker/dist/img/bootstrap-colorpicker', 'public/assets/vendors/colorpicker/img/bootstrap-colorpicker');


    // owl-carousel
    mix.copy('resources/assets/vendors/owl.carousel/owl-carousel/owl.carousel.css', 'public/assets/vendors/owl.carousel/css');
    mix.copy('resources/assets/vendors/owl.carousel/owl-carousel/owl.theme.css', 'public/assets/vendors/owl.carousel/css');
    mix.copy('resources/assets/vendors/owl.carousel/owl-carousel/owl.transitions.css', 'public/assets/vendors/owl.carousel/css');
    mix.copy('resources/assets/vendors/owl.carousel/owl-carousel/owl.carousel.min.js', 'public/assets/vendors/owl.carousel/js');

    // advanced modals
    mix.copy('resources/assets/vendors/modal/css/component.css', 'public/assets/vendors/modal/css');
    mix.copy('resources/assets/vendors/modal/js/classie.js', 'public/assets/vendors/modal/js');
    mix.copy('resources/assets/vendors/modal/js/modalEffects.js', 'public/assets/vendors/modal/js');

    // bootstrap tagsinput
    mix.copy('resources/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css', 'public/assets/vendors/bootstrap-tagsinput/css');
    mix.copy('resources/assets/vendors/bootstrap-tagsinput/examples/assets/app.css', 'public/assets/vendors/bootstrap-tagsinput/css');
    mix.copy('resources/assets/vendors/bootstrap-tagsinput/examples/assets/app_bs3.js', 'public/assets/vendors/bootstrap-tagsinput/js');
    mix.copy('resources/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.js', 'public/assets/vendors/bootstrap-tagsinput/js');

    // sortable list
    mix.copy('resources/assets/css/pages/sortable_list.css', 'public/assets/css/pages');
    mix.copy('resources/assets/vendors/Sortable/Sortable.js', 'public/assets/vendors/Sortable/js');
    mix.copy('resources/assets/js/pages/sortable_list.js', 'public/assets/js/pages');

    // toastr
    mix.copy('resources/assets/vendors/toastr/toastr.css', 'public/assets/vendors/toastr/css');
    mix.copy('resources/assets/vendors/toastr/toastr.min.js', 'public/assets/vendors/toastr/js');
    mix.copy('resources/assets/js/pages/ui-toastr.js', 'public/assets/vendors/toastr/js/pages');

    // noty
    mix.copy('resources/assets/vendors/noty/js/noty/packaged/jquery.noty.packaged.min.js', 'public/assets/vendors/noty/js');

    // bootstrap progressbar
    mix.copy('resources/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.css', 'public/assets/vendors/bootstrap-progressbar/css');
    mix.copy('resources/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.js', 'public/assets/vendors/bootstrap-progressbar/js');

    // bootstrap touchspin
    mix.copy('resources/assets/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css', 'public/assets/vendors/bootstrap-touchspin/css');
    mix.copy('resources/assets/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js', 'public/assets/vendors/bootstrap-touchspin/js');

    // bootstrap multiselect
    mix.copy('resources/assets/vendors/bootstrap-multiselect/dist/css/bootstrap-multiselect.css', 'public/assets/vendors/bootstrap-multiselect/css');
    mix.copy('resources/assets/vendors/bootstrap-multiselect/dist/js/bootstrap-multiselect.js', 'public/assets/vendors/bootstrap-multiselect/js');

    // bootstrap switch
    mix.copy('resources/assets/vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css', 'public/assets/vendors/bootstrap-switch/css');
    mix.copy('resources/assets/vendors/bootstrap-switch/dist/js/bootstrap-switch.js', 'public/assets/vendors/bootstrap-switch/js');

    // font-awesome
    mix.copy('resources/assets/vendors/font-awesome/css/font-awesome.min.css', 'public/assets/css');

    // jquery-spinner
    mix.copy('resources/assets/vendors/jquery.spinner/dist/css/bootstrap-spinner.css', 'public/assets/vendors/jquery-spinner/css');
    mix.copy('resources/assets/vendors/jquery.spinner/dist/js/jquery.spinner.min.js', 'public/assets/vendors/jquery-spinner/js');

    // bootstrap-timepicker
    mix.copy('resources/assets/vendors/bootstrap-timepicker/css/timepicker.less', 'public/assets/vendors/bootstrap-timepicker/css');
    mix.copy('resources/assets/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js', 'public/assets/vendors/bootstrap-timepicker/js');

    // animate
    mix.copy('resources/assets/vendors/animate.css/animate.min.css', 'public/assets/vendors/animate');


    // ion.rangeslider
    mix.copy('resources/assets/vendors/ion.rangeslider/css/ion.rangeSlider.skinFlat.css', 'public/assets/vendors/ion.rangeslider/css');
    mix.copy('resources/assets/vendors/ion.rangeslider/css/ion.rangeSlider.css', 'public/assets/vendors/ion.rangeslider/css');
    mix.copy('resources/assets/vendors/ion.rangeslider/js/ion.rangeSlider.js', 'public/assets/vendors/ion.rangeslider/js');
    mix.copy('resources/assets/vendors/ion.rangeslider/img/sprite-skin-flat.png', 'public/assets/vendors/ion.rangeslider/img');

    // seiyria-bootstrap-slider
    mix.copy('resources/assets/vendors/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css', 'public/assets/vendors/bootstrap-slider/css');
    mix.copy('resources/assets/vendors/seiyria-bootstrap-slider/dist/bootstrap-slider.js', 'public/assets/vendors/bootstrap-slider/js');

    // knob
    mix.copy('resources/assets/vendors/jquery-knob/js/jquery.knob.js', 'public/assets/vendors/jquery-knob/js');

    // datatables
    mix.copy('resources/assets/vendors/datatables.net/js/jquery.dataTables.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.css', 'public/assets/vendors/datatables/css');
    mix.copy('resources/assets/vendors/datatables.net-buttons/js/buttons.print.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-buttons/js/dataTables.buttons.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.css', 'public/assets/vendors/datatables/css');
    mix.copy('resources/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-colreorder/js/dataTables.colReorder.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-colreorder-bs/css/colReorder.bootstrap.css', 'public/assets/vendors/datatables/css');
    mix.copy('resources/assets/vendors/datatables.net-responsive/js/dataTables.responsive.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-rowreorder/js/dataTables.rowReorder.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-buttons/js/buttons.html5.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-buttons/js/buttons.colVis.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-buttons/js/buttons.print.min.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-rowreorder-bs/css/rowReorder.bootstrap.css', 'public/assets/vendors/datatables/css');
    mix.copy('resources/assets/vendors/datatables.net-scroller/js/dataTables.scroller.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.css', 'public/assets/vendors/datatables/css');
    mix.copy('resources/assets/vendors/pdfmake/build/pdfmake.js', 'public/assets/vendors/datatables/js');
    mix.copy('resources/assets/vendors/pdfmake/build/vfs_fonts.js', 'public/assets/vendors/datatables/js');

    //datatables page
    mix.copy('resources/assets/js/pages/table-advanced.js', 'public/assets/js/pages');
    mix.copy('resources/assets/css/pages/tables.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/table-advanced2.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/table-editable.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/data.txt', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/table-responsive.js', 'public/assets/js/pages');

    // flot charts
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.js','public/assets/vendors/flotchart/js');
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.stack.js','public/assets/vendors/flotchart/js');
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.crosshair.js','public/assets/vendors/flotchart/js');
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.time.js','public/assets/vendors/flotchart/js');
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.selection.js','public/assets/vendors/flotchart/js');
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.symbol.js' ,'public/assets/vendors/flotchart/js');
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.resize.js','public/assets/vendors/flotchart/js');
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.categories.js','public/assets/vendors/flotchart/js');
    mix.copy('resources/assets/vendors/flotchart/jquery.flot.pie.js','public/assets/vendors/flotchart/js');


    //animationchart page
    mix.copy('resources/assets/vendors/animatechart/jquery.flot.animator.js', 'public/assets/vendors/animatechart');
    // Chart.js
    mix.copy('resources/assets/vendors/Chart.js/Chart.js','public/assets/vendors/Chart.js/js');

    // fullcalendar
    mix.copy('resources/assets/vendors/fullcalendar/dist/fullcalendar.css','public/assets/vendors/fullcalendar/css');
    mix.copy('resources/assets/vendors/fullcalendar/dist/fullcalendar.print.css','public/assets/vendors/fullcalendar/css');
    mix.copy('resources/assets/vendors/fullcalendar/dist/fullcalendar.min.js','public/assets/vendors/fullcalendar/js');

    // bootstrap-datepicker
    mix.copy('resources/assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.js','public/assets/vendors/bootstrap-datepicker/js');
    mix.copy('resources/assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.css','public/assets/vendors/bootstrap-datepicker/css');

    // gmaps
    mix.copy('resources/assets/vendors/gmaps/examples/examples.css','public/assets/vendors/gmaps/css');
    mix.copy('resources/assets/vendors/gmaps/gmaps.min.js','public/assets/vendors/gmaps/js');
    mix.copy('resources/assets/js/pages/maps_api.js','public/assets/js/pages');
    mix.copy('resources/assets/js/pages/custommaps.js','public/assets/js/pages');
    mix.copy('resources/assets/js/pages/adv_maps.js','public/assets/js/pages');

    //  bower-jvectormap
    mix.copy('resources/assets/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css', 'public/assets/vendors/bower-jvectormap/css');
    mix.copy('resources/assets/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.min.js', 'public/assets/vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js');
    mix.copy('resources/assets/vendors/bower-jvectormap/jquery-jvectormap-world-mill-en.js', 'public/assets/vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js');

    //jvector map
    mix.copy('resources/assets/css/pages/jqvmap.css', 'public/assets/css/pages');
    mix.copy('resources/assets/vendors/jqvmap/dist/jquery.vmap.js', 'public/assets/vendors/jqvmap/js');
    mix.copy('resources/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js', 'public/assets/vendors/jqvmap/js');
    mix.copy('resources/assets/vendors/jqvmap/dist/maps/jquery.vmap.usa.js', 'public/assets/vendors/jqvmap/js');
    mix.copy('resources/assets/vendors/jqvmap/dist/maps/jquery.vmap.europe.js', 'public/assets/vendors/jqvmap/js');
    mix.copy('resources/assets/vendors/jqvmap/dist/maps/jquery.vmap.germany.js', 'public/assets/vendors/jqvmap/js');
    mix.copy('resources/assets/vendors/jqvmap/dist/maps/jquery.vmap.russia.js', 'public/assets/vendors/jqvmap/js');
    mix.copy('resources/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js', 'public/assets/vendors/jqvmap/js');

    //fort.js
    mix.copy('resources/assets/vendors/fort.js/fort.css', 'public/assets/vendors/fort.js/css');
    mix.copy('resources/assets/vendors/fort.js/fort.js', 'public/assets/vendors/fort.js/js');

    // Jcrop
    mix.copy('resources/assets/vendors/Jcrop/css/jquery.Jcrop.css', 'public/assets/vendors/Jcrop/css');
    mix.copy('resources/assets/vendors/Jcrop/css/Jcrop.gif', 'public/assets/vendors/Jcrop/css');
    mix.copy('resources/assets/css/pages/cropcustom.css', 'public/assets/css/pages');
    mix.copy('resources/assets/vendors/Jcrop/js/jquery.Jcrop.min.js', 'public/assets/vendors/Jcrop/js');
    mix.copy('resources/assets/vendors/Jcrop/js/jquery.color.js', 'public/assets/vendors/Jcrop/js');
    mix.copy('resources/assets/js/pages/cropcustom.js', 'public/assets/js/pages');


    //jquery input-mask
    mix.copy('resources/assets/vendors/jquery.inputmask/dist/', 'public/assets/vendors/jquery.inputmask/');

    // bootstrap-maxlength
    mix.copy('resources/assets/vendors/bootstrap-maxlength/src/bootstrap-maxlength.js', 'public/assets/vendors/bootstrap-maxlength/js');

    // invoice page
    mix.copy('resources/assets/css/pages/invoice.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/invoice.js', 'public/assets/js/pages');

    // 404 page
    mix.copy('resources/assets/css/pages/404.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/404.js', 'public/assets/js');

    // 500 page
    mix.copy('resources/assets/css/pages/500.css', 'public/assets/css/pages');


    // login 2 page
    mix.copy('resources/assets/js/TweenLite.min.js', 'public/assets/js');
    mix.copy('resources/assets/js/pages/login.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/login2.js', 'public/assets/js/pages');
    mix.copy('resources/assets/css/pages/login2.css', 'public/assets/css/pages');

    // news page
    mix.copy('resources/assets/css/pages/news.css', 'public/assets/css/pages');

    // news item page
    mix.copy('resources/assets/css/pages/blog.css', 'public/assets/css/pages');

    // tasks page
    mix.copy('resources/assets/css/pages/todolist.css', 'public/assets/css/pages');
    mix.copy('resources/assets/css/only_dashboard.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/tasklist.js', 'public/assets/js/pages');

    // indexpage
    mix.copy('resources/assets/js/dashboard.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/todolist.js', 'public/assets/js/pages');

    //compose page
    mix.copy('resources/assets/js/pages/add_newblog.js', 'public/assets/js/pages');

    // inbox page
    mix.copy('resources/assets/css/pages/alertmessage.css', 'public/assets/css/pages');
    mix.copy('resources/assets/css/pages/mail_box.css', 'public/assets/css/pages');

    // gallery page
    mix.copy('resources/assets/css/pages/animated-masonry-gallery.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/gallery.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/jquery.isotope.min.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/animated-masonry-gallery.js', 'public/assets/js/pages');

    //imgmagnify
    mix.copy('resources/assets/vendors/bootstrap-magnify/css/bootstrap-magnify.css', 'public/assets/vendors/bootstrap-magnify');
    mix.copy('resources/assets/vendors/bootstrap-magnify/js/bootstrap-magnify.js', 'public/assets/vendors/bootstrap-magnify');

    // calendar page
    mix.copy('resources/assets/css/pages/calendar_custom.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/calendar.js', 'public/assets/js/pages');

    // flot chart page
    mix.copy('resources/assets/vendors/flot.tooltip/js/jquery.flot.tooltip.js', 'public/assets/vendors/flot.tooltip/js');
    mix.copy('resources/assets/css/pages/flot.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/customcharts.js', 'public/assets/js/pages');

    // pie chart page
    mix.copy('resources/assets/css/pages/piecharts.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/custompiecharts.js', 'public/assets/js/pages');

    //animation charts page
    mix.copy('resources/assets/css/pages/charts.css', 'public/assets/css/pages');
    mix.copy('resources/assets/css/jquery.circliful.css', 'public/assets/vendors/animationcharts');
    mix.copy('resources/assets/js/jquery.circliful.min.js', 'public/assets/vendors/animationcharts');
    mix.copy('resources/assets/js/pages/animation-chart.js', 'public/assets/js/pages');

    // js charts page
    mix.copy('resources/assets/css/pages/jscharts.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/chartjs.js', 'public/assets/js/pages');

    // sparkline charts page
    mix.copy('resources/assets/css/pages/sparklinecharts.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/sparkline.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/jquery.sparkline.js', 'public/assets/vendors/sparklinecharts');
    mix.copy('resources/assets/js/jquery.flot.spline.js', 'public/assets/vendors/splinecharts');

    // editable datatables pages
    mix.copy('resources/assets/css/pages/tables.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/table-editable.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/table-responsive.js', 'public/assets/js/pages');


    // circle sliders (knob) page
    mix.copy('resources/assets/js/pages/knob_page.js', 'public/assets/js/pages');

    // slider page
    mix.copy('resources/assets/css/pages/ion.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/sliders.js', 'public/assets/js/pages');

    // transition page
    mix.copy('resources/assets/css/pages/transitions.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/transitions.js', 'public/assets/js/pages');

    // pickers page
    mix.copy('resources/assets/js/pages/pickers.js', 'public/assets/js/pages');

    // portlet draggable page
    mix.copy('resources/assets/css/pages/portlet.css', 'public/assets/css/pages');

    // general components page
    mix.copy('resources/assets/css/pages/alertmessage.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/general.js', 'public/assets/js/pages');

    // session timeout page
    mix.copy('resources/assets/css/pages/session_timeout.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/jquery.sessionTimeout.min.js', 'public/assets/js/pages');

    // notifications page
    mix.copy('resources/assets/css/pages/fluid.css', 'public/assets/css/pages');
    mix.copy('resources/assets/css/pages/toastr.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/noty_script.js', 'public/assets/js/pages');

    // timeline
    mix.copy('resources/assets/css/pages/timeline.css', 'public/assets/css/pages');
    mix.copy('resources/assets/css/pages/timeline2.css', 'public/assets/css/pages');

    //toastr page
    mix.copy('resources/assets/css/pages/toastr.css', 'public/assets/css/pages');

    // userprofile page
    mix.copy('resources/assets/css/pages/user_profile.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/user_profile.js', 'public/assets/js/pages');

    //adduser page
    mix.copy('resources/assets/js/pages/adduser.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/edituser.js', 'public/assets/js/pages');

    // tagsinput page
    mix.copy('resources/assets/js/pages/tagsinput.js', 'public/assets/js/pages');

    // carousel page
    mix.copy('resources/assets/css/pages/carousel.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/carousel.js', 'public/assets/js/pages');

    // color-picker page
    mix.copy('resources/assets/js/pages/color-picker.js', 'public/assets/js/pages');

    // x-editable
    mix.copy('resources/assets/vendors/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css', 'public/assets/vendors/x-editable/css');
    mix.copy('resources/assets/vendors/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js', 'public/assets/vendors/x-editable/js');
    mix.copy('resources/assets/vendors/x-editable/dist/bootstrap3-editable/img', 'public/assets/vendors/x-editable/img');

    mix.copy('resources/assets/vendors/x-editable/dist/inputs-ext/typeaheadjs/lib/typeahead.js', 'public/assets/vendors/x-editable/js');
    mix.copy('resources/assets/vendors/x-editable/dist/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css', 'public/assets/vendors/x-editable/css');
    mix.copy('resources/assets/vendors/x-editable/dist/inputs-ext/typeaheadjs/typeaheadjs.js', 'public/assets/vendors/x-editable/js');
    mix.copy('resources/assets/vendors/x-editable/dist/inputs-ext/address/address.js', 'public/assets/vendors/x-editable/js');

    // x-editable page
    mix.copy('resources/assets/css/x-select.css', 'public/assets/vendors/x-editable/css');
    mix.copy('resources/assets/css/x-selectbootstrap.css', 'public/assets/vendors/x-editable/css');
    mix.copy('resources/assets/css/pages/inlinedit.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/demo.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/demo-mock.js', 'public/assets/js/pages');

    // jquery-mockjax
    mix.copy('resources/assets/vendors/jquery-mockjax/dist/jquery.mockjax.js', 'public/assets/vendors/jquery-mockjax/js');

    // tabs_accordions page
    mix.copy('resources/assets/css/pages/tab.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/tabs_accordions.js', 'public/assets/js/pages');

    // adv buttons page
    mix.copy('resources/assets/css/pages/advbuttons.css', 'public/assets/css/pages');

    // buttons page
    mix.copy('resources/assets/css/pages/buttons.css', 'public/assets/css/pages');

    //animated icons and font icons page
    mix.copy('resources/assets/css/pages/icon.css', 'public/assets/css/pages');

    // login page
    mix.copy('resources/assets/vendors/bootstrap/dist/css/bootstrap.min.css', 'public/assets/css');
    mix.copy('resources/assets/css/pages/login.css', 'public/assets/css/pages');

    // form layouts
    mix.copy('resources/assets/css/pages/form_layouts.css', 'public/assets/css/pages');

    // form elements page
    mix.copy('resources/assets/css/pages/formelements.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/formelements.js', 'public/assets/js/pages');
    mix.copy('resources/assets/vendors/card/lib/js/', 'public/assets/vendors/card/lib/js');
    mix.copy('resources/assets/vendors/card/src', 'public/assets/vendors/card');

    // form validation page
    mix.copy('resources/assets/css/pages/form2.css', 'public/assets/css/pages');
    mix.copy('resources/assets/css/pages/form3.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/validation.js', 'public/assets/js/pages');
    mix.copy('resources/assets/vendors/secureimage', 'public/assets/vendors/secureimage');
    mix.copy('resources/assets/vendors/intl-tel-input', 'public/assets/vendors/intl-tel-input/');

    // form editor page
    mix.copy('resources/assets/css/pages/editor.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/editor.js', 'public/assets/js/pages');

    // form editor2 page
    mix.copy('resources/assets/js/pages/editor2.js', 'public/assets/js/pages');

    // form builder2 page
    mix.copy('resources/assets/css/pages/formbuilder1.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/form_builder2.js', 'public/assets/js/pages');

    //button builder page
    mix.copy('resources/assets/css/pages/buttonbuilder2.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/buttonbuilder.js', 'public/assets/js/pages');
    mix.copy('resources/assets/js/pages/scripts.min.js', 'public/assets/js/pages');

    // page builder
    mix.copy('resources/assets/css/pages/grid_manager.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/grid_manager.js', 'public/assets/js/pages');

    //nestable list page
    mix.copy('resources/assets/css/pages/sortable.css', 'public/assets/css/pages');
    mix.copy('resources/assets/vendors/html5sortable/jquery.sortable.min.js', 'public/assets/vendors/html5sortable/jquery.sortable.min.js');
    mix.copy('resources/assets/vendors/nestable-list/jquery.nestable.js', 'public/assets/vendors/nestable-list/jquery.nestable.js');
    mix.copy('resources/assets/js/pages/ui-nestable.js', 'public/assets/js/pages');

    //form wizard page
    mix.copy('resources/assets/css/pages/wizard.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/form_wizard.js', 'public/assets/js/pages');
    mix.copy('resources/assets/vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard.js', 'public/assets/vendors/bootstrapwizard');
    mix.copy('resources/assets/js/pages/form_wizard.js', 'public/assets/js/pages');

    //accordianform wizard page
    mix.copy('resources/assets/css/pages/accordionformwizard.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/pages/accordionformwizard.js', 'public/assets/js/pages');
    mix.copy('resources/assets/vendors/acc-wizard/release/acc-wizard.min.css', 'public/assets/vendors/acc-wizard');
    mix.copy('resources/assets/vendors/acc-wizard/release/acc-wizard.min.js', 'public/assets/vendors/acc-wizard');

    // lockscreen builder
    mix.copy('resources/assets/css/pages/lockscreen.css', 'public/assets/css/pages');
    mix.copy('resources/assets/js/lockscreen.js', 'public/assets/js/pages');

   //  default layout page
    mix.copy('resources/assets/js/jquery-1.11.1.min.js', 'public/assets/js');
    mix.copy('resources/assets/js/bootstrap.min.js', 'public/assets/js');
    mix.copy('resources/assets/js/livicons-1.4.min.js', 'public/assets/js');
    mix.copy('resources/assets/js/josh.js', 'public/assets/js');
    mix.copy('resources/assets/vendors/jquery-ui/jquery-ui.min.js', 'public/assets/js');
    mix.copy('resources/assets/vendors/raphael/raphael-min.js', 'public/assets/js');
    mix.copy('resources/assets/vendors/holderjs/holder.js', 'public/assets/js');
    mix.copy('resources/assets/vendors/holderjs/holder.min.js', 'public/assets/js');

    // frontend pages

    // default layout
    mix.copy('resources/assets/css/frontend/custom.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/josh_frontend.js', 'public/assets/js/frontend');

    // index page
    mix.copy('resources/assets/css/frontend/tabbular.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/css/frontend/jquery.circliful.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/carousel.js', 'public/assets/js/frontend');
    mix.copy('resources/assets/js/frontend/index.js', 'public/assets/js/frontend');
    mix.copy('resources/assets/js/frontend/jquery.circliful.js', 'public/assets/js/frontend');

    // typography
    mix.copy('resources/assets/css/frontend/features.css', 'public/assets/css/frontend');

    // advanced features
    mix.copy('resources/assets/css/frontend/panel.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/advfeatures.js', 'public/assets/js/frontend');
    mix.copy('resources/assets/css/frontend/timeline.css', 'public/assets/css/frontend');

    // switchery
    mix.copy('resources/assets/vendors/switchery/dist/switchery.css', 'public/assets/vendors/switchery/css');
    mix.copy('resources/assets/vendors/switchery/dist/switchery.js', 'public/assets/vendors/switchery/js');

    // devicon
    mix.copy('resources/assets/vendors/devicon/devicon.min.css', 'public/assets/vendors/devicon');
    mix.copy('resources/assets/vendors/devicon/fonts', 'public/assets/vendors/devicon/fonts');
    mix.copy('resources/assets/vendors/devicon/devicon-colors.css', 'public/assets/vendors/devicon');

    //pages section
    // about us
    mix.copy('resources/assets/css/frontend/aboutus.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/aboutus.js', 'public/assets/js/frontend');

    //timeline
    mix.copy('resources/assets/css/frontend/timeline1.css', 'public/assets/css/frontend');

    //price
    mix.copy('resources/assets/css/frontend/price.css', 'public/assets/css/frontend');

    //404
    mix.copy('resources/assets/css/frontend/404.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/404.js', 'public/assets/js/frontend');

    //500
    mix.copy('resources/assets/css/frontend/500.css', 'public/assets/css/frontend');

    //faq
    mix.copy('resources/assets/css/frontend/faq.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/faq.js', 'public/assets/js/frontend');
    mix.copy('resources/assets/vendors/mixitup/src/jquery.mixitup.js', 'public/assets/vendors/mixitup');

    // register
    mix.copy('resources/assets/css/frontend/register.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/jquery.min.js', 'public/assets/js');

    // login
    mix.copy('resources/assets/css/frontend/login.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/jquery.min.js', 'public/assets/js/frontend');
    mix.copy('resources/assets/js/frontend/bootstrap.min.js', 'public/assets/js/frontend');

    //shoping section
    //products page
    mix.copy('resources/assets/css/frontend/shopping.css', 'public/assets/css/frontend');

    //single_product
    mix.copy('resources/assets/vendors/bootstrap-rating/bootstrap-rating.js', 'public/assets/vendors/bootstrap-rating');
    mix.copy('resources/assets/vendors/bootstrap-rating/bootstrap-rating.css', 'public/assets/vendors/bootstrap-rating');
    mix.copy('resources/assets/css/frontend/cart.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/cart.js', 'public/assets/js/frontend');
    mix.copy('resources/assets/js/frontend/elevatezoom.js', 'public/assets/js/frontend');

    //portfolio section
    //portfolio
    mix.copy('resources/assets/css/frontend/portfolio.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/portfolio.js', 'public/assets/js/frontend');
    mix.copy('resources/assets/js/frontend/elevatezoom.js', 'public/assets/js/frontend');

    //portfolioitem
    mix.copy('resources/assets/css/frontend/portfolio.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/carousel.js', 'public/assets/js/frontend');

    //news section
    mix.copy('resources/assets/css/frontend/news.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/carousel.js', 'public/assets/js/frontend');

    //newsitem
    mix.copy('resources/assets/css/frontend/blog.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/carousel.js', 'public/assets/js/frontend');

    //contact page
    mix.copy('resources/assets/css/frontend/contact.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/gmap.js', 'public/assets/js/frontend');

    //user account
    mix.copy('resources/assets/css/frontend/user_account.css', 'public/assets/css/frontend');
    mix.copy('resources/assets/js/frontend/user_account.js', 'public/assets/js/frontend');

   // Custom Styles
    mix.styles(
        [
            /*replace "black.css" with "white.css" to apply white theme for template*/
            'fonts.css', 'bootstrap.min.css', 'font-awesome.min.css', 'black.css', 'panel.css', 'metisMenu.css'
        ], 'public/assets/css/app.css');

   // all global js files into app.js
    mix.scripts(
        [
            'jquery-1.11.1.min.js',
            '../vendors/jquery-ui/jquery-ui.min.js',
            'bootstrap.min.js',
            '../vendors/raphael/raphael-min.js',
            'livicons-1.4.min.js',
            'metisMenu.js',
            'josh.js',
            '../vendors/holderjs/holder.min.js'
        ], 'public/assets/js/app.js');

});
