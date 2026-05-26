@extends('layout.main')
@section('hyasabicontentauncha')

<div class="profile-wrapper">
    <div class="profile-card">
        <div class="profile-avatar">
            <img src="" alt="Profile">
        </div>

        <h3 class="profile-name">{{ $user->name }}</h3>
        <p class="profile-email">{{ $user->email }}</p>

        <p class="profile-posts">
            Total Posts: <strong>{{ $user->carPosts->count() }}</strong>
        </p>
    </div>
</div>

<h2 class="category-title">My Posts</h2>

@if (session('delete'))
            <p style="color: red;padding-bottom: 20px;font-weight: bold">{{ session('delete') }}</p>
        @endif

<div class="my-post-grid">
    @forelse ($posts as $post)
        <div class="post-card">
            <img src="{{ asset('uploads/' . $post->image) }}" alt="post">

            <div class="post-info">
                <h3>{{ $post->post_title }}</h3>
                <p class="post-desc">{{ $post->post_description }}</p>
                <p class="post-meta">
                    <span class="category">{{ $post->category->categoryName }}</span>
                    <span class="date">{{ $post->created_at->format('d M Y') }}</span>
                </p>
            </div>
            <div class="post-actions">
                <a href="{{ route('editForm', $post->id) }}" class="edit-btn">Edit</a>

                <form action="{{ route('postDelete' , $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">
                        Delete
                    </button>
                </form>
            </div>

        </div>
    @empty
        <p style="text-align:center;">You haven’t posted anything yet.</p>
    @endforelse
</div>

@endsection
