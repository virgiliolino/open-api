# Open-api

Maybe it's about automation, or just about being more declarative because a non Touring complete DSL will just more be correct, I find it just amazing the possibility to describe an API by using the [Open-API-Specification](https://github.com/OAI/OpenAPI-Specification/blob/master/README.md) and let this specification be your code: this class will set every route using the Slim functionalities, and for every route point to a CommandHandler.

I'd suggest, the best way to see it in action is just to clone the repository and try the Example Hello World Application:
```
git clone git@github.com:virgiliolino/open-api.git
cd open-api/Examples/HelloWorld/
composer install   #composer install will actually install Slim and open-api
php -S localhost:8080 -t public #start the server
curl localhost:8080/hello/world # or just open the browser localhost:8080/hello/world
```

For a fully working application, you could take a look at a ReactJS + Slim Skeleton that provides all the functionalities needed for a modern application.
The url is [here](https://github.com/incubactor/slim-react-skeleton/)
The OpenApi specification is [here](https://app.swaggerhub.com/apis/virgiliolino/slim-react-skeleton/1.0.0)

You will not have a few overpopulated Controllers, but instead for every entry point a command handler.
You can read at this [blog post](https://jenssegers.com/85/goodbye-controllers-hello-request-handlers?utm_campaign=Revue%20newsletter&utm_medium=Newsletter&utm_source=A%20Semana%20PHP) for some ideas of how we intend our architecutre 

Furthermore, the Open-Api specification can be automatically validated, tested
![Swagger](https://2434zd29misd3e4a4f1e73ki-wpengine.netdna-ssl.com/wp-content/uploads/2016/11/SwaggerHP_Design-.png)

In the end you'll have a yml or json file that describe your API, something like this:
![Json Specification](https://raw.githubusercontent.com/virgiliolino/SwaggerSlimDispatcher/master/swagger.png) 

By using our library all routes will automatically be set. Every route pointing to a CommandHandler indicated by a unique operationId.
So in the image of the example, you can see that there is a route:
/pet that accept post requests. It will be enough to use our class, when you start the application the route /pet will accept a post.
And so for the gets that you see below, like /pet/findByStatus, etc.
For every path, it will be executed the command handler with the operationI.
In the example for /pet, you can see the **operationId: addPet**. So making a post request to /pet, the system will try to execute the class AddPet::execute passing the params. The operationId must be a fully qualified name of a class. Something like this for example:
operationId: \MyApplication\CommandHandlers\AddPett
which means that will execue AddPett::execute

You may find an example of a fully working Open-Api specification [here](http://petstore.swagger.io/) [the full json file](http://petstore.swagger.io/v2/swagger.json)

## Installation

```
composer require dispatcher/open-api
```

## Examples/Helloworld

```
require 'vendor/autoload.php';
$app = new \Slim\App;
$container = $app->getContainer();
//your command Handlers need to be injected by operationId
$container['HelloWorld'] = function () {
    return new \HelloWorld\CommandHandlers\HelloWorld();
};
$openApiFile = 'routes.json';
$openApiConfigParser = Dispatcher\OpenApi\ParserFactory::parserFor($openApiFile);
$openApiConfig = $openApiConfigParser->parse($openApiFile);
$applicationBridge = new \Sab\Application\Bridge\SlimBridge($app);
$routesInjector = new \Dispatcher\OpenApi\Route\DefaultRouteInjector();
$openApiDispatcher = new \Dispatcher\OpenApi\OpenApiDispatcher($routesInjector);
$openApiDispatcher->InjectRoutesFromConfig($applicationBridge, $openApiConfig);

$app->run();

```

As you may see we're injecting HelloWorld, a command Handler with the same id of operationId that you may find on routes.json

That's all folks.



## Help wanted

There is no validation at all. This process can be automatized. Class *CommandHandler* on the file called *SwaggerDispatcher*.

Thanks,
Virgilio 
