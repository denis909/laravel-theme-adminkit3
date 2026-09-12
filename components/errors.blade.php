@foreach($errors->all() as $key => $err)
    <x-admin::alert type="danger">{{ $err }}</x-admin::alert>
@endforeach