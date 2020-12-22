<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function allpost() 
    {
        $user = Auth::user();
        $posts = $user->posts()->get();
        return response()->json(['success' => $posts], 200);
    }

    public function addpost()
    {
        $user = Auth::user();
        $title = request('title');
        $desc = request('desc');
        $post = new Post;
        $post->title = $title;
        $post->description = $desc;
        $post->user_id = $user->id;
        $post->save();
        return response()->json([
            'success' => 'post created!',
        ], 201);
    }

    public function delete()
    {
        $id = request('id');
        $post = Post::find($id);
        $post->delete();
        return response()->json([
            'success' => 'post deleted!',
        ], 200);
    }

    public function update()
    {
        $id = request('id');
        $post = Post::find($id);
        $post->update([
            'title' => request('title'),
            'description' => request('desc')
        ]);
        return response()->json([
            'success' => 'post updated!',
        ], 200);
    }
}
