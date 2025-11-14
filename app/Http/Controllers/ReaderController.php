<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use App\Models\Group;
use Illuminate\Http\Request;

class ReaderController extends Controller
{

    public function index()
    {
        $readers = Reader::with('group')->orderBy('lastname')->get();
        return view('readers.readers.index', compact('readers'));
    }


    public function create()
    {
        $groups = Group::orderBy('name')->get();
        return view('readers.readers.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|max:100',
            'firstname' => 'required|string|max:100',
            'patronymic' => 'nullable|string|max:100',
            'type_of_reader' => 'required|in:teacher,student,other',
            'group_id' => 'nullable|required_if:type_of_reader,student|exists:groups,id',
            'can_get_books' => 'boolean'
        ]);

        $data = $request->all();
        $data['can_get_books'] = $request->has('can_get_books');

        Reader::create($data);
        return redirect()->route('readers.readers.index')->with('success', 'Читатель успешно добавлен');
    }

    public function edit(Reader $reader)
    {
        $groups = Group::orderBy('name')->get();
        return view('readers.readers.edit', compact('reader', 'groups'));
    }


    public function update(Request $request, Reader $reader)
    {
        $request->validate([
            'lastname' => 'required|string|max:100',
            'firstname' => 'required|string|max:100',
            'patronymic' => 'nullable|string|max:100',
            'type_of_reader' => 'required|in:teacher,student,other',
            'group_id' => 'nullable|required_if:type_of_reader,student|exists:groups,id',
            'can_get_books' => 'boolean'
        ]);

        $data = $request->all();
        $data['can_get_books'] = $request->has('can_get_books');


        if ($data['type_of_reader'] !== 'student') {
            $data['group_id'] = null;
        }

        $reader->update($data);
        return redirect()->route('readers.readers.index')->with('success', 'Данные читателя успешно обновлены');
    }


    public function destroy(Reader $reader)
    {
        $reader->delete();
        return redirect()->route('readers.readers.index')->with('success', 'Читатель успешно удален');
    }
}
