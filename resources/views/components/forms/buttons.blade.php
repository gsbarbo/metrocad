@props([
    'name',
    'cancelRoute',
    'type' => 'submit',
    'color' => 'btn-green',
])

<div class="flex justify-between items-center">
    <input class="btn {{$color}} btn-md btn-rounded" type="submit" value="{{$name}}">
    <a class="text-red-600 hover:underline" href="{{ route($cancelRoute) }}">Cancel</a>
</div>

