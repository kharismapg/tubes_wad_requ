<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'bookmarks'])
            ->where('status', 'approved');

        // Filter by deadline status
        if ($request->has('status_deadline')) {
            if ($request->status_deadline === 'active') {
                $query->active();
            } elseif ($request->status_deadline === 'expired') {
                $query->expired();
            }
        } else {
            // Default to showing active posts if no status_deadline filter is provided
            $query->active();
        }

        // Filter by category
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Sort by deadline
        $sort = $request->get('sort', 'terdekat');
        if ($sort === 'terdekat') {
            $query->orderBy('deadline', 'asc');
        } else {
            $query->orderBy('deadline', 'desc');
        }

        $posts = $query->paginate(12);

        return view('dashboard', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with(['user', 'bookmarks'])->findOrFail($id);
        
        return view('post.show', compact('post'));
    }
}