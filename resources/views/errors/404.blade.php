@auth
    @include('errors.404-auth')
@else
    @include('errors.404-guest')
@endauth
