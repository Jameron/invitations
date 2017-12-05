# Invitations
## Send email based invites to potential new users.

This package is designed to enable web applications the feature of sending tokenized email invitations to potential new users. The invitation is a record on a invitations table, and once claimed is removed and a new user is added to the users table. This package was designed to work the the [Admin Package](https://github.com/jameron/admin) and the [Regulator Package](https://github.com/jameron/regulator)

## Setup instructions

1) Add the package to yuor composer.json file

```"jameron/invitations" : "*"```

NOTE: Laravel 5.5 users can skip steps 2 and 3

2) Add to your providers:
```php
        Jameron\Invitations\InvitationsServiceProvider::class,
```
3) Add to your Facades:
```php
        'Invitations' => Jameron\Invitations\Facades\InvitationsFacade::class,
```

4) Publish the migrations and config

    ```php artisan vendor:publish```

5) Run migrations

    ```pph artisan migrate```

6) If you want to tie related model data to your invitations you can set that in your config/invitations.php config file.  


Make sure to add the Invitable Trait to the model you are relating to your invitations:

```php
use Jameron/Invitations/Models/Traits/Invitable;
```

then in the class add that Trait

```php
use Invitable;
```

If for example say you are inviting an user to manage a page you created for them. You have a table called pages, with foreign_key user_id currently set to null. You want the page user_id (nullable) set to the invited user once they claim their invite.

Your config would look like this:
```php

    'related' => [
        'active' => false,
        'model' => \App\Page::class,
        'resource_route' => 'pages',
        'title' => 'Pages',
        'id_column' => 'id',
        'value_column' => 'title',
        'user_foreign_key' => 'user_id',
        'owner_foreign_key' => null
	],
```

When the invitation is claimed the page associated to the invitation will be updated with the users id.
