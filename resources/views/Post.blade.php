@extends('layout.main')
@section('hyasabicontentauncha')

<div class="category-page">

    <!-- ADD CATEGORY FORM -->
    <div class="category-form-card">
        <h2>Create Car Post</h2>
        @if (session('success'))
            <p style="color: green;padding-bottom: 20px;font-weight: bold">{{ session('success') }}</p>
        @endif

        <form action="{{ route('post.create') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <!-- ROW 1 -->
            <div class="post-form-row two-col">
                <div class="form-group">
                    <input
                        type="text"
                        name="post_title"
                        placeholder="Post Title" value="{{ old('post_title') }}"
                    >
                    @error('post_title')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        type="file"
                        name="image"
                    >
                    @error('image')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- ROW 2 -->
            <div class="post-form-row">
                <div class="form-group full-width">
                    <textarea
                        name="post_description"
                        placeholder="Description"
                    >{{ old('post_description') }}</textarea>
                    @error('post_description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- ROW 2 -->
            <div class="post-form-row">
                <div class="form-group full-width">
                    <select name="car_category_id">
                        <option >-- Select Category --</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                        @endforeach
                    </select>
                    @error('car_category_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- BUTTON ROW -->
            <div class="post-form-row button-row">
                <button type="submit">Add Post</button>
            </div>
        </form>
    </div>

    <h2 class="category-title">Post List</h2>
    <!-- CATEGORY LIST -->
    <div class="post-grid">
        @foreach ($posts as $post)
            <div class="post-card">
                <img src="{{ asset('uploads/' . $post->image) }}" alt="category">

                <div class="post-info">
                    <h3>{{ $post->post_title }}</h3>
                    <p class="post-desc">{{ $post->post_description }}</p>
                    <p class="post-meta">
                        <span class="category">{{ $post->category->categoryName }}</span>
                        <span class="date">{{ $post->created_at }}</span>
                    </p>
                    <p class="post-desc" style="padding-top: 10px;"> <span style="font-weight: bold;">Uploaded By:</span>  {{ $post->user->name }}</p>
                    <!-- Like Section -->
                    @auth
                    <div class="like-section" style="padding-top: 15px; display: flex; align-items: center; gap: 10px;">
                        <form action="{{ route('post.like', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="like-btn" style="background: none; border: none; cursor: pointer; padding: 5px; border-radius: 50%;">
                                @if($post->isLikedBy(auth()->user()))
                                    <!-- Filled heart icon for liked state -->
                                    <svg class="heart liked" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="color: #ef4444;">
                                        <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                    </svg>
                                @else
                                    <!-- Outline heart icon for not liked state -->
                                    <svg class="heart" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #6b7280;">
                                        <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                    </svg>
                                @endif
                            </button>
                        </form>
                        <span class="likes-count">{{ $post->likesCount() }}</span>
                        <span style="color: #666; font-size: 14px;">{{ $post->likesCount() == 1 ? 'like' : 'likes' }}</span>
                    </div>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>



</div>

@endsection
