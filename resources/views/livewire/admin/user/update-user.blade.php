<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-navbar shadow">
    <div class="border-b border-gray-200 bg-navbar px-4 py-5 sm:px-6">
        <h3 class="text-base font-semibold">Update User Information</h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
        @can('admin:user:update')

            <form wire:submit="save">
                <div class="mb-2">
                    <label class="label-dark" for="">Display Name</label>
                    <input class="form-text-input-dark" type="text" wire:model="display_name">
                </div>

                <div class="mb-2">
                    <label class="label-dark" for="">Community Rank</label>
                    <input class="form-text-input-dark" type="text" wire:model="community_rank">
                </div>

                @if ($user->status === 2)
                    <div class="mb-2">
                        <label class="label-dark" for="">Member Join Date</label>
                        <input class="form-text-input-dark" type="date" wire:model="became_member_at">
                    </div>
                @endif

                <div class="mb-2">
                    <button class="btn bg-background text-white hover:opacity-85" type="submit">Save</button>
                </div>
            </form>
        @else
            <p>You do not have permissions to update user information. You need the 'admin:user:update' permission.</p>
        @endcan
    </div>
</div>
