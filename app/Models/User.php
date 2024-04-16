<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_type_users',
        'pid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id_emp', 'pid');
    }

    // العلاقة مع جدول المندوبين
    public function delegate()
    {
//        return $this->hasOne(Delegate::class, 'id_delegate', 'pid');
    }
    public function findUserByType($type)
    {
        switch ($type) {
            case 1:
                return Employee::where('id_emp', $this->pid)->first();
                break;
//            case 2:
//
//                return Delegate::where('id_delegate', $this->pid)->first();
                break;
            default:
                return null;
        }
    }
}
