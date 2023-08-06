# rsc-api-handler-laravel
simple package for error handler, send json format

# instalation
```sh
composer require mivu/rscapihandler-laravel
```
# Features
- Make Artisan Handlers
- Make Artisan Services
- Make Artisan Repositories
- Api Response Json Format
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
if you implementation service and repository, you can create inside function for response handler
```php
    public function limit(int $limit, $filter)
    {
        $res = $this->repository->limit($limit, $filter);
        return ResponseHandlers::tryCatch($res, 'miftahs', true);
    }
```
- Api Response Handlers
or you can create api response and automatically output is json
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
