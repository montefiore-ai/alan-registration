# Web application workflow

#### Submitting a request
When a user submits a request to use the Alan cluster, an e-mail will be send to the cluster administrator.
The administrator's e-mail is pre-defined within the application's configuration (`env.local`)

The cluster administrator will have the option to either approve or deny the user's request.

#### Approving a request
When the administrator approves a certain request, the web application will create a new user through
the FreeIPA API. The user who issued the request will get notified by mail, containing their credentials to log in.

#### Denying a request
When the administrator denies a certain request, he will have the option to add a brief explanation on
why the request got denied.

The user will then get notified by mail about this denial and, if added, the administrator's explanation.