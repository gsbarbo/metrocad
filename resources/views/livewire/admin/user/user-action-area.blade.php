<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-navbar shadow">
    <div class="border-b border-gray-200 bg-navbar px-4 py-5 sm:px-6">
        <h3 class="text-base font-semibold">Quick Action</h3>
    </div>
    <div class="px-4 py-5 sm:p-6 space-y-2 divide-y-2">
        @if ($user->status === \App\Enum\User\UserStatuses::PENDING)
            @if (get_setting('discord_auto_role_id', 0) != 0 && get_setting('feature_use_discord_roles'))
                <p>User access is controlled by Discord Roles. You must assign them the correct role in the Discord
                    server.</p>
            @else
                @can('admin:user:approve')
                    <div class="">
                        <h2 class="text-lg">Approve User</h2>
                        <p>You can either approve this user's account access or deny access. You must include a
                            comment.</p>
                        <label class="label-dark" for="">Comment</label>
                        <textarea class="form-textarea-dark" wire:model='comment'></textarea>
                        <a class="btn bg-green-600 text-white hover:opacity-85 mt-2 inline-block"
                           wire:click='approve_member'>Approve
                            User</a>
                        <a class="btn bg-red-600 text-white hover:opacity-85 mt-2 inline-block"
                           wire:click='deny_member'>Deny
                            User</a>
                    </div>
                @endcan
            @endif
        @endif

        @if ($user->status === \App\Enum\User\UserStatuses::SUSPENDED)
            @if (get_setting('discord_suspended_role_id', 0) != 0 && get_setting('feature_use_discord_roles'))
                <p>User access is controlled by Discord Roles. You must remove the suspend role in the Discord server.
                </p>
            @else
                @can('admin:user:unsuspend')
                    <div class="">
                        <h2 class="text-lg">Unsuspend Member</h2>
                        <p>You can see why this user is suspended in the History section. You must include a
                            comment.</p>
                        <label class="label-dark" for="">Comment</label>
                        <textarea class="form-textarea-dark" wire:model='comment'></textarea>
                        <a class="btn bg-background text-white hover:opacity-85 mt-2 inline-block"
                           wire:click='unsuspend'>Unsuspend
                            Member</a>
                    </div>
                @endcan
            @endif
        @endif

        @if ($user->status === \App\Enum\User\UserStatuses::BANNED)
            @can('admin:user:unban')
                <div class="">
                    <h2 class="text-lg">Unban User</h2>
                    <p>You can see why this member is banned in the History section. This doesn't replace any user data.
                        They will go back to "User" status to be reaccepted. You must include a comment.</p>
                    <label class="label-dark" for="">Comment</label>
                    <textarea class="form-textarea-dark" wire:model='comment'></textarea>
                    <a class="btn bg-background text-white hover:opacity-85 mt-2 inline-block" wire:click='unban'>Unban
                        User</a>
                </div>
            @endcan
        @endif

        @if ($user->status === \App\Enum\User\UserStatuses::FORMER || $user->status === \App\Enum\User\UserStatuses::DENIED)
            @can('admin:user:status:reset')
                <div class="">
                    <h2 class="text-lg">Reset User</h2>
                    <p>This is only to be used to take a member from Denied or Former Member status to Pending User
                        status.
                    </p>
                    <label class="label-dark" for="">Comment</label>
                    <textarea class="form-textarea-dark" wire:model='comment'></textarea>
                    <a class="btn bg-background text-white hover:opacity-85 mt-2 inline-block" wire:click='reset_user'>Reset
                        User</a>
                </div>
            @endcan
        @endif

        @if ($user->status === \App\Enum\User\UserStatuses::MEMBER)
            <div class="">
                <a class="btn btn-md btn-primary btn-pill"
                   href="{{ route('admin.user.userDepartments.index', $user->id) }}">Manage
                    Departments</a>
                <a class="btn btn-md btn-blue btn-pill"
                   wire:click="discordRoleSync">Sync Discord Roles</a>
            </div>
        @endif
    </div>
</div>
