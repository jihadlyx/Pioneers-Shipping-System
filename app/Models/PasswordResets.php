<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    use HasFactory;
    protected $table = 'password_resets';
    protected $primaryKey = 'email';

    protected $fillable = [
        'email',
        'token',
        'expires_at',
    ];

    public function getUser() {
        return User::where('email', $this->email)->first();
    }
}
