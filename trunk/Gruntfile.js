
var globalConfig = {
    src : '../src/propertyhookup',
    dist:'app/themes/propertyhookup',
    bower_path : 'bower_components'
};
var jsFiles = [
    // globalConfig.bower_path +'/jquery/jquery.min.js',
    // globalConfig.bower_path +'/jquery-ui/jquery-ui.min.js',
    globalConfig.bower_path +'/underscore/underscore.min.js',
    globalConfig.bower_path +'/bootstrap/dist/js/bootstrap.min.js',
    globalConfig.src +'/js/notification/SmartNotification.min.js',
    globalConfig.src +'/js/smartwidgets/jarvis.widget.min.js',
    globalConfig.src +'/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js',
    globalConfig.src +'/js/plugin/sparkline/jquery.sparkline.min.js',
    globalConfig.src +'/js/plugin/jquery-validate/jquery.validate.min.js',
    globalConfig.src +'/js/plugin/masked-input/jquery.maskedinput.min.js',
    globalConfig.src +'/js/plugin/select2/400/select2_custom.js',
    globalConfig.src +'/js/plugin/select2/select2.min.js',
    globalConfig.src +'/js/plugin/bootstrap-slider/bootstrap-slider.min.js',
    globalConfig.src +'/js/plugin/msie-fix/jquery.mb.browser.min.js',
    globalConfig.src +'/js/plugin/smartclick/smartclick.js',
    globalConfig.src +'/js/plugin/jquery-form/jquery-form.min.js',
    globalConfig.src +'/js/app.js',
    globalConfig.src +'/js/demo.js',
    globalConfig.src +'/js/plugin/flot/jquery.flot.cust.js',
    globalConfig.src +'/js/plugin/flot/jquery.flot.cust.js',
    globalConfig.src +'/js/plugin/flot/jquery.flot.resize.js',
    globalConfig.src +'/js/plugin/flot/jquery.flot.tooltip.js',
    globalConfig.src +'/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js',
    globalConfig.src +'/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js',
    globalConfig.src +'/js/plugin/fullcalendar/jquery.fullcalendar.min.js',
    globalConfig.src +'/js/plugin/bootstrap-progressbar/bootstrap-progressbar.js',
    globalConfig.src +'/js/plugin/datatables/jquery.dataTables-cust.min.js',
    globalConfig.src +'/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js',
    globalConfig.src +'/js/plugin/datatables/ColReorder.min.js',
    globalConfig.src +'/js/plugin/datatables/FixedColumns.min.js',
    globalConfig.src +'/js/plugin/datatables/ColVisNew.js',
    globalConfig.src +'/js/plugin/datatables/ZeroClipboard.js',
    globalConfig.src +'/js/plugin/datatables/media/js/TableTools.min.js',
    globalConfig.src +'/js/plugin/datatables/DT_bootstrap.js',
    globalConfig.src +'/js/plugin/maxlength/bootstrap-maxlength.min.js',
    globalConfig.src +'/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js',
    globalConfig.src +'/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js',
    globalConfig.src +'/js/plugin/noUiSlider/jquery.nouislider.min.js',
    globalConfig.src +'/js/plugin/ion-slider/ion.rangeSlider.min.js',
    globalConfig.src +'/js/plugin/colorpicker/bootstrap-colorpicker.min.js',
    globalConfig.src +'/js/plugin/knob/jquery.knob.min.js',
    globalConfig.src +'/js/plugin/x-editable/moment.min.js',
    globalConfig.src +'/js/plugin/x-editable/x-editable.js',
    globalConfig.src +'/js/plugin/typeahead/typeahead.min.js',
    globalConfig.src +'/js/plugin/typeahead/typeaheadjs.min.js',
    globalConfig.src + '/js/plugin/pace/pace.min.js',
    globalConfig.src + '/js/accounting.js',
    globalConfig.src + '/js/PayPalButtonLoader.js'

    // globalConfig.src + '/js/alerts.js',
    // globalConfig.src + '/js/details.js',
    // globalConfig.src + '/js/saved.js',
    // globalConfig.src + '/js/search.js',
    // globalConfig.src + '/js/search_map.js',
    // globalConfig.src + '/js/userPropertyStatusOpt.js',
    // globalConfig.src + '/js/jquery.yiiactiveform.js',

];
var cssFiles = [
    globalConfig.bower_path +'/bootstrap/dist/css/bootstrap.min.css',
    globalConfig.src +'/css/font-awesome.min.css',
    // globalConfig.src +'/css/smartadmin-production.css',
    // globalConfig.src +'/css/smartadmin-skins.css',
    globalConfig.src +'/css/demo.css',
    globalConfig.src +'/css/styles-smartadmin.css',
    globalConfig.src +'/css/styles-smartadmin_1.css'
];
module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        jshint: {
            options: {
                curly: true,
                eqeqeq: true,
                immed: true,
                latedef: true,
                newcap: true,
                noarg: true,
                sub: true,
                undef: true,
                eqnull: true,
                browser: true,
                //reporter: require('jshint-log-reporter'),
                //reporterOutput: 'jshint-log.log',
                globals: {
                    jQuery: true,
                    $: true,
                    console: true
                }
            },
            files: {
                src: [
                    // globalConfig.src +'/js/*.js'
                ]
            }
        },
        copy:{
            main : {
                files : [{
                    expand : true,
                    flatten : true,
                    src : globalConfig.bower_path +'/bootstrap/dist/fonts/*',
                    dest : globalConfig.dist+'/fonts',
                    filter : 'isFile'
                }, {
                    expand : true,
                    flatten : true,
                    src : globalConfig.bower_path +'/font-awesome/fonts/*',
                    dest : globalConfig.dist+'/fonts',
                    filter : 'isFile'
                }, {
                    expand : true,
                    flatten : true,
                    src : globalConfig.src +'/fonts/*',
                    dest : globalConfig.dist+'/fonts'
                },
                    {
                    expand :true,
                    flatten : true,
                    src : globalConfig.src + '/js/*',
                    dest: globalConfig.dist + '/js',
                    filter : 'isFile'
                }
                ]
            }
        },
        concat: {
            distjs: {
                src: jsFiles,
                dest: globalConfig.dist+'/js/concat-build.js'
            },
            distcss: {
                src:cssFiles,
                dest: globalConfig.dist+'/css/concat-style.css'
            }
        },

        uglify: {
            options: {
                stripBanners: true,
                banner: '/* <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %> */\n' //comment in minified file
            },

            build: {
                src: globalConfig.dist+'/js/concat-build.js',  // what file should be minified
                dest: globalConfig.dist+'/js/concat-build.min.js' // destination of resulted file
            }
        },

        cssmin: {
            with_banner: {
                options: {
                    banner: '/* <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %> */\n' //comment in minified file
                },

                files: {
                   'app/themes/propertyhookup/css/concat-style.min.css' : globalConfig.dist+'/css/concat-style.css'
                }
            }
        },

        watch: { // Describe watchPlugin's work
            options: {
                livereload: true
            },
            scripts: {
                files: jsFiles,  // which files should be watched
                tasks: [/*'jshint',*/ 'concat', 'uglify'/*, 'removelogging'*/]  // after changes in previews files next commands will run
            },
            css: {
                files: cssFiles, // which files should be watched
                tasks: ['cssmin'] // after changes in previews files next commands will run
            }
        },


        removelogging: { //delete console.log from .js file
            dist: {
                src: "app/themes/propertyhookup/js/concat-build.min.js", // file that should be cleaned from 'console.log'
                dest: "app/themes/propertyhookup/js/concat-build.clean.js" // output file after cleaning
            }
        },
        clean: {
            css: [globalConfig.dist+'/css'],
            js:[globalConfig.dist+'/js'],
            fonts:[globalConfig.dist+'/fonts']
        }


    });

    // Load required plugins
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-remove-logging');
    grunt.loadNpmTasks('grunt-contrib-clean');

    /*Default tasks - grunt*/
    grunt.registerTask('default', [
        'jshint',
        'clean',
        'copy',
        'concat',
        'uglify',
        'cssmin',
        // 'removelogging',
        // 'watch'
        ]);
};
