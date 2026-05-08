<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index', [
            'notes' => Auth::user()->notes()->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Auth::user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back();
    }

    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $note->update($validated);

        return back();
    }

    public function destroy(Note $note)
    {
      

        $note->delete();
        return back();
    }

    public function show(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('notes.showNote', compact('note'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        if ($user->role == 1) {
            $notes = Note::with('user')->latest()->get();
            return view('admin.dashboard', compact('notes'));
        }
        $notes = $user->notes;
        return view('notes.index', compact('notes'));
    }
}
