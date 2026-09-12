@props([
    'url',
    'title' => __('Edit') 
])
<a class="btn btn-sm btn-link text-primary" 
    href="{{ $url }}" 
    title="{{ $title }}"><x-admin::icon icon="edit" /></a>