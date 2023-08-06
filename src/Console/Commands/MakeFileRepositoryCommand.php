<?php

namespace Mivu\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeFileRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file_name = $this->argument('filename');
        $repositoryPath = $this->filePath('Repositories', $file_name . 'Repository');
        $servicePath = $this->filePath('Services', $file_name . 'Service');

        $this->createDir($repositoryPath);
        $this->createDir($servicePath);

        foreach ([$repositoryPath, $servicePath] as $path) {
            if (File::exists($path)) {
                $this->error("File {$path} already exists!");
                return;
            }
        }

        $repositoryContent = $this->content_file('Repositories', $file_name);
        $serviceContent = $this->content_file('Services', $file_name);

        File::put($repositoryPath, $repositoryContent);
        File::put($servicePath, $serviceContent);

        $this->info("File {$repositoryPath} and {$servicePath} created.");
    }
    /**
     * Get the service full path.
     *
     * @param string $file_path
     *
     * @return string
     */
    public function filePath($folder_path, $file_path)
    {
        $file_path = Str::replace('.', '/', $file_path) . '.php';
        $path = "app/{$folder_path}/{$file_path}";
        return $path;
    }

    /**
     * Create service directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        File::makeDirectory(dirname($path), 0777, true, true);
    }

    /**
     * content file
     */
    public function content_file($folder_path, $argument)
    {
        if ($folder_path === 'Services') {
            $data = <<<EOT
                <?php

                namespace App\Services;

                use App\Repositories\\{$argument}Repository;

                /**
                 * @author miftah shidiq
                 */
                class {$argument}Service
                {
                    public function __construct(protected {$argument}Repository \$repository)
                    {
                    }

                    // query

                    public function find(\$id)
                    {
                        try {
                            return \$this->repository->find(\$id);
                        } catch (\Exception \$e) {
                            return response()->json(\$e->getMessage());
                        }
                    }

                    public function firstWhere(string \$column, string \$value)
                    {
                        try {
                            return \$this->repository->firstWhere(\$column, \$value);
                        } catch (\Exception \$e) {
                            return response()->json(\$e->getMessage());
                        }
                    }

                }
                EOT;
        } else {
            $data = <<<EOT
                    <?php

                    namespace App\Repositories;

                    use App\Models\\$argument;

                    /**
                     * @author miftah shidiq
                     */
                    class {$argument}Repository
                    {
                        public function __construct(protected $argument \$model)
                        {
                        }

                        // query

                        public function find(\$id) : $argument
                        {
                            return \$this->model->find(\$id);
                        }

                        public function firstWhere(string \$column, string \$value): $argument
                        {
                            return \$this->model->firstWhere(\$column, \$value);
                        }

                    }
                    EOT;
        }

        return $data;
    }
}
