# UaePass

It provide an easy way to integrate UAE Pass services in your application.

## Login

To login the user using UAE Pass, you can use the following code:

```php
use Ragab\UaePass;

// Customize your configuration
$uae = UaePass::fromClient([
    'client_id' => 'YOUR CLIENT ID',
    'token' => 'YOUR TOKEN',
    'redirect_url' => '/redirect/callback',
    'localization' => 'en',
    'production' => false
]);

// Redirect to UAE Pass login page in order to for the user to login
$uae->login();
```

## Register

To register the user using UAE Pass, you can use the following code:

```php
// Redirect to UAE Pass register page in order to for the user to register an account
$uae->register();
```
## Get User Info

You can handle the callback to get the user data using the following code;

```php
$uae->user($_GET['code'], $_GET['state']);
```

## Logout

To logout the user using UAE Pass, you can use the following code:

```php
$uae->logout();
```