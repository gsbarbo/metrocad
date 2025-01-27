<div class="divide-y divide-red-200 border-red-700 border-4 overflow-hidden rounded-lg bg-navbar shadow">
    <div class="bg-red-700 px-4 py-5 sm:px-6">
        <h3 class="text-base font-semibold">Danger Zone</h3>
    </div>
    <div class="px-4 py-5 sm:p-6 space-y-3">
        <p>This section will allow you to either Suspend or Ban an user. When
            you SUSPEND a member no member data is deleted. Just restricts access to the CAD. When
            you
            BAN a member you will remove all their data (Civilians, Vehicles etc). Read more on the
            Docs.</p>

        @if ($user->status === 3)
            <p class="bg-red-700 px-3 py-2 rounded-lg">This user is already suspended. You can only ban the member from
                here.</p>
        @endif

        @if ($user->status === 4)
            <p class="bg-red-700 px-3 py-2 rounded-lg">This user is already banned.</p>
        @else
            <form class="" wire:submit="save">
                <div class="mb-2">
                    <label class="label-dark" for="">Type</label>
                    <select class="form-select-input-dark" wire:model='type'>
                        <option value="">CHOOSE CORRECTLY</option>
                        @can('admin:user:suspend')
                            <option value="suspend">Suspend</option>
                        @endcan

                        @can('admin:user:ban')
                            <option value="ban">Ban</option>
                        @endcan
                    </select>
                </div>

                <div class="mb-2">
                    <label class="label-dark" for="">Comment</label>
                    <textarea class="form-textarea-dark" wire:model='comment'></textarea>
                </div>

                <div class="mb-2">
                    <button class="btn bg-background text-white hover:opacity-85" type="submit">Save</button>
                </div>
            </form>
        @endif
    </div>
</div>
