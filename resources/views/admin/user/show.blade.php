@extends('layouts.admin')

@section('main')
    <div x-data="{ noteModal: false, accommodationModal: false, daModal: false, communityRankModal: false, rolesModal: false }">
        <div class="flex justify-between items-baseline">
            <h1 class="text-xl font-bold">Manage Members > <span class="font-thin text-lg">{{ $user->preferred_name }}</span>
            </h1>
        </div>

        <div class="grid grid-cols-1 gap-3 pt-5 pb-5 md:grid-cols-2">

            <div class="admin-card">
                <div class="text-center">
                    <img alt="" class="w-32 h-32 mx-auto rounded-full" src="{{ $user->avatar }}">
                    <h2 class="text-xl font-semibold">{{ $user->preferred_name }}</h2>
                    <p class="mt-3 text-sm">{{ $user->community_rank }}</p>
                </div>
                <ul class="px-3 py-2 mt-3 divide-y">
                    <li class="py-3">
                        <p class="flex items-center justify-between">
                            <span>User status</span>
                            @if (!in_array($user->id, config('cad.owner_ids')) || in_array(auth()->user()->id, config('cad.owner_ids')))
                                @can('user_edit_user_status')
                                    <a class="edit-button-sm" href="{{ route('admin.users.status.edit', $user->id) }}">
                                        Edit
                                    </a>
                                @endcan
                            @endif
                        </p>
                        @php
                            switch ($user->status) {
                                case '1':
                                    $text_color = 'text-orange-500';
                                    break;

                                case '2':
                                    $text_color = 'text-yellow-500';
                                    break;

                                case '3':
                                    $text_color = 'text-green-500';
                                    break;

                                case '4':
                                    $text_color = 'text-red-500';
                                    break;

                                case '5':
                                    $text_color = 'text-red-500';
                                    break;

                                case '6':
                                    $text_color = 'text-red-500';
                                    break;

                                default:
                                    $text_color = 'text-red-500';
                                    break;
                            }
                        @endphp
                        <p class="ml-auto text-sm {{ $text_color }}">{{ $user->status_name }}</p>
                    </li>
                    <li class="py-3">
                        <p>Member since</p>
                        <p class="ml-auto text-sm">
                            @if (!is_null($user->became_member_at))
                                {{ $user->became_member_at->format('M d, Y') }}
                            @else
                                Not a member
                            @endif
                        </p>
                    </li>
                    <li class="py-3">
                        <p>Account since</p>
                        <p class="ml-auto text-sm">{{ $user->created_at->format('M d, Y') }}</p>
                    </li>
                    <li class="py-3">
                        <p>Last login</p>
                        <p class="ml-auto text-sm">{{ $user->last_login_at->format('M d, Y H:i') }}</p>
                    </li>

                    {{-- <li class="py-3">
                        <p class="flex items-center justify-between">
                            <span>Roles</span>
                            @if (!get_setting('use_discord_roles'))
                                @can('user_manage_user_roles')
                                    @if ($user->account_status == 3)
                                        <a @click="rolesModal = true" class="edit-button-sm">
                                            <x-edit-button></x-edit-button>
                                        </a>
                                    @endif
                                @endcan
                            @endif

                        </p>
                        @if (get_setting('use_discord_roles'))
                            <p class="text-sm text-black bg-gray-400 cursor-default button-sm">
                                Roles are managed by Discord roles.</p>
                        @else
                            @foreach ($user->roles as $role)
                                <p class="text-sm text-black bg-gray-400 cursor-default button-sm">
                                    {{ $role->title }}</p>
                            @endforeach
                        @endif

                    </li> --}}

                    <li class="flex items-center justify-between">
                        <p class="">Protected User <br>
                            <span class="text-sm italic">Makes it so only super users and owners can view this
                                user. Can only be changed by an owner.</span>
                            <br>
                            @if ($user->is_protected_user)
                                <span class="font-bold text-green-600">Yes</span>
                            @else
                                <span class="font-bold text-red-600">No</span>
                            @endif
                        </p>

                        @can('is_owner_user')
                            @if ($user->account_status == 3)
                                <form action="#" class="block" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button class="edit-button-sm">
                                        Edit
                                    </button>
                                </form>
                            @endif
                        @endcan
                    </li>

                    <li class="flex items-center justify-between">
                        <p class="">Super User <br>
                            <span class="text-sm italic">Makes this user bypass permissions and roles and can access
                                everything by default. Can only be changed by an owner.</span>
                            <br>
                            @if ($user->is_super_user)
                                <span class="font-bold text-green-600">Yes</span>
                            @else
                                <span class="font-bold text-red-600">No</span>
                            @endif
                        </p>

                        @can('is_owner_user')
                            @if ($user->account_status == 3)
                                <form action="#" class="block" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button class="edit-button-sm">
                                        Edit
                                    </button>
                                </form>
                            @endif
                        @endcan
                    </li>

                    <li class="flex items-center justify-between" x-data="{ open_tip: false }">
                        <p class="">Owner <br>
                            @if (in_array($user->id, config('cad.owner_ids')))
                                <span class="font-bold text-green-600">Yes</span>
                            @else
                                <span class="font-bold text-red-600">No</span>
                            @endif
                        </p>
                        <div class="relative inline-block">
                            <a @click="open_tip = true" href="#">
                                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <div @click.outside="open_tip = false"
                                class="absolute z-50 w-56 p-2 text-white bg-black rounded-lg" x-show="open_tip">
                                This is set in the cad config file. See docs for help.
                            </div>
                        </div>
                    </li>
                </ul>

            </div>

            <div class="admin-card">
                <h2 class="mb-4 text-xl font-semibold underline">Quick Admin Options</h2>

                <div class="grid grid-cols-1 gap-4 text-sm xl:grid-cols-2">
                    {{-- <a class="secondary-button-md" href="#">Suspend/LOA User</a>
                    <a class="delete-button-md" href="#">Ban User</a> --}}
                    <a @click="communityRankModal = true" class="secondary-button-md" href="#">Community Rank</a>
                    <a class="secondary-button-md" href="#">Departments</a>
                </div>
            </div>

        </div>

    </div>
@endsection
