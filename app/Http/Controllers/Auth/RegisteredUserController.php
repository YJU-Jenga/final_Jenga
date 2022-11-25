<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
<<<<<<< HEAD
use \Illuminate\Support\Facades\DB;
=======
>>>>>>> ced5d6b (clean push)
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }
<<<<<<< HEAD
    
    public function up()
    {
        return view('auth.register_update');
    }
=======
>>>>>>> ced5d6b (clean push)

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
<<<<<<< HEAD
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'regex:/[0-9]{3}-[0-9]{4}-[0-9]{4}/'],
=======
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
>>>>>>> ced5d6b (clean push)
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
<<<<<<< HEAD
            'phone' => $request->phone,
=======
>>>>>>> ced5d6b (clean push)
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
<<<<<<< HEAD

    public function update(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'regex:/[0-9]{3}-[0-9]{4}-[0-9]{4}/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
            'name' => $request->name,
            // 'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/mypage');
    }
=======
>>>>>>> ced5d6b (clean push)
}
