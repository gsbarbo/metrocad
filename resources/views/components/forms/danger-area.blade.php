@props([
    'confirm',
    'route',
    'id',
    'cancelRoute',
])

<div class="border-red-600 border-2 p-3">
    <h3 class="text-red-600 text-lg font-bold">Danger Zone</h3>
    <p class="">Deleting this will delete the following information that can <span
            class="font-bold text-red-600">NOT</span> be recovered:</p>
    <ul class="list-inside list-disc ml-5">
        {{ $slot }}
    </ul>
    <p>Are you sure you wish to continue?</p>
    <form action="{{ route($route, $id) }}"
          class="mt-5 block space-y-3" method="POST">
        @csrf
        @method('delete')

        <x-forms.input name="confirm" label="Please type
                ({{ $confirm }}) to confirm delete."></x-forms.input>
        
        <x-forms.buttons name="Delete" color="btn-red" cancel-route="{{$cancelRoute}}"></x-forms.buttons>
    </form>
</div>
