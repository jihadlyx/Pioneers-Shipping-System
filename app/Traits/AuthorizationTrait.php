<?php

namespace App\Traits;

use App\Models\MaterialRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait AuthorizationTrait
{
    private function checkCreateRole($page_id) {
        $user = Auth::user();
        switch ($user->id_type_users) {
            case 1:
                $employee = DB::table('Employees')->where('emp_id', $user->pid())->first();
                if (!$employee) {
                    return false;
                }
                $role_id = $employee->role_id;
                break;
            case 2:
                $delegate = DB::table('delivery_men')->where('delivery_id', $user->pid())->first();
                if (!$delegate) {
                    return false;
                }
                $role_id = $delegate->role_id;
                break;
            case 3:
                $customer = DB::table('Customers')->where('customer_id', $user->pid())->first();
                if (!$customer) {
                    return false;
                }
                $role_id = $customer->role_id;
                break;
            default:
                return false;
        }

        // التحقق من صلاحية المواد للمستخدم
        $materialRole = MaterialRole::where('role_id', $role_id)
            ->where('page_id', $page_id)
            ->first();

        if($materialRole->create){
            return true;
        }

        return false;

    }
    private function checkUpdateRole($page_id) {
        $user = Auth::user();
        switch ($user->id_type_users) {
            case 1:
                $employee = DB::table('Employees')->where('emp_id', $user->pid())->first();
                if (!$employee) {
                    return false;
                }
                $role_id = $employee->role_id;
                break;
            case 2:
                $delegate = DB::table('delivery_men')->where('delivery_id', $user->pid())->first();
                if (!$delegate) {
                    return false;
                }
                $role_id = $delegate->role_id;
                break;
            case 3:
                $customer = DB::table('Customers')->where('customer_id', $user->pid())->first();
                if (!$customer) {
                    return false;
                }
                $role_id = $customer->role_id;
                break;
            default:
                return false;
        }

        // التحقق من صلاحية المواد للمستخدم
        $materialRole = MaterialRole::where('role_id', $role_id)
            ->where('page_id', $page_id)
            ->first();

        if($materialRole->update){
            return true;
        }

        return false;

    }
    private function checkDeleteRole($page_id) {
        $user = Auth::user();
        switch ($user->id_type_users) {
            case 1:
                $employee = DB::table('Employees')->where('emp_id', $user->pid())->first();
                if (!$employee) {
                    return false;
                }
                $role_id = $employee->role_id;
                break;
            case 2:
                $delegate = DB::table('delivery_men')->where('delivery_id', $user->pid())->first();
                if (!$delegate) {
                    return false;
                }
                $role_id = $delegate->role_id;
                break;
            case 3:
                $customer = DB::table('Customers')->where('customer_id', $user->pid())->first();
                if (!$customer) {
                    return false;
                }
                $role_id = $customer->role_id;
                break;
            default:
                return false;
        }

        // التحقق من صلاحية المواد للمستخدم
        $materialRole = MaterialRole::where('role_id', $role_id)
            ->where('page_id', $page_id)
            ->first();

        if($materialRole->delete){
            return true;
        }

        return false;

    }

    private function checkShowRole($page_id) {
        $user = Auth::user();
        switch ($user->id_type_users) {
            case 1:
                $employee = DB::table('Employees')->where('emp_id', $user->pid())->first();
                if (!$employee) {
                    return false;
                }
                $role_id = $employee->role_id;
                break;
            case 2:
                $delegate = DB::table('delivery_men')->where('delivery_id', $user->pid())->first();
                if (!$delegate) {
                    return false;
                }
                $role_id = $delegate->role_id;
                break;
            case 3:
                $customer = DB::table('Customers')->where('customer_id', $user->pid())->first();
                if (!$customer) {
                    return false;
                }
                $role_id = $customer->role_id;
                break;
            default:
                return false;
        }

        // التحقق من صلاحية المواد للمستخدم
        $materialRole = MaterialRole::where('role_id', $role_id)
            ->where('page_id', $page_id)
            ->first();

        if($materialRole->show){
            return true;
        }

        return false;

    }
}

