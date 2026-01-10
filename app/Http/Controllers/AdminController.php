<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        // Check if user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $pendingPosts = Post::with('user')
            ->where('status', 'pending')
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedPosts = Post::with('user')
            ->where('status', 'approved')
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();

        $rejectedPosts = Post::with('user')
            ->where('status', 'rejected')
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingReports = Report::with(['user', 'post'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.index', compact('pendingPosts', 'approvedPosts', 'rejectedPosts', 'pendingReports'));
    }

    public function approve($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $post = Post::findOrFail($id);
        $post->update([
            'status' => 'approved',
            'pesan_admin' => null,
        ]);

        // Create notification
        Notification::create([
            'user_id' => $post->user_id,
            'type' => 'post_approved',
            'title' => 'Postingan Disetujui',
            'message' => 'Postingan Anda "' . $post->judul . '" telah disetujui oleh admin.',
        ]);

        return back()->with('success', 'Postingan berhasil disetujui!');
    }

    public function reject(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'pesan_admin' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'status' => 'rejected',
            'pesan_admin' => $request->pesan_admin,
        ]);

        // Create notification
        Notification::create([
            'user_id' => $post->user_id,
            'type' => 'post_rejected',
            'title' => 'Postingan Ditolak',
            'message' => 'Postingan Anda "' . $post->judul . '" ditolak. Alasan: ' . $request->pesan_admin,
        ]);

        return back()->with('success', 'Postingan berhasil ditolak!');
    }

    public function archive(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $query = Post::with('user')->expired();

        // Filter by year
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('deadline', $request->year);
        }

        // Filter by month
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('deadline', $request->month);
        }

        $archivedPosts = $query->orderBy('deadline', 'desc')->get();

        return view('admin.archive', compact('archivedPosts'));
    }

    public function users()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::where('role', '!=', 'admin')
            ->withCount('posts')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);

        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat menghapus admin!');
        }

        // Delete user's posts and their posters
        foreach ($user->posts as $post) {
            if ($post->poster_path) {
                Storage::disk('public')->delete($post->poster_path);
            }
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }

    public function reports()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $reports = Report::with(['user', 'post'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports', compact('reports'));
    }

    public function resolveReport($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $report = Report::findOrFail($id);
        $report->update(['status' => 'resolved']);

        return back()->with('success', 'Laporan berhasil diselesaikan!');
    }

    public function deletePost($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $post = Post::findOrFail($id);

        // Create notification for post owner
        Notification::create([
            'user_id' => $post->user_id,
            'type' => 'post_deleted',
            'title' => 'Postingan Dihapus',
            'message' => 'Postingan Anda "' . $post->judul . '" telah dihapus oleh admin.',
        ]);

        // Delete poster
        if ($post->poster_path) {
            Storage::disk('public')->delete($post->poster_path);
        }

        $post->delete();

        return back()->with('success', 'Postingan berhasil dihapus!');
    }
}