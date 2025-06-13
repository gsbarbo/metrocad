<?php

namespace App\Http\Controllers\Portal\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('portal.user.settings.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }
}
