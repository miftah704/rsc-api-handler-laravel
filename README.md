# rsc-api-handler-laravel
A simple package for handling errors, JSON templates, and repository patterns including Artisan commands.

# instalation
```sh
composer require mivu/rscapihandler-laravel
```
# Features
- Create Artisan Handlers
- Create Artisan Services
- Create Artisan Repositories
- JSON API Response Format
- Model Response Format
# Basic Usage
Artisan Commands
```sh
 php artisan make:repository Miftah
```
Output Path : App->Repositories->MiftahRepository.php AND App->Services->MiftahService.php
```sh
 php artisan make:handler Miftah
```
Output Path : App->Handlers->MiftahHandler.php
```sh
 php artisan make:enum Miftah
```
Output Path : App->Enums->MiftahEnum.php

Helpers
- Validation Handler
```php
    ValidationHandler::check([
            'page' => 'required|numeric',
            'limit' => 'required|numeric',
        ]);
```
- Response Handler
If you have implemented a service and repository, you can create an inside function for response handling.
```php
    public function limit(int $limit, $filter)
    {
        $res = $this->repository->limit($limit, $filter);
        return ResponseHandlers::tryCatch($res, 'miftahs', true);
    }
```
- Api Response Handlers
Alternatively, you can create an API response and the output will be automatically in JSON format.
```php
    public function find($id)
    {
        try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            ApiHandlers::exception($e);
        }
    }
```
Here's an example of the output:
![output](https://github.com/miftah704/rsc-api-handler-laravel/blob/main/output-exam.png)
