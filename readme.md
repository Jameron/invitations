1) Add the package to yuor composer.json file

```"jameron/invitations" : "1.*"```

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

```php

    'related' => [
        'active' => false,
        'model' => \App\ExampleModel::class,
        'id_column' => 'id',
        'value_column' => 'name'
    ]
```

Make sure to add this to the model you are relating to your invitations:

```php
use Jameron/Invitations/Models/Traits/Invitable;
```

then in the class add that Trait

use Invitable;
