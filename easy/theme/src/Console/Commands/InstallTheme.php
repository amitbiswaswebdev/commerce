<?php

namespace Easy\Theme\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
// use Illuminate\Support\Facades\Log;

class InstallTheme extends Command
{
    const PATH = '/../../../stubs/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:easy-theme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish frontend assets and view files from easy theme to laravel application.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        return $this->installInertiaVueStack();
    }

    /**
     * Install the Inertia Vue Breeze stack.
     *
     * @return void
     */
    protected function installInertiaVueStack()
    {
        // Install Inertia...
        $this->requireComposerPackages(
            'inertiajs/inertia-laravel:^0.4.3',
            'laravel/sanctum:^2.6',
            'tightenco/ziggy:^1.0',
            'intervention/image:^2.7.0',
        );

        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return [
                'alpinejs' => '^2.7.3',
                '@inertiajs/inertia' => '^0.10.0',
                '@inertiajs/inertia-vue3' => '^0.5.1',
                '@inertiajs/progress' => '^0.2.6',
                '@tailwindcss/forms' => '^0.2.1',
                '@vue/compiler-sfc' => '^3.0.5',
                'autoprefixer' => '^10.2.4',
                'postcss' => '^8.2.13',
                'postcss-import' => '^14.0.1',
                'tailwindcss' => '^2.1.2',
                'vue' => '^3.0.5',
                'vue-loader' => '^16.1.2',
                '@mdi/font' => '^6.1.95',
                'vuedraggable' => '^4.1.0',
            ] + $packages;
        });

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/'));
        (new Filesystem)->copyDirectory(__DIR__.self::PATH.'resources/views/', resource_path('views/'));

        // Tailwind / Webpack...
        copy(__DIR__.self::PATH.'tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.self::PATH.'webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.self::PATH.'webpack.config.js', base_path('webpack.config.js'));
        copy(__DIR__.self::PATH.'jsconfig.json', base_path('jsconfig.json'));

        (new Filesystem)->ensureDirectoryExists(resource_path('css'));
        (new Filesystem)->copyDirectory(__DIR__.self::PATH.'resources/css', resource_path('css'));

        (new Filesystem)->ensureDirectoryExists(resource_path('js'));
        (new Filesystem)->copyDirectory(__DIR__.self::PATH.'resources/js', resource_path('js'));

        $this->info('Project scaffolding installed successfully.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }


    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }
}
