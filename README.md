# Usage

## Requirements

* PHP 7.3 or higher (_7.4 recommended_)
* FreeIPA server installation
* Docker (_If you wish to run the application in a dockerized environment_)

## Configuration

Please modify the configuration parameters accordingly before deploying the application in production.

> The configuration parameters can be found in the ```.env``` file.

### Main configuration

| Parameter | Explanation |
|-----------|-------------|
| APP_ENV       | The environment in which the application should run (_dev/prod_)
| ROOT_URL      | The root path of where the web application is located (without a trailing slash)
| ROOT_MAIL     | The e-mail address from which all outgoing e-mails will be sent
| CLUSTER_ADMIN | The e-mail address of the cluster administrator who will handle access requests
| MASTER_IP     | The IP address of the alan master server (_used in templates/email/request_approved.html.twig_)
| MASTER_HOST   | The host of the alan master server (_used in templates/email/request_approved.html.twig_)
| SLURM_USER    | The user that has been assigned in _slurm.conf_ (default is ```slurm```)

> _Please note that the web application will not display any error messages or stacktraces when APP_ENV is set to prod._

### FreeIPA configuration

| Parameter | Explanation |
|-----------|-------------|
| IPA_HOST      | The host where the FreeIPA server is located (without ```https://```)
| IPA_ADMIN_USER| The username of the FreeIPA administrator account
| IPA_ADMIN_PASS| The password of the FreeIPA administrator account

### Database configuration

| Parameter         | Explanation |
|-----------        |-------------|
| MYSQL_DATABASE    | The name of the database schema used for the web application
| MYSQL_USER        | The username associated with the MySQL database
| MYSQL_PASSWORD    | The password of the above user
| MYSQL_ROOT_PASSWORD| The password of the MySQL root user

### SMTP configuration
| Parameter         | Explanation |
|-----------        |-------------|
| MAILER_DSN        | The DSN connection string used to connect with a mailing server. [More Info](https://symfony.com/doc/current/mailer.html#transport-setup)

If your SMTP server is using a self-signed certificate or fails to establish a secure connection,
please add ```?verify_peer=0``` to the ```MAILER_DSN``` connection string.

### Slurm user groups

The user groups which are used for Slurm are defined in ```src/Form/AccessRequestApproveFormType.php```
and in ```src/Service/FreeIPA/FreeIPAHelper.php:getExpirationValue()```.

If you change or add a usergroup in Slurm, please make sure to modify/add their identifier in the above files as well.

## Installation

### Required certificates and SSH keys

#### Installing FreeIPA certificate

You can obtain the FreeIPA CA certificate via __https://<IPA_HOST>/ipa/config/ca.crt__.

Save this certificate in the ```alan-config/freeipa``` directory inside the project root (_named_ ``ca.crt``). It is required to establish a secure connection
with the FreeIPA server.

#### Installing Slurm private key

Download the private SSH key of the slurm user (```SLURM_USER``` _in configuration file_) and save it as ```slurm```
inside the ```alan-config/ssh``` directory.

When you did above steps correctly, you should end up with the following structure:
* <project-root>/alan-config/freeipa/ca.crt
* <project-root>/alan-config/ssh/slurm

## Deployment

### Deploy using Docker (recommended)

To deploy the application with Docker, first modify the ```.env``` file accordingly.
Don't forget to install the FreeIPA certificate and slurm SSH keys.

When you followed all configuration and installation steps, deploy the container with:

    $ docker-compose up -d --force-recreate --build
    
### Deploy stand-alone

#### Requirements

* Composer
* MySQL
* Web server (_nginx is recommended_)

To deploy the application stand-alone, modify the ```.env``` accordingly.

Next, install all required dependencies with

    $ composer install
    
If the database you defined in the configuration (``MYSQL_DATABASE``) does not exist yet, you can create it with

    $ php bin/console doctrine:database:create
    
Finally, create the database schema:

    $ php bin/console doctrine:schema:create
    
When configuring your web server for the application, make sure to set the webroot to the ``/public`` directory.

## Modifying templates

If you wish to modify the templates of either the website or the e-mails, you can find them inside the ``/templates`` directory.

The templates use the [Twig template engine](https://twig.symfony.com/).

### Passing additional data

To pass additional parameters to a Twig template, pass them as an array of the ```render()``` method.
Check [Rendering a template](https://symfony.com/doc/current/templates.html#rendering-a-template-in-controllers) for reference.


## Workflow

### Submitting a request
When a user submits a request to use the Alan cluster, an e-mail will be sent to the cluster administrator.

The cluster administrator will have the option to either approve or deny the user's request.

### Approving a request
When the administrator approves a certain request, the web application will create a new user through
the FreeIPA API. The user who issued the request will get notified by mail, containing their credentials and SSH key to log in.

### Denying a request
When the administrator denies a certain request, he will have the option to add a brief explanation on
why the request got denied.

The user will then get notified by mail about this denial and, if added, the administrator's explanation.