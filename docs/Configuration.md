# Configuration

Please modify the configuration parameters accordingly before moving the application in production.

> The configuration parameters are located in the ```.env``` file.

## Configuration parameters

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
| MAILER_DSN        | The DSN connection string to connect to the mailing server. [More Info](https://symfony.com/doc/current/mailer.html#transport-setup)
##### If you wish to continue using the Google Mailer plugin (_mainly used for debugging_), you could modify following parameters accordingly:

| Parameter | Explanation |
|-----------|-------------|
| MAILER_USER | Full Gmail e-mail address (_including @gmail.com_)
| MAILER_PASS | Password of the Gmail account