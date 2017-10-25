# SlimSwaggerDispatcher

Maybe it's about automation, or just about beign more declarative because a DSL non Touring complete language will just more correct, anyway I find it just amazing the possibility to describe an API by using the [Open-API-Specification](https://github.com/OAI/OpenAPI-Specification/blob/master/README.md) and let this description be automatically your code. Isn't that how it should be development?

Furthermore, the Api specification from Swagger can be automatically validated, tested
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

## Usage

Even if its working, I'd not consider it really a *stable* package. So to install it you need to proceed in that way:
composer config minimum-stability dev
composer require dispatcher/swagger-dispatcher

```
$swaggerConfigProvider = new \Dispatcher\Swagger\ConfigProvider\Yaml();
$swaggerConfig = $swaggerConfigProvider->getFromFile($path);
\Dispatcher\Swagger\SwaggerDispatcher::InjectRoutesFromConfig($app, $swaggerConfig); 
        
```

Where $app is a \Slim\App object, and $path just the url to the yaml file.

That's all folks.



## Help wanted

There is no validation at all. This process can be automatized. Class *CommandHandler* on the file called *SwaggerDispatcher*.

Thanks,
Virgilio 
