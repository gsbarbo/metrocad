<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-navbar shadow">
    <div class="border-b border-gray-200 bg-navbar px-4 py-5 sm:px-6 flex justify-between items-center">
        <h3 class="text-base font-semibold">Override Permissions</h3>
        <a class="text-white underline flex items-center" href="#">
            Learn More
            <svg class="size-5 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
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
            <p class="text-sm"><span class="font-bold">NOTE:</span> Only owners can edit super user statuses.</p>
        @else
            <p>You can not change any permissions for this user. You need to be an owner or a super user.</p>
        @endif
    </div>
</div>
