<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'kategori',
        'poster_path',
        'deadline',
        'status',
        'link_pendaftaran',
        'pesan_admin',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Helper methods
    public function isBookmarkedBy($userId)
    {
        return $this->bookmarks()->where('user_id', $userId)->exists();
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
