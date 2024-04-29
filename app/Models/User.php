<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            case 2:
                return Delegate::where('id_delegate', $this->pid)->first();
            case 3:
//                return
            default:
                return null;
        }
    }

    public function checkShowRole($page_id) {
        $user = Auth::user();
        switch ($user->id_type_users) {
            case 1:
                $employee = DB::table('Employees')->where('id_emp', $user->pid)->first();
                if (!$employee) {
                    return false;
                }
                $role_id = $employee->id_role;
                break;
            case 2:
                $delegate = DB::table('Delegates')->where('id_delegate', $user->pid)->first();
                if (!$delegate) {
                    return false;
                }
                $role_id = $delegate->id_role;
                break;
            case 3:
                $customer = DB::table('Customers')->where('id_customer', $user->pid)->first();
                if (!$customer) {
                    return false;
                }
                $role_id = $customer->id_role;
                break;
            default:
                return false;
        }

        // التحقق من صلاحية المواد للمستخدم
        $materialRole = MaterialRole::where('id_role', $role_id)
            ->where('id_page', $page_id)
            ->first();

        if($materialRole->create){
            return true;
        }

        return false;

    }
}
