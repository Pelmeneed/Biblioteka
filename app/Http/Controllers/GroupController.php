<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::orderBy('name')->get();
        return view('readers.groups.index', compact('groups'));
    }

    public function create()
    {
        return view('readers.groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20'
        ]);

        Group::create($request->all());
        return redirect()->route('readers.groups.index')->with('success', 'Группа успешно добавлена');
    }

    public function edit(Group $group)
    {
        return view('readers.groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:20'
        ]);

        $group->update($request->all());
        return redirect()->route('readers.groups.index')->with('success', 'Группа успешно обновлена');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('readers.groups.index')->with('success', 'Группа успешно удалена');
    }
}
