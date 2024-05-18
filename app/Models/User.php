<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        return $this->hasOne(Delegate::class, 'id_delegate', 'pid');
    }
    public function customers()
    {
        return $this->hasOne(Customers::class, 'id_delegate', 'pid');
    }
    public function findUserByType($type)
    {
        switch ($type) {
            case 1:
                return Employee::where('id_emp', $this->pid)->first();
            case 2:
                return Delegate::where('id_delegate', $this->pid)->first();
            case 3:
                return Customers::where('id_customer', $this->pid)->first();
            default:
                return null;
        }
    }

    public function checkShowRole($page_id) {

        $user = $this->findUserByType(Auth::user()->id_type_users);

        // التحقق من صلاحية المواد للمستخدم
        $materialRole = MaterialRole::where('id_role', $user->id_role)
            ->where('id_page', $page_id)
            ->first();

        if($materialRole->show){
            return true;
        }

        return false;
    }

    public function getName() {
        $type = Auth::user()->id_type_users;
        $user = $this->findUserByType($type);
        switch ($type) {
            case 1:
                return $user->name_emp;
            case 2:
                return $user->name_delegate;
            case 3:
                return $user->name_customer;
            default:
                return null;
        }
    }
    public function getRole() {
        $type = Auth::user()->id_type_users;
        $user = $this->findUserByType($type);
        return $user->role->title;
    }

    public function getToken() {
        $user = PasswordResets::where('email', $this->email)->first();
        return $user->token;
    }
    public function getExpires() {
        $user = PasswordResets::where('email', $this->email)->first();
        return $user->expires_at;
    }
}
