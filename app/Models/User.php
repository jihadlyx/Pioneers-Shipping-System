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
    protected $primaryKey = "pid";

    protected $fillable = [
        'pid',
        'email',
        'password',
        'emp_id',
        'id_type_users',
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

//    protected $pid();

//    public function __construct(array $attributes = [])
//    {
//        parent::__construct($attributes);
//        $this->pid() = isset($this->attributes['pid()']) ? substr($this->attributes['pid()'], 1) : null;
//    }
    public function employee()
    {
        return $this->hasOne(Employee::class, 'emp_id', 'pid');
    }

    // العلاقة مع جدول المندوبين
    public function delegate()
    {
        return $this->hasOne(DeliveryMen::class, 'delivery_id', 'pid');
    }
    public function customers()
    {
        return $this->hasOne(Customers::class, 'delivery_id', 'pid');
    }
    public function findUserByType($type)
    {
        switch ($type) {
            case 1:
                return Employee::where('emp_id', $this->pid())->first();
            case 2:
                return DeliveryMen::where('delivery_id', $this->pid())->first();
            case 3:
                return Customers::where('customer_id', $this->pid())->first();
            default:
                return null;
        }
    }

    public function checkShowRole($page_id) {

        $user = $this->findUserByType(Auth::user()->id_type_users);

        // التحقق من صلاحية المواد للمستخدم
        $materialRole = MaterialRole::where('role_id', $user->role_id)
            ->where('page_id', $page_id)
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
                return $user->emp_name;
            case 2:
                return $user->delivery_name;
            case 3:
                return $user->customer_name;
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

    public function pid() {
        return isset($this->attributes['pid']) ? substr($this->attributes['pid'], 1) : null;
    }
}
