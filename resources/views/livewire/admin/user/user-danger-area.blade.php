<div class="divide-y divide-red-200 border-red-700 border-4 overflow-hidden rounded-lg bg-navbar shadow">
    <div class="border-b border-red-200 bg-red-700 px-4 py-5 sm:px-6 flex justify-between items-center">
        <h3 class="text-base font-semibold">Danger Zone</h3>
        <a class="text-white underline flex items-center" href="#">
            Learn More
            <svg class="size-5 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
    <div class="px-4 py-5 sm:p-6 space-y-3">
        <p>This section will allow you to either Retire, Suspend or Ban an user. When
            you SUSPEND a member no member data is deleted. Just restricts access to the CAD. When
            you BAN or RETIRE a member you will remove all their data (Civilians, Vehicles etc).</p>

        @if (get_setting('discord.useRoles.memberRoleId', 0) != 0)
            <p>User access is controlled by Discord Roles. Make sure you remove their role from the Discord server as
                well.</p>
        @endif

        @if ($user->status === \App\Enum\User\UserStatuses::SUSPENDED)
            <p class="bg-red-700 px-3 py-2 rounded-lg">This user is already suspended. You can only ban the member from
                here.</p>
        @endif

        @if ($user->status === \App\Enum\User\UserStatuses::FORMER)
            <p class="bg-red-700 px-3 py-2 rounded-lg">This user is already retired. You can only ban the member from
                here.</p>
        @endif

        @if ($user->status === \App\Enum\User\UserStatuses::BANNED)
            <p class="bg-red-700 px-3 py-2 rounded-lg">This user is already banned.</p>
        @else
            <form class="" wire:submit="save">
                <div class="mb-2">
                    <label class="label-dark" for="">Type</label>
                    <select class="form-select-input-dark" wire:model.lazy='type'>
                        <option value="">CHOOSE CORRECTLY</option>
                        @can('admin:user:ban')
                            <option value="retire">Retire</option>
                        @endcan
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

                <p class="font-bold uppercase mb-2">There is no verification before it happens. Once you click save its
                    done.
                    Double
                    check one more time and make sure this is what you want to do.</p>

                <div class="mb-2 flex justify-between">
                    <button class="btn bg-background text-white hover:opacity-85" type="submit">Save</button>
                    @if ($type === 'ban' || $type === 'retire')
                        <p class="text-red-600 text-lg">User data will be deleted.</p>
                    @endif
                    @if ($type === 'suspend')
                        <p class="text-green-600 text-lg">User data will not be deleted.</p>
                    @endif
                </div>
            </form>
        @endif
    </div>
</div>
