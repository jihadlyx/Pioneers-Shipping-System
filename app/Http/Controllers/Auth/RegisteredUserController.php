<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customers;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $branches = Branch::where('state', 1)->get();
        return view('site.auth.Register.registerView', compact('branches'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'address' => ['required', 'string', 'max:30'],
            'id_branch' => ['required', 'numeric'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,12', 'unique:'.Customers::class],
        ]);

        DB::transaction(function () use ($request) {
            $maxCustomerId = Customers::withTrashed()->max('id_customer') ? Customers::withTrashed()->max('id_customer') + 1 : 1;
            Customers::create([
                'id_customer' => $maxCustomerId,
                'name_customer' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'id_number' => 1,
                'phone_number2' => $request->phone_number2,
                'id_role' => 3,
                'id_branch' => $request->id_branch,
            ]);

            // إنشاء مستخدم
            User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_type_users' => 3,
                'pid' => $maxCustomerId,
                'id_emp' => $maxCustomerId,
            ]);
            $user = User::where('id_type_users', 3)
                ->where('pid', $maxCustomerId)
                ->first();

            event(new Registered($user));

            Auth::login($user);
        });
        return redirect(RouteServiceProvider::HOME);

    } catch (ValidationException $e) {
        return redirect()->route('register');
    }



    }
}
