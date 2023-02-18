<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';
require_once 'vendor/autoload.php';

// Project name
set('application', 'faboi-local-sso');

// Project repository
set('repository', 'git@github.com:Fabio1202/faboi-local-sso.git');

// set 3 releases to keep
set('keep_releases', 3);

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('auth.faboi.deployment')
    ->set('deploy_path', '/var/www/auth.faboi.de');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('npm:run', function () {
    // Gib die aktuelle Node Version aus
    run('cd {{release_path}} && npm run build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

after('deploy:vendors', 'npm:install');
after('npm:install', 'npm:run');

