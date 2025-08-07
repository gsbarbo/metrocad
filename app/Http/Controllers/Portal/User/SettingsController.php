<?php

namespace App\Http\Controllers\Portal\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\DiscordService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit(User $user)
    {
        return view('portal.user.settings.edit', compact('user'));
    }

    public function discordSync()
    {
        DiscordService::discordRoleSync(auth()->user()->id);

        return redirect()->route('portal.user.settings')->with('alerts', [['message' => 'Department Roles Synced.', 'level' => 'success']]);
    }

    public function update(Request $request, User $user)
    {
        //
    }
}
