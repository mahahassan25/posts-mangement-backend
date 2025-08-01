<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{

    /**
     * Create a new post for the authenticated user or admin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'body' => 'required|string',
            'name' =>  'required|string'
        ]);

        // Get the authenticated user or admin
        $author = Auth::user();

        if (!$author) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Create the post using morph relationship
        $post = $author->posts()->create([
            'title'   => $request->title,
            'body' => $request->body,
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Post created successfully.',
            'post' => $post,
        ], 201);
    }

    /**
     * Get all posts.
     */
    public function index()
    {
        $posts = Post::with('author')->latest()->get();

        return response()->json($posts);
    }

    public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    $request->validate([
        'title' => 'required|string',
        'body' => 'required|string',
    ]);

     $author = Auth::user();

        if (!$author) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    $post->update([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    return response()->json([
        'message' => 'Post updated successfully',
        'post' => $post,
    ]);
}

public function destroy($id)
{
    $post = Post::findOrFail($id);

   $author = Auth::user();

        if (!$author) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    $post->delete();

    return response()->json([
        'message' => 'Post deleted successfully',
    ]);
}


}
