<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\CarPost;
use App\Http\Controllers\Controller;
use App\Models\CarCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CarPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CarCategory::all();
        $posts = CarPost::where('user_id', '!=', Auth::id())->get();
        //Select * from posts where user_id !=  currectly logged in user id;
        return view('Post', compact('categories', 'posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'post_title' => 'required|string',
            'post_description' => 'required|string',
            'image' => 'required|image|max:2048', //2MB 2048KB
            'car_category_id' => 'required|exists:categoriess,id'
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $filename = Str::slug($request->post_title) . '-post-' . time() . '.' . $request->image->extension(); //mercedes-category-7695346.png
            $request->image->move(public_path('uploads/'), $filename);

            CarPost::create([
                'post_title' => $request->post_title,
                'post_description' => $request->post_description,
                'image' => $filename,
                'category_id' => $request->car_category_id,
                'user_id' => $user->id,
            ]);

            return back()->with('success', 'Post Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarPost $carPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = CarPost::findOrFail($id);  //select * from posts where id= route bata ako id;
        $categories = CarCategory::all();
        return view('edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = CarPost::findOrFail($id);  //current data

        // validation
        $request->validate([
            'post_title' => 'required|string',
            'post_description' => 'required|string',
            'image' => 'nullable|image|max:2048', //2MB 2048KB
            'car_category_id' => 'required|exists:car_categories,id'
        ]);

        // update fields
        $post->post_title = $request->post_title;  // current post title = new title assign gareko
        $post->post_description = $request->post_description;
        $post->car_category_id = $request->car_category_id;

        // update image only if uploaded
        if ($request->hasFile('image')) {

            // deleting old image
            if ($post->image && file_exists(public_path('uploads/' . $post->image))) {
                unlink(public_path('uploads/' . $post->image));
            }

            $filename = Str::slug($request->post_title) . '-post-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/'), $filename);

            $post->image = $filename;
        }

        $post->save();  //update ra create

        return back()
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = CarPost::findOrFail($id);
        $post->delete();
        return back()
            ->with('delete', 'Post deleted successfully!');
    }
    /**
     * Like or unlike a post
     */
    public function toggleLike($id)
    {
        $post = CarPost::findOrFail($id);
        $user = Auth::user();

        // Check if user already liked this post
        $existingLike = Like::where('user_id', $user->id)  // Select * from like where user_id=1 && post_id=2;
            ->where('car_post_id', $post->id)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            flash()->info('Post unliked successfully!');
        } else {
            // Like
            Like::create([
                'user_id' => $user->id,
                'car_post_id' => $post->id
            ]);
            flash()->success('Post liked successfully!');
        }

        return back();
    }
}
