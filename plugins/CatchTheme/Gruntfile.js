module.exports = function (grunt) {
    'use strict';

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Sass
        sass: {
            dev: {
                options: {
                    style: 'expanded',
                    lineNumbers: true,
                    trace: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'webroot/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/css',
                        ext: '.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/feeder/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/feeder/css',
                        ext: '.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/ebay_checkout/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/ebay_checkout/css',
                        ext: '.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/itool_customer/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/itool_customer/css',
                        ext: '.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/help_desk/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/help_desk/css',
                        ext: '.css'
                    }
                ]
            },
            prod: {
                options: {
                    style: 'compressed'
                },
                files: [
                    {
                        expand: true,
                        cwd: 'webroot/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/css',
                        ext: '.min.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/feeder/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/feeder/css',
                        ext: '.min.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/ebay_checkout/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/ebay_checkout/css',
                        ext: '.min.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/itool_customer/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/itool_customer/css',
                        ext: '.min.css'
                    },
                    {
                        expand: true,
                        cwd: 'webroot/help_desk/css/src',
                        src: ['*.scss'],
                        dest: 'webroot/help_desk/css',
                        ext: '.min.css'
                    }
                ]
            }
        },
        concat: {
            options: {
                separator: ';\n',
            },
            dev: {
                src: [
                    'webroot/ebay_checkout/js/checkout.js',
                    'webroot/ebay_checkout/js/item.js',
                    'webroot/ebay_checkout/js/shipping-address.js',
                    'webroot/ebay_checkout/js/payment.js',
                    'webroot/ebay_checkout/js/totals.js',
                    'webroot/ebay_checkout/js/progress.js',
                    'webroot/ebay_checkout/js/apply-coupon.js'
                ],
                dest: 'webroot/ebay_checkout/js/main.js'
            },
            mergeAllJs: {
                src: [
                    'webroot/js/jquery.ui.touch-punch.min.js',
                    'webroot/ebay_checkout/js/main.min.js',
                    'webroot/ebay_checkout/js/mini-cart.min.js',
                    'webroot/feeder/js/img-slider.min.js',
                    'webroot/feeder/js/homepage-slider.min.js',
                    'webroot/feeder/js/simple-slider.min.js',
                    'webroot/feeder/js/product.min.js',
                    'webroot/feeder/js/jquery-scrollto.min.js',
                    'webroot/feeder/js/swipe.min.js',
                    'webroot/itool_customer/js/wishlist.min.js',
                    'webroot/js/catcher.min.js',
                    'webroot/js/slick.min.js',
                    'webroot/js/cookie.min.js',
                    'webroot/js/lazysizes.min.js'
                ],
                dest: 'webroot/js/main.min.js'
            }
        },

        uglify: {
            options: {
                compress: {
                    drop_console: true
                },
                //mangle: false
            },
            prod: {
                files: {
                    'webroot/ebay_checkout/js/main.min.js': [
                        'webroot/ebay_checkout/js/main.js'
                    ],
                    'webroot/ebay_checkout/js/mini-cart.min.js': [
                        'webroot/ebay_checkout/js/mini-cart.js'
                    ],
                    'webroot/feeder/js/img-slider.min.js': [
                        'webroot/feeder/js/img-slider.js'
                    ],
                    'webroot/feeder/js/homepage-slider.min.js': [
                        'webroot/feeder/js/homepage-slider.js'
                    ],
                    'webroot/feeder/js/simple-slider.min.js': [
                        'webroot/feeder/js/simple-slider.js'
                    ],
                    'webroot/feeder/js/product.min.js': [
                        'webroot/feeder/js/product.js'
                    ],
                    'webroot/feeder/js/ajax-browse.min.js': [
                        'webroot/feeder/js/ajax-browse.js'
                    ],
                    'webroot/feeder/js/jquery-scrollto.min.js': [
	                    'webroot/feeder/js/jquery-scrollto.js'
	                ],
                    'webroot/feeder/js/swipe.min.js': [
                        'webroot/feeder/js/swipe.js'
                    ],
                    'webroot/itool_customer/js/wishlist.min.js': [
                        'webroot/itool_customer/js/wishlist.js'
                    ],
                    'webroot/itool_customer/js/customer.min.js': [
                        'webroot/itool_customer/js/customer.js'
                    ],
                    'webroot/itool_customer/js/interests.min.js': [
                        'webroot/itool_customer/js/interests.js'
                    ],
                    'webroot/js/slick.min.js': [
                        'webroot/js/slick.js'
                    ],
                    'webroot/js/catcher.min.js': [
                        'webroot/js/catcher.js'
                    ],
                    'webroot/js/header.min.js': [
                        'webroot/js/header.js'
                    ],
                    'webroot/js/cookie.min.js': [
                        'webroot/js/cookie.js'
                    ],
                    'webroot/js/datalayer.min.js': [
                        'webroot/js/datalayer.js'
                    ]
                }
            }
        },
        // WATCH AND RUN TASKS
        watch: {
            js: {
                files: [
                    'webroot/js/*.js',
                    '!webroot/js/*.min.js',
                    'webroot/**/js/*.js',
                    '!webroot/**/js/*.min.js'
                ],
                tasks: ['concat:dev', 'uglify:prod']
            },
            sass: {
                files: [
                    'webroot/css/src/*.scss',
                    'webroot/css/src/bootstrap/*.scss',
                    'webroot/**/css/src/*.scss'
                ],
                tasks: ['sass:dev', 'sass:prod']
            }

        },
        shell: {
            cakeAssetsBuild: {
                command: "../../bin/cake assets build"
            },
            cakeAssetsRemove: {
                command: "../../bin/cake assets remove"
            },
            buildReact: {
                command: [
                    "cd ./react",
                    "npm run build",
                    "cd .."
                    ].join('&&')
            },
            cakeMigrateAll: {
                command: [
                    '../../bin/cake migrations migrate',
                    '../../bin/cake migrations migrate -p Acl',
                    '../../bin/cake migrations migrate -p UrlRewrite',
                    '../../bin/cake migrations migrate -p Dashgum',
                    '../../bin/cake migrations migrate -p Dashboard',
                    '../../bin/cake migrations migrate -p Ebay',
                    '../../bin/cake migrations migrate -p AclManager',
                    '../../bin/cake migrations migrate -p EbayCheckout',
                    '../../bin/cake migrations migrate -p ItoolCustomer',
                    '../../bin/cake migrations migrate -p Feeder',
                    '../../bin/cake migrations migrate -p ZipData',
                    '../../bin/cake migrations migrate -p ADmad/SocialAuth',
                    '../../bin/cake migrations migrate -p HelpDesk',
                    '../../bin/cake migrations migrate -p VisitManager',
                    '../../bin/cake acl_extras aco_sync',
                    '../../bin/cake cache clear_all'
                ].join('&&')
            },
            googleDeploy: {
                command: "cd ../.. && gcloud app deploy app.yaml cron.yaml --no-promote --verbosity=info"
            }
        }
    });

    // tasks from npm
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify-es');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-shell');


    // our tasks
    grunt.registerTask('default', ['concat:dev', 'uglify:prod',  'concat:mergeAllJs', 'sass:dev', 'sass:prod']);
    grunt.registerTask('prod', ['concat:dev', 'uglify:prod', 'concat:mergeAllJs', 'sass:prod']);
    grunt.registerTask('build', ['shell:buildReact', 'concat:dev', 'uglify:prod',  'concat:mergeAllJs', 'sass:dev', 'sass:prod', 'shell:cakeAssetsBuild']);
    grunt.registerTask('remove', ['shell:cakeAssetsRemove']);
    grunt.registerTask('migrate', ['shell:cakeMigrateAll']);
    grunt.registerTask('deploy', ['shell:googleDeploy']);

};
