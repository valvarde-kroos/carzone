@extends('layouts.main')
@section('hyasabicontentauncha')

<div class="category-page">

    <!-- ADD CATEGORY FORM -->
    <div class="category-form-card">
        <h2>Edit Car Post</h2>
        @if (session('success'))
            <p style="color: green;padding-bottom: 20px;font-weight: bold">{{ session('success') }}</p>
        @endif

        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- ROW 1 -->
            <div class="post-form-row two-col">
                <div class="form-group">
                    <input
                        type="text"
                        name="post_title"
                        placeholder="Post Title" value="{{ $post->post_title }}"

                    >
                    @error('post_title')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                    <div class="form-group ">
                        <select name="car_category_id">
                            {{-- @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('car_category_id', $post->car_category_id) == $category->id ? 'selected' : '' }}>{{ $category->categoryName }}</option>
                            @endforeach --}}

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->car_category_id == $category->id ? 'selected': ''}}>{{ $category->categoryName }}</option>
                            @endforeach
                            {{-- terenary operator  - condition  ? 'run this while true' : 'run this while false' --}}
                        </select>
                        @error('car_category_id')
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
                    >{{ $post->post_description }}</textarea>
                    @error('post_description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- ROW 2 -->
            <div class="post-form-row">
                <div class="form-group full-width">
                    <div class="form-group">
                        <label style="color: black; font-weight: bold;">Current Image</label>
                        <img src="{{ asset('uploads/' . $post->image) }}" style="margin-top:2px;border-radius:6px;border:1px solid #ddd;" width="190">
                    </div>
                    <div class="form-group">
                        <label style="color: black; font-weight: bold;">Choose New Image</label>
                        <input
                            type="file"
                            name="image"
                        >
                        @error('image')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- BUTTON ROW -->
            <div class="post-form-row button-row">
                <button type="submit">Add Post</button>
            </div>
        </form>
    </div>
</div>

@endsection
