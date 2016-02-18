# Slim3 Plates Service Provider

This package contains a [container interop](https://github.com/container-interop/container-interop) compatible service 
provider and a renderer for rendering [php plates](http://platesphp.com/) view scripts into a PSR-7 responsive object. 
It works well with version 3 of the [Slim framework](http://www.slimframework.com/).

## Getting started

The easiest method of getting started is to include this library via composer:

```
composer require carbontwelve/slim-plates
```

## Example usage with Slim 3

```php
use Carbontwelve\SlimPlates\PlatesViewProvider;

include "vendor/autoload.php";

$app = new Slim\App(
    new \Slim\Container([
        'renderer' => [
            'template_path' => realpath(__DIR__.'/views'),
            'template_ext' => 'phtml'
        ]
    ])
);
$container = $app->getContainer();
$container->register(new Carbontwelve\SlimPlates\PlatesViewProvider());

$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->renderer->render($response, "/hello.phtml", $args);
});

$app->run();
```

## Example usage with any PSR-7 project

```php
$yourData = [];
$platesRenderer = new Carbontwelve\SlimPlates\PlatesRenderer('./path/to/templates', 'phtml');
$response = $platesRenderer->render(new Response(), 'template', $yourData)
```

## Not invented here

This project was something I put together to meet my own needs and as way of learning git. There are a couple of 
alternatives that you might want to investigate.

   - [projek-xyz/slim-plates](https://github.com/projek-xyz/slim-plates)
   - [media32/slim-view-plates](https://github.com/media32/slim-view-plates)
   - [philipsharp/slim-view-plates](https://github.com/philipsharp/slim-view-plates)
