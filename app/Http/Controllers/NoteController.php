<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class NoteController extends Controller
{
  public function login(){
    return view('auth.login');
  }

  public function showRegister()
  {
    return view('auth.register');
  }

  public function register(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|confirmed|min:8',
    ]);

    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect()->route('notes.index');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended(route('notes.index'));
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ])->withInput();
  }
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
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

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
 $notes = Auth::user()->notes;

 return view('notes.index', compact('notes'));
}
 

}
