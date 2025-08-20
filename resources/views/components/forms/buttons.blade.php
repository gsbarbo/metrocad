@props([
    'name',
    'cancelRoute',
    'color' => 'btn-green',
    'cancelRouteId' => null,
])

<div class="flex justify-between items-center">
    <input class="btn {{$color}} btn-md btn-rounded" type="submit" value="{{$name}}">
    <a class="text-red-600 hover:underline" href="{{ route($cancelRoute, $cancelRouteId) }}">Cancel</a>
</div>

