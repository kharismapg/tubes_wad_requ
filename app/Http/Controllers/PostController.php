<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:Kepanitiaan,Organisasi,Laboratorium,Seminar,Lomba,Event Kampus',
            'deadline' => 'required|date|after:today',
            'link_pendaftaran' => 'required|url',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload poster
        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        $post = Post::create([
            'user_id' => auth()->id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'kategori' => $validated['kategori'],
            'deadline' => $validated['deadline'],
            'link_pendaftaran' => $validated['link_pendaftaran'],
            'poster_path' => $posterPath,
            'status' => 'pending',
        ]);

        return redirect()->route('post.my-posts')->with('success', 'Postingan berhasil dibuat dan menunggu persetujuan admin!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Check authorization
        if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Check authorization
        if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:Kepanitiaan,Organisasi,Laboratorium,Seminar,Lomba,Event Kampus',
            'deadline' => 'required|date|after:today',
            'link_pendaftaran' => 'required|url',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload new poster if provided
        if ($request->hasFile('poster')) {
            // Delete old poster
            if ($post->poster_path) {
                Storage::disk('public')->delete($post->poster_path);
            }
            $validated['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        // Reset status to pending if content changed
        $validated['status'] = 'pending';
        $validated['pesan_admin'] = null;

        $post->update($validated);

        return redirect()->route('post.my-posts')->with('success', 'Postingan berhasil diupdate dan menunggu persetujuan admin!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Check authorization
        if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete poster
        if ($post->poster_path) {
            Storage::disk('public')->delete($post->poster_path);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Postingan berhasil dihapus!');
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('post.my-posts', compact('posts'));
    }

    public function archive()
    {
        $posts = Post::where('user_id', auth()->id())
            ->where('deadline', '<', now())
            ->orderBy('deadline', 'desc')
            ->get();

        return view('post.archive', compact('posts'));
    }
}