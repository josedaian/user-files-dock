<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name'
    ];

    public function files(){
        return $this->hasMany(UserFile::class);
    }

    public static function withOrderedFiles(): Builder{
        return User::with([
            'files' => fn($query) => $query->orderBy('created_at', 'asc')->orderBy('file_name', 'asc')
        ]);
    }
}
