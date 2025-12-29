<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Post;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function create($postId)
    {
        $post = Post::findOrFail($postId);
        return view('reports.create', compact('post'));
    }

    public function store(Request $request, $postId)
    {
        $request->validate([
            'reason' => 'required|string|min:10',
        ]);

        $post = Post::findOrFail($postId);

        // Check if user already reported this post
        $existingReport = Report::where('user_id', auth()->id())
            ->where('post_id', $postId)
            ->first();

        if ($existingReport) {
            return back()->with('error', 'Anda sudah melaporkan postingan ini!');
        }

        Report::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim ke admin!');
    }
}
