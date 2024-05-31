<?php

namespace App\Http\Middleware;

use App\Models\MaterialRole;
use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckDeletePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $page_id = $request->route('page_id');
            $path = strtolower($request->path());

            $path_page = Page::where('page_id', $page_id)
                ->first();

            if($path_page) {
                if (str_contains($path, $path_page->path)) {
                    return abort(403, "$path not acces2222s" );
                }
            }

            // التحقق من نوع المستخدم
            switch ($user->id_type_users) {
                case 1:
                    $employee = DB::table('Employees')->where('emp_id', $user->pid())->first();
                    if (!$employee) {
                        return abort(403, 'Unauthorized action.1');
                    }
                    $role_id = $employee->role_id;
                    break;
                case 2:
                    $delegate = DB::table('Delegates')->where('delivery_id', $user->pid())->first();
                    if (!$delegate) {
                        return abort(403, 'Unauthorized action.2');
                    }
                    $role_id = $delegate->role_id;
                    break;
                case 3:
                    $customer = DB::table('Customers')->where('customer_id', $user->pid())->first();
                    if (!$customer) {
                        return abort(403, 'Unauthorized action.3');
                    }
                    $role_id = $customer->role_id;
                    break;
                default:
                    return abort(403, 'Unauthorized action.4');
            }

            // التحقق من صلاحية المواد للمستخدم
            $materialRole = MaterialRole::where('role_id', $role_id)
                ->where('page_id', $page_id)
                ->first();



            if (!$materialRole || !$materialRole->delete) {
                return abort(403, "not access" );
            }


            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.6');
        }
    }
}
