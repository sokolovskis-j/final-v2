<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $blogs = Blog::orderBy('created_at', 'desc')
                ->get();
        } else {
            $blogs = Blog::where('published', true)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('home', compact('blogs'));
    }

    public function add()
    {
        return view('add-blog');
    }

    public function create(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'blog_name' => 'required',
            'main_text' => 'required',
        ]);

        // Create a new blog post instance
        $blog = new Blog();
        $blog->image = $request->file('image')->storePublicly('public/images'); // Save the uploaded image
        $blog->image = str_replace('public/', 'storage/', $blog->image); // Adjust the image path for retrieval
        $blog->blog_name = $request->input('blog_name');
        $blog->main_text = $request->input('main_text');
        $blog->user_id = Auth::id(); // Assuming you have a relationship between blogs and users
    
        if ($request->input('publish') == 1) {
            // Publish the blog post
            $blog->published = true;
            $blog->save();
        } else {
            // Save as a draft
            $blog->published = false;
            $blog->save();
        }    

        // Redirect to the user's dashboard
        return redirect()->route('dashboard')->with('success', 'Blog post saved as draft.');
    }

    public function edit(Blog $blog)
    {
        return view('edit-blog', compact('blog'));
 
    }

    public function update(Request $request, Blog $blog)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'blog_name' => 'required',
            'main_text' => 'required',
        ]);

        // Update the blog post with the new values
        $blog->blog_name = $request->input('blog_name');
        $blog->main_text = $request->input('main_text');

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Delete the old image file
            Storage::delete($blog->image);

            // Save the new uploaded image
            $blog->image = $request->file('image')->storePublicly('public/images');
            $blog->image = str_replace('public/', 'storage/', $blog->image);
        }

        if ($request->input('publish') == 1) {
            // Publish the blog post
            $blog->published = true;
            $blog->save();
        } else {
            // Save as a draft
            $blog->published = false;
            $blog->save();
        }    

        // Save the changes
        $blog->save();

        // Redirect to the blog post page or any other appropriate location
        return redirect()->route('dashboard')->with('success', 'Blog post updated successfully.');
    }

    public function delete(Blog $blog)
    {
        // Delete the blog post
        $blog->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Blog post deleted successfully.');
    }

    public function draft()
    {
        if (Auth::check()) {
            $blogs = Blog::all();
        } else {
            $blogs = Blog::where('published', true)->get();
        }
        
        return view('home', compact('blogs'));
    }




}
