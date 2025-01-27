<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-navbar shadow">
    <div class="border-b border-gray-200 bg-navbar px-4 py-5 sm:px-6">
        <h3 class="text-base font-semibold">Comments</h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
        @can('admin:user:comment:create')
            <form wire:submit="save">
                <div class="mb-2">
                    <label class="label-dark" for="">Comment</label>
                    <textarea class="form-textarea-dark" wire:model='comment'></textarea>
                </div>

                <div class="mb-2">
                    <button class="btn bg-background text-white hover:opacity-85" type="submit">Save</button>
                </div>
            </form>
        @else
            <p>You do not have permissions to leave comments.</p>
        @endcan
    </div>
</div>
