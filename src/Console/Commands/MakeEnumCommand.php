<?php

namespace Mivu\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeEnumCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:enum {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new enum';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file_name = $this->argument('filename');
        $path = $this->filePath($file_name);
        $this->createDir($path . 'Enum');
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
        $file_path = str_replace('.', '/', $file_path . 'Enum') . '.php';
        $path = "app/Enums/{$file_path}";
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

            namespace App\Enums;

            /**
             * @author miftah shidiq
             */
            enum {$argument}Enum:string
            {
                case enumMivu1 = "Mivu 1";
                case enumMivu2 = "Mivu 2";
                case enumMivu3 = "Mivu 3";
                case enumMivu4 = "Mivu 4";
            }
            EOT;

        return $data;
    }
}
