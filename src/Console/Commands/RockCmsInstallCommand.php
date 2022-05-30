<?php

namespace WebVovan\RockCms\Console\Commands;

use Illuminate\Console\Command;

class RockCmsInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rock-cms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда установки Rock.Cms';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'rock-cms-config'
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'rock-cms-view'
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'rock-cms-public'
        ]);

        $this->call('vendor:publish', [
            '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
            '--tag' => 'migrations',
        ]);

        $this->call('adminlte:plugins', [
            'operation' => 'install',
            '--plugin' => ['summernote'],
            '--force' => true
        ]);

        $this->info('🤘 Установка Rock.Cms успешно выполнена');

        return 0;
    }
}
