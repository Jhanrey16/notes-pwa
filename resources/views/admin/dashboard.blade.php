@extends('layouts.app')

@section('content')
<script src="https://kit.fontawesome.com/9311b9b068.js" crossorigin="anonymous"></script>

<style>
  body {
    background: linear-gradient(180deg, #3a3a3a, #2b2b2b);
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
  }

  .mobile-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    padding: 24px 0;
  }

  .mobile-screen {
    width: 100%;
    max-width: 420px;
    padding: 0 16px;
  }

  .card-glass,
  .card-glasses {
    position: relative;
    background: #3f3f3f;
    border: 1px solid #4b4b4b;
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
  }

  .card-glasses {
    margin-top: 20px;
  }

  .note-card {
    background: #3f3f3f;
    border: 1px solid #4b4b4b;
    border-radius: 14px;
    padding: 16px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.25);
    margin-top: 10px;
  }

  h1, h2, h3, h6, label {
    color: #ffffff;
  }

  p, small {
    color: #cccccc;
  }

  .input-field {
    background: #6a6a6a;
    border: 1px solid #7a7a7a;
    border-radius: 8px;
    color: #ffffff;
    font-size: 14px;
    width: 100%;
    padding: 12px;
    margin-top: 5px;
  }

  .input-field::placeholder {
    color: #e0e0e0;
  }

  .input-field:focus {
    border-color: #d4b24c;
    box-shadow: 0 0 0 2px rgba(212,178,76,0.25);
    outline: none;
  }

  .btn-main {
    background: #8a7a2f;
    border: 1px solid #d4b24c;
    border-radius: 12px;
    color: #ffffff;
    font-weight: 500;
    width: 100%;
    padding: 12px;
    margin-top: 10px;
  }

  .btn-delete {
    background: rgba(239, 68, 68, 0.9);
    border: none;
    border-radius: 8px;
    color: white;
    padding: 6px 12px;
    font-size: 12px;
    margin-top: 5px;
  }

  .logout-inside {
    position: absolute;
    top: 12px;
    right: 12px;
  }

  .btn-logout {
    background: transparent;
    border: 1px solid #d4b24c;
    border-radius: 8px;
    color: #ffffff;
    padding: 6px 10px;
    font-size: 12px;
  }

  .author-badge {
    display: inline-block;
    margin-top: 8px;
    color: #d4b24c;
    font-size: 12px;
  }
</style>

<div class="mobile-wrapper">
  <div class="mobile-screen">

    <div class="card-glass">
      <p class="text-sm">
        Welcome back,
        <span class="font-semibold">{{ auth()->user()->name }}</span>
      </p>

      <h6>
        Hello, {{ auth()->user()->name }}. These are all notes and their authors.
      </h6>

      <form method="POST" action="{{ route('logout') }}" class="logout-inside">
        @csrf
        <button type="submit" class="btn-logout">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </button>
      </form>
    </div>

    <div class="card-glass">
      <h2 class="font-bold mb-4">Create New Note</h2>

      <form method="POST" action="/notes">
        @csrf

        <label class="text-sm">Title</label>
        <input
          name="title"
          placeholder="Give your note a title..."
          class="input-field"
          required
        >

        <label class="text-sm mt-4 block">Content</label>
        <textarea
          name="content"
          placeholder="Write something..."
          class="input-field resize-none"
          rows="4"
          required
        ></textarea>

        <button type="submit" class="btn-main">
          <i class="fa-solid fa-plus"></i>
        </button>
      </form>
    </div>

    <div class="card-glasses">
      <h2 class="font-bold mb-4 text-center">All Notes</h2>

      @if($notes->isEmpty())
        <div class="card-glass text-center">
          <p>No notes yet — create one to get started!</p>
        </div>
      @else
        @foreach($notes as $note)
          <div class="note-card">
            <h3 class="font-semibold text-lg mb-2">
              {{ $note->title }}
            </h3>

            <p class="text-sm mb-3">
              {{ $note->content }}
            </p>

            <small class="author-badge">
              <strong>Author:</strong> {{ $note->user->name ?? 'Unknown User' }}
            </small>

            <div class="d-flex justify-content-end">
              <form method="POST" action="/notes/{{ $note->id }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                  <i class="fa-regular fa-trash-can"></i>
                </button>
              </form>
            </div>
          </div>
        @endforeach
      @endif
    </div>

  </div>
</div>
@endsection