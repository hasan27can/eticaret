<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city'    => 'nullable|string|max:100',
            'password'=> 'nullable|min:8|confirmed',
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'city'    => $request->city,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Profil bilgileriniz başarıyla güncellendi!');
    }
}