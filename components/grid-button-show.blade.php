@props([
    'url',
    'title' => __('Show') 
])
<a class="btn btn-sm btn-link text-primary" 
    href="{{ $url }}" 
    title="{{ $title }}"><x-admin::icon icon="eye" /></a>