<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::with('user')
            ->where('user_id', Auth::user()->id)
            ->orderBy('is_pin', 'DESC')
            ->get();
        // $notes = User::with('note')
        //     ->where('id', Auth::user()->id)
        //     ->get();
        // dd($notes->toArray());
        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        // dd($request->all(),config('custom.PATH'), Auth::user()->id);

        $message = 'updated';

        $id = $request->id;
        $notes = new \Note();

        if ($id != '') {
            $notes = \Note::FindOrFail($id);
        }
        if ($id == null) {
            $message = config('custom.ADDED_SUCCESFULL');
        }
        $notes->title = $request->title;
        $notes->description = $request->description;
        $notes->user_id = Auth::user()->id;
        // $notes->save();
        //store the image if requested
        if (request()->hasFile('image')) {
            if (!empty($note->image)) {
                $file = $note->image;
                @unlink(config('custom.PATH') . $file);
            }
            $file = request()->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            $file->move(config('custom.PATH'), $fileName);
            $notes->image = $fileName;
        }
        $notes->save();
        return redirect(route('notes.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(\Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\Note $note)
    {
        // dd($note->toArray());

        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, \Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($note->toArray());

        $note = \Note::FindOrFail($id);
        $file = $note->image;
        $filename = storage_path(config('custom.PATH')) . $file;

        if (file_exists($filename)) {
            @unlink($filename);
        }
        $note->delete();
        return 'delete';
    }
    public function pin($id)
    {
        // dd($id);
        $note = \Note::find($id);
        $note->is_pin = 1;
        $note->save();
        return true;
    }

    public function unpin($id)
    {
        // dd($id);
        $note = \Note::find($id);
        $note->is_pin = null;
        $note->save();
        return true;
    }
}
