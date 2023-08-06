<?php

namespace Mivu\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeHandlerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:handler {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new handler';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file_name = $this->argument('filename');
        $path = $this->filePath($file_name);
        $this->createDir($path . 'Handler');
        if (File::exists($path)) {
            $this->error("File {$path} already exists!");
            return;
        }
        File::put($path, $this->content_file($file_name));
        $this->info("File {$path} created.");
    }
    /**
     * Get the service full path.
     *
     * @param string $file_path
     *
     * @return string
     */
    public function filePath($file_path)
    {
        $file_path = str_replace('.', '/', $file_path . 'Handler') . '.php';
        $path = "app/Handlers/{$file_path}";
        return $path;
    }
    /**
     * Create service directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }
    /**
     * content file
     */
    public function content_file($argument)
    {
        $data = <<<EOT
            <?php

            namespace App\Handlers;

            /**
             * @author miftah shidiq
             */
            class {$argument}Handler
            {
                static function HandlerName(){
                    // query ...
                }

            }
            EOT;

        return $data;
    }
}
