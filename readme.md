Add to your providers:

        Jameron\Invitations\InvitationsServiceProvider::class,

Add to your Facades:

        'Invitations' => Jameron\Invitations\Facades\InvitationsFacade::class,

Publish the assets and config

    php artisan vendor:publish
