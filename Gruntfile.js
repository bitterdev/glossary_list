/**
 * @project:   Glossary List Add-on for concrete5
 * 
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

var packageName = "glossary_list";

module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        apigen: {
            main: {
                options: {
                    source: './src/',
                    destination: './docs/'
                }
            }
        },
        version: {
            php: {
                options: {
                    pkg: {
                        version: function() {
                            var s = grunt.file.read('controller.php');
                            var re = /\$pkgVersion[\s*]=[\s*][\'|\"](.*)[\'|\"]/g              
                            var m = re.exec(s);

                            if (m.length) {
                                return m[1];
                            }

                            return false;
                        }()
                    },
                    prefix: '@version\\s*'
                },
                src: [
                    'dist/*.php', 'dist/**/*.php', 'dist/**/**/*.php', 'dist/**/**/**/*.php', 'dist/**/**/**/**/*.php'
                ]
            }
        },
        composer: {
            options: {
                usePhp: true,
                composerLocation: './node_modules/getcomposer/composer.phar'
            },
            dev: {
                options: {
                    flags: ['ignore-platform-reqs']
                }
            },
            release: {
                options: {
                    flags: ['no-dev']
                }
            }
        },
        copy: {
            main: {
                files: [
                    {src: ['controller.php'], dest: "dist/", filter: 'isFile'},
                    {src: ['icon.png'], dest: "dist/", filter: 'isFile'},
                    {src: ['INSTALL.TXT'], dest: "dist/", filter: 'isFile'},
                    {src: ['LICENSE.TXT'], dest: "dist/", filter: 'isFile'},
                    {src: ['CHANGELOG'], dest: "dist/", filter: 'isFile'},
                    {src: ['elements/**'], dest: "dist/"},
                    {src: ['blocks/**'], dest: "dist/"},
                    {src: ['languages/**'], dest: "dist/"}
                ]
            }
        },
        compress: {
            main: {
                options: {
                    archive: 'build/' + packageName + '.zip'
                },
                files: [
                    {src: ['**'], dest: packageName, expand: true, cwd: 'dist/'}
                ]
            }
        },
        clean: {
            dist: ['dist'],
            composer: ['vendor', 'composer.lock']
        },
        phpcsfixer: {
            app: {
                dir: 'dist'
            },
            options: {
                bin: './vendor/friendsofphp/php-cs-fixer/php-cs-fixer',
                usingCache: "no",
                quiet: true
            }
        },
        po2mo: {
            files: {
                src: 'languages/de_DE/LC_MESSAGES/messages.po',
                dest: 'languages/de_DE/LC_MESSAGES/messages.mo'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-po2mo');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-composer');
    grunt.loadNpmTasks('grunt-php-cs-fixer');
    grunt.loadNpmTasks('grunt-version');
    grunt.loadNpmTasks('grunt-contrib-copy');

    grunt.registerTask('default', [ 'clean:composer', 'composer:release:install', 'clean:dist', 'copy', 'version', 'clean:composer', 'composer:dev:install', 'phpcsfixer', 'compress:main', 'clean:dist']);
};