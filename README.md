RESTful API - Symfony 3
=======================

Requirements
------------

* PHP 5.5.9 or above

Deployment guide
----------------

http://symfony.com/doc/current/deployment.html

Creating database structure
---------------------------

```
$ php bin/console doctrine:schema:create
```

JWT Authentication
------------------

JWT Authentication has been implemented in this API. To authenticate using a token, 
send a `POST` request to the `/login_check` route by entering the `_username` parameter
with the desired user and `_password` with the password of user.

**Available users**

| Username | Password |
| -------- | -------- |
| restuser | restpass |

**cURL Request Example**

```
curl -X POST http://127.0.0.1:8000/login_check -d _username=restadmin -d _password=restpass
```

Use the token in the other requests that will be made, including the `Authorization: Bearer <token>` header.
