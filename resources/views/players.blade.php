@extends('layout.main')

@section('hyasabicontentauncha')

<div class="category-page">

    <!-- CREATE PLAYER FORM -->
    <div class="category-form-card">
        <h2>Create Player</h2>

   @if (session('success'))
    <p style="color: green; font-weight: bold; margin-bottom: 15px;">
        {{ session('success') }}
    </p>
    @endif


        <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ROW 1 -->
            <div class="post-form-row two-col">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Player Name" value="{{ old('name') }}">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="number" name="age" placeholder="Player Age" value="{{ old('age') }}">
                    @error('age')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- ROW 2 -->
            <div class="post-form-row two-col">
                <div class="form-group">
                    <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
                    @error('address')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="file" name="image">
                    @error('image')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- BUTTON -->
            <div class="post-form-row button-row">
                <button type="submit">Add Player</button>
            </div>
        </form>
    </div>

    <!-- PLAYER LIST -->
    <h2 class="category-title">Players List</h2>

    <div class="post-grid">
        @forelse ($players as $player)
            <div class="post-card">
                <img src="{{ asset('uploads/' . $player->image) }}" alt="Player Image">

                <div class="post-info">
                    <h3>{{ $player->name }}</h3>
                    <p><strong>Age:</strong> {{ $player->age }}</p>
                    <p><strong>Address:</strong> {{ $player->address ?? 'N/A' }}</p>

                    <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="margin-top:10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this player?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p>No players found.</p>
        @endforelse
    </div>

</div>

@endsection
