@component('mail::message')
    # New Premium Subscription Request

    Student Name **{{ $user->name }}** (System ID: {{ $user->system_id }}) has requested a premium subscription.

    **Amount:** {{ $amount }}

    **Method:** {{ $method }}

    **Transaction Number:** {{ $txt_number }}



    {{-- @component('mail::button', ['url' => url('/admin')])
        View Details
    @endcomponent --}}

    Thanks,
    SIAC Abroad
    {{-- {{ config('app.name') }} --}}
@endcomponent
