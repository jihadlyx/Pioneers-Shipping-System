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
    private function checkUpdateRole($page_id) {
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

        if($materialRole->update){
            return true;
        }

        return false;

    }
    private function checkDeleteRole($page_id) {
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

        if($materialRole->delete){
            return true;
        }

        return false;

    }

    private function checkShowRole($page_id) {
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

        if($materialRole->show){
            return true;
        }

        return false;

    }
}

