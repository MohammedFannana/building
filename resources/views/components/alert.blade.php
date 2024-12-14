@props([
'name'
])

@php
$class = $name == 'error'? 'danger' : 'success';

@endphp

@if(session()->has($name))
<div class="alert alert-{{$class}}">
    {{ session($name) }}
</div>
@endif