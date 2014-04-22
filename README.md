ZF2 REST API
=======================

Introduction
------------
This is a simple REST API application using the ZF2 MVC layer and module
systems. It is only serving users right now. It utilizes the Apigility modules
ZF-ContentNegotiation (to take care of Content Negotiation) and ZF-API-PROBLEM (to return
all exceptions and errors as JSON, with the content type of applicaion/problem+json).

Installation
------------

### Clone repo

`git clone https://github.com/wooz86/zf2restapi`

### Setup Apache Virtual host

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

```
<VirtualHost zf2restapi.dev:80>
    ServerName zf2restapi.dev
    DocumentRoot /path/to/zf2restapi/public
    SetEnv APPLICATION_ENV "development"
    <Directory /path/to/zf2restapi/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

### Install Composer dependencies

The recommended way to download all dependencies of this project is to use the 
locally bundled install of `composer` by running:
`./composer.phar install`
from the root of the project directory.

### Set full file permissions for the data folder
`chmod -R 777 data/`

### Setup a local database
* Create a database withe a name of for example `zf2restapi`
* Copy file `config/autoload/db.local.php.dist` to `config/autoload/db.local.php` and set your database details and with credentials in this new file.
* Execute command `./vendor/bin/doctrine-module migration:migrate` to run Doctrine migrations to setup database structure. What this does is that it runs all files in `data/migrations.


Interacting with the API
------------------------

### Get all users
```GET /users```
To retrieve an array of all users, you send a GET request
to the above URI.

### Get user by ID
```GET users/{id}```
To retrieve a single user by its ID, you send a GET request
to the above URI.

### Create user
```POST /users```
To create a new user, you need to send the POST-data
as JSON with a request header of `application/json`.

Example post data:
```
{
    "firstname": "Test",
    "lastname": "User",
    "email": "user@example.org",
    "username": "test_user",
    "password": "mysecretpassword"
}
```

