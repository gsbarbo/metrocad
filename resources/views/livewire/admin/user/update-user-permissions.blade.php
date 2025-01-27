<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-navbar shadow">
    <div class="border-b border-gray-200 bg-navbar px-4 py-5 sm:px-6 flex justify-between items-center">
        <h3 class="text-base font-semibold">Override Permissions</h3>
        <a class="text-blue-600 underline" href="#">Learn More</a>
    </div>
    <div class="px-4 py-5 sm:p-6 space-y-4">
        @if (auth()->user()->is_owner || auth()->user()->is_super_user)
            @if (auth()->user()->is_super_user)
                <div class="flex justify-between">
                    <p>Make Protected User</p>
                    <label class="inline-flex items-center me-5 cursor-pointer">
                        <input @checked($is_protected_user) class="sr-only peer" type="checkbox" value=""
                            wire:model.live='is_protected_user'>
                        <div
                            class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                    </label>
                </div>
            @endif
            @if (auth()->user()->is_owner)
                <div class="flex justify-between">
                    <p>Make Super User</p>
                    <label class="inline-flex items-center me-5 cursor-pointer">
                        <input @checked($is_super_user) class="sr-only peer" type="checkbox" value=""
                            wire:model.live='is_super_user'>
                        <div
                            class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                    </label>
                </div>

                @if ($user->id === auth()->user()->id)
                    <p>You are an owner. You can not edit your own owner status. </p>
                @elseif (in_array($user->id, config('metrocad.developer_ids')))
                    <p>This user is a MetroCAD developer. You can not edit their status.</p>
                @else
                    <div class="flex justify-between">
                        <p>Make Owner</p>
                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input @checked($is_owner) class="sr-only peer" type="checkbox" value=""
                                wire:model.live='is_owner'>
                            <div
                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
                        </label>
                    </div>
                @endif
            @endif

            <p class="text-sm"><span class="font-bold">NOTE:</span> This doesn't reflect live on the sidebar. To
                verify the status you can refresh the page. It does update live with the toggle.</p>
            <p class="text-sm"><span class="font-bold">NOTE:</span> Only owners can edit super user statuses.</p>
        @else
            <p>You can not change any permissions for this user.</p>
        @endif
    </div>
</div>
