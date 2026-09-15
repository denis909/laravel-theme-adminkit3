@props([
    'url',
    'id' => null,
    'title' => null
])                
@php
if (empty($url))
{
    return;
}

if (empty($id))
{
    $id = 'image-' . md5($url);
}

@endphp
<a href="{{ $url }}" 
    data-lightbox="{{ $id }}"
    data-title="{{ $title }}"><img src="{{ $url }}" /></a>