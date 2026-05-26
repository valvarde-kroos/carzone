@extends('layout.main')
@section('hyasabicontentauncha')

<div class="category-page">

    <!-- ADD CATEGORY FORM -->
    <div class="category-form-card">
        <h2>Add Car Category</h2>
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('category.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <input
                    type="text"
                    name="categoryName"
                    placeholder="Category Name"
                >
                @error('categoryName')
                    <p style="color: red;">{{ $message }}</p>
                @enderror

                <input
                    name="image"
                    type="file"
                >
                @error('image')
                    <p style="color: red;">{{ $message }}</p>
                @enderror

                <button type="submit">Add Category</button>
            </div>
        </form>
    </div>

    <h2 class="category-title">Category List</h2>
    <!-- CATEGORY LIST -->
    <div class="category-grid">

        @foreach ($categories as $category)
            <div class="category-card">
                <img src="{{ asset('uploads/' . $category->image) }}" alt="category">  //uploads/hrag slfuague

                <div class="category-info">
                    <h3>{{ $category->categoryName }}</h3>
                </div>
            </div>
        @endforeach

    </div>

</div>

@endsection
