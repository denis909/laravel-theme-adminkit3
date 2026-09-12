@props([
    'confirmation' => __('Are you sure?'),
    'url',
    'title' => __('Delete')
])
<form method="POST" 
        action="{{ $url }}" 
        data-confirmation="{{ $confirmation }}">
    @csrf
    <button class="btn btn-sm btn-link text-danger" type="submit" title="{{ $title }}"><x-admin::icon icon="x" /></button>
</form>