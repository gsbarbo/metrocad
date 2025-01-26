<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnnouncementRequest;
use App\Models\Announcement;
use App\Models\Department;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();

        return view('admin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('admin.announcement.create', compact('departments'));
    }

    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        Announcement::create($data);

        return redirect()->route('admin.announcement.index')->with('alerts', [['message' => 'Announcement created.', 'level' => 'success']]);
    }

    public function edit(Announcement $announcement)
    {
        $departments = Department::all();

        return view('admin.announcement.edit', compact('departments', 'announcement'));
    }

    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $announcement->update($data);

        return redirect()->route('admin.announcement.index')->with('alerts', [['message' => 'Announcement updated.', 'level' => 'success']]);
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcement.index')->with('alerts', [['message' => 'Announcement deleted.', 'level' => 'success']]);
    }
}
