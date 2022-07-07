<?php

namespace JsonBaby\EventBridge\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallEventBridgeCommand extends Command
{
    protected $signature = 'eventbridge:install';

    protected $description = 'Install the EventBridge';

    public function handle()
    {
        $this->info('Installing EventBridge...');

        $this->info('Publishing configuration...');

        if (! $this->configExists('event-bridge.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration(true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed EventBridge');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--tag' => "event-bridge-config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }
}