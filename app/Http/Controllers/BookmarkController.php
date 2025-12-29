<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle($postId)
    {
        $user = auth()->user();
        $post = Post::findOrFail($postId);

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('post_id', $postId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Bookmark dihapus!');
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);
            return back()->with('success', 'Bookmark ditambahkan!');
        }
    }

    public function index()
    {
        $bookmarks = auth()->user()->bookmarks()
            ->with('user')
            ->where('status', 'approved')
            ->orderBy('deadline', 'asc')
            ->get();

        return view('bookmarks.index', compact('bookmarks'));
    }
}