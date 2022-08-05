# Theresia App

Theresia app is a basic framework based on the [Theresia core package](https://github.com/boyonglab/theresia-core).  It is more of the starter app based on Theresia core package to speeds up website creation. Beside using it alongside [Paps Solutions Platform](https://paps.solutions), you can also use in your small PHP application development.

## Create a project

### Clone repository and install dependencies

```shell

> git clone https://github.com/boyonglab/theresia-app.git <project-name>
> cd <project-name>
> Composer install
```

### Launch app using PHP build-in server for development

- While at the root directory of your project run the command

```shell
> Php -S localhost:9000 -t src/public
```

- Visit <http://localhost:9000> on your browser. You should see the welcome page.

## File Structure

- The main application code is found inside the `src`.
- The `resource` directory contains images used in the `README.md` file.

### App directory

The `src/app` directory contains the following files

#### `config.php`

- `src/app/config.php` contains the configuration information of the entire project.
- You can add more configuration parameters to the configuration array, for example, let us add a new config param call `momo` to hold mobile payment credentials,

```php
...

$config = [
    'api' => [
        'key' => $_ENV['API_KEY'] ?? 'abcd'
    ],
    'momo' => [
        'token': 'my-momo-token'
    ]
]

...

```

- It is preferable to store your `momo` token value in a `.env` file and load it into the config file.

```php
    ...

$config = [
    'api' => [
        'key' => $_ENV['API_KEY'] ?? 'abcd'
    ],
    'momo' => [
        'token': $_ENV['MOMO_TOKEN']
    ]
]

...
```

#### `routes.php`

- `src/app/routes.php` contains all the routes need by your project
- You can define new routes and delete the ones you do not need as well

```php
...

$app->get('router')->get('/hello', function() use($app) {
    echo 'Say hello!';
 });

...
```

- You can learn more on how the router works by looking at the [Theresia core package](https://github.com/boyonglab/theresia-core) doc. user router link
  
#### `services.php`

- `src/app/services.php` conatains all the services needed by your project.
- Services help extend the features/capabilities of your project. For example to add a form feature.

```php
...

$app->set('form', function() {
    return new Form();
});

...
```

NB: You are the one to import the class `Form` from a third-party package or you created it in your project.

- you can make use of this new `form` feature within your router callback functions in the `src/app/routes.php` file

```php
...

$app->get('router')->get('/form', function() use($app) {
   $app->get('form')->render();
 });

...
```

- You can learn more on how the service works by looking at the [Theresia core package](https://github.com/boyonglab/theresia-core) doc. user router link

#### Public folder

- `src/public` directory plays the role of web server document root directories such  as www, html,  htdocs for example.
- It holds all the static files like CSS and images.
- It also contains the `index.php` file which is the entry point of the your project

#### Views folder

- `src/views` directory contains all the view templates need by your project.
- Your project comes with a  `welcome.php` template by default.
- In most cases, you will need to add more template files depending on the layout of your project.
- Templates are rendered by making use of the `view` method from the `$app` object

```php
  ...

  $app->get('router')->get('/', function() use($app) {
      $app->view('welcome');
  });

  ...
```

#### `src/bootstrap.php` file
- It initializes and runs Theresia core.
- In rare cases you will need to modify this file.
  
### Deployment

#### Nginx

#### Apache

#### Theresia App cloud hosting
