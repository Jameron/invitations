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
