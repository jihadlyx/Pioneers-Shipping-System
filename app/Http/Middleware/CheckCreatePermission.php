<?php

namespace App\Http\Middleware;

use App\Models\MaterialRole;
use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckCreatePermission
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

            $path_page = Page::where('id_page', $page_id)
                ->first();
            if($path_page) {
                if (str_contains($path, $path_page->path)) {
                    return abort(403, "$path not path" );
                }
            }

            // التحقق من نوع المستخدم
            switch ($user->id_type_users) {
                case 1:
                    $employee = DB::table('Employees')->where('id_emp', $user->pid)->first();
                    if (!$employee) {
                        return abort(403, 'Unauthorized action.1');
                    }
                    $role_id = $employee->id_role;
                    break;
                case 2:
                    $delegate = DB::table('Delegates')->where('id_delegate', $user->pid)->first();
                    if (!$delegate) {
                        return abort(403, 'Unauthorized action.2');
                    }
                    $role_id = $delegate->id_role;
                    break;
                case 3:
                    $customer = DB::table('Customers')->where('id_customer', $user->pid)->first();
                    if (!$customer) {
                        return abort(403, 'Unauthorized action.3');
                    }
                    $role_id = $customer->id_role;
                    break;
                default:
                    return abort(403, 'Unauthorized action.4');
            }

            // التحقق من صلاحية المواد للمستخدم
            $materialRole = MaterialRole::where('id_role', $role_id)
                ->where('id_page', $page_id)
                ->first();



            if (!$materialRole || !$materialRole->create) {
                return abort(403, "$path  access 33" );
            }


            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.6');
        }
    }
}
