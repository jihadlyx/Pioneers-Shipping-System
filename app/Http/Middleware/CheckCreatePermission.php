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

            $path_page = Page::where('page_id', $page_id)
                ->first();
            if($path_page) {
                if (str_contains($path, $path_page->path)) {
                    $msg = "403, ليس لديك صلاحية الوصول لهذه الصفحة";
                    return redirect()->route('site.Pages.errorView', compact('msg'));
                }
            }

            // التحقق من نوع المستخدم
            switch ($user->id_type_users) {
                case 1:
                    $employee = DB::table('Employees')->where('emp_id', $user->pid())->first();
                    if (!$employee) {
                        $msg = "403, إجراء غير مصرح به 1";
                        return redirect()->route('site.Pages.errorView', compact('msg'));
                    }
                    $role_id = $employee->role_id;
                    break;
                case 2:
                    $delegate = DB::table('delivery_men')->where('delivery_id', $user->pid())->first();
                    if (!$delegate) {
                        $msg = "403, إجراء غير مصرح به 2";
                        return redirect()->route('site.Pages.errorView', compact('msg'));
                    }
                    $role_id = $delegate->role_id;
                    break;
                case 3:
                    $customer = DB::table('Customers')->where('customer_id', $user->pid())->first();
                    if (!$customer) {
                        $msg = "403, إجراء غير مصرح به 3";
                        return redirect()->route('site.Pages.errorView', compact('msg'));
                    }
                    $role_id = $customer->role_id;
                    break;
                default:
                    $msg = "403, إجراء غير مصرح به 4";
                    return redirect()->route('site.Pages.errorView', compact('msg'));
            }

            // التحقق من صلاحية المواد للمستخدم
            $materialRole = MaterialRole::where('role_id', $role_id)
                ->where('page_id', $page_id)
                ->first();



            if (!$materialRole || !$materialRole->create) {
                $msg = "403, ليس لديك صلاحية الوصول لهذه الصفحة";
                return redirect()->route('site.Pages.errorView', compact('msg'));
            }


            return $next($request);
        } else {
            $msg = "403, إجراء غير مصرح به 6";
            return redirect()->route('site.Pages.errorView', compact('msg'));
        }
    }
}
