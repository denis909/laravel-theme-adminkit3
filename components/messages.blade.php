@if ($message = session('status'))
    <x-admin::alert type="info" message="{{ $message }}" />
@endif

@if ($message = Session::get('success'))
    <x-admin::alert type="success" message="{{ $message }}" />
@endif

@if ($message = Session::get('error'))
    <x-admin::alert type="danger" message="{{ $message }}" />
@endif