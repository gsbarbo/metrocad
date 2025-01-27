<div class="md:col-span-2 lg:col-span-1">
    <div class="text-center">
        <img alt="" class="w-32 h-32 mx-auto rounded-full" src="{{ $user->avatar }}">
        <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
        <p class="mt-3 text-sm">{{ $user->community_rank }}</p>
    </div>
    <ul class="px-3 py-2 mt-3 divide-y">
        <li class="py-3 flex justify-between">
            <p>Status</p>
            <p class="ml-auto text-sm">{{ $user->status_name }}</p>
        </li>
        <li class="py-3 flex justify-between">
            <p>Member since</p>
            <p class="ml-auto text-sm">
                @if ($user->status == 2)
                    {{ $user->became_member_at?->format('M d, Y') ?? 'Date not set' }}
                @else
                    Not a member
                @endif
            </p>
        </li>
        <li class="py-3 flex justify-between">
            <p>Account since</p>
            <p class="ml-auto text-sm">{{ $user->created_at->format('M d, Y') }}</p>
        </li>
        <li class="py-3 flex justify-between">
            <p>Last Action</p>
            <p class="ml-auto text-sm">{{ $user->last_activity }}</p>
        </li>
        <li class="py-3 flex justify-between">
            <p>Last login</p>
            <p class="ml-auto text-sm">{{ $user->last_login_at->format('M d, Y H:i') }}</p>
        </li>
        <li class="py-3 flex justify-between">
            <p class="">Steam Link</p>
            @if ($user->steam_id)
                <p class="font-bold text-green-600">Yes</p>
            @else
                <p class="font-bold text-red-600">No</p>
            @endif
        </li>
        <li class="py-3">
            <p class="text-center">Permissions</p>
        </li>
        <li class="py-3 flex justify-between">
            <p class="">Protected User</p>
            @if ($user->is_protected_user)
                <p class="font-bold text-green-600">Yes</p>
            @else
                <p class="font-bold text-red-600">No</p>
            @endif
        </li>
        <li class="py-3 flex justify-between">
            <p class="">Super User</p>
            @if ($user->is_super_user)
                <p class="font-bold text-green-600">Yes</p>
            @else
                <p class="font-bold text-red-600">No</p>
            @endif
        </li>

        <li class="py-3 flex justify-between">
            <p class="">Owner</p>
            @if ($user->is_owner)
                <p class="font-bold text-green-600">Yes</p>
            @else
                <p class="font-bold text-red-600">No</p>
            @endif
        </li>

        <li class="py-3">
            <p class="text-center">User History</p>
        </li>

        @foreach ($user->history as $history)
            <li>{{ $history->description }}</li>
        @endforeach

    </ul>

    <div>
        History/comments
    </div>

</div>
