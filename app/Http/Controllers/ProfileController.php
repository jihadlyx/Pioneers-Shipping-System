<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index () {
        $user = Auth()->user()->findUserByType(auth()->user()->id_type_users);
//        if(auth()->user()->id_type_users == 1) {
//            $name = $user->emp_name;
//        } elseif(auth()->user()->id_type_users == 2) {
//            $name = $user->name_delegate;
//        } else {
//            $name = $user->name_customer;
//        }
        $name = Auth()->user()->getName();
        return view('site.Profile.profileView', compact('user', 'name'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
//        return view('profile.edit', [
//            'user' => $request->user(),
//        ]);
        return view();

    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255', 'min:2'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['nullable'],
                'address' => ['required', 'string', 'max:30'],
                'phone_number' => ['required', 'numeric', 'digits_between:10,12'],
                'phone_number2' => ['nullable', 'numeric'] ,
            ]);
            $user = Auth()->user()->findUserByType(auth()->user()->id_type_users);
            if(auth()->user()->id_type_users == 1) {
                $user->update([
                    'emp_name' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'phone_number2' => $request->phone_number2,
                ]);
            } elseif(auth()->user()->id_type_users == 2) {
                $user->update([
                    'delivery_name' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'phone_number2' => $request->phone_number2,
                ]);
            } else {
                $user->update([
                    'customer_name' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'phone_number2' => $request->phone_number2,
                ]);
            }
            $user = Auth()->user();
            $user->update([
                'email' => $request->email,
            ]);
            if($request->password){
                if(Hash::make($request->password) != $user->password){
                    $user->password = Hash::make($request->password);
                    $user->save();
                }
            }

            return redirect()->route('profile.index')
                ->with([
                    "message" => [
                        "type" => "success",
                        "title" => "نجحت العملية",
                        "text" => "تم تحديث بياناتك"
                    ]
                ]);
        } catch (ValidationException $e) {
            return redirect()->route('profile.index')
                ->with([
                    "message" => [
                        "type" => "error",
                        "title" => "فشلت العملية",
                        "text" => "يوجد خطأ في عملية ادخال البيانات يرجى التأكد البيانات"
                    ]
                ]);
        }

//        $request->user()->fill($request->validated());
//
//        if ($request->user()->isDirty('email')) {
//            $request->user()->email_verified_at = null;
//        }
//
//        $request->user()->save();
//
//        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
