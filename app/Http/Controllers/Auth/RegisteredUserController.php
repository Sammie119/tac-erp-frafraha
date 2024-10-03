<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\VWUser;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;

class RegisteredUserController extends Controller
{
    public function index()
    {
        if(get_logged_in_user_id() === 1){
            $data['users'] = VWUser::orderBy('staff_name')->get();//paginate(30);
        } else {
            $data['users'] = VWUser::where('division', get_logged_user_division_id())->orderBy('staff_name')->get();//paginate(30);
        }
        return view('system_admin.users', $data);
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd(get_logged_in_user_id());
        $request->validate([
            'staff_id' => ['required', 'integer', 'unique:'.User::class],
            'division' => ['nullable', 'integer'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'staff_id' => $request->staff_id,
            'division' => (get_logged_in_user_id() === 1) ? $request->division : get_logged_user_division_id(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('users', absolute: false))->with('success', 'User Created Successfully!!!');
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'staff_id' => ['required', 'integer', 'unique:users,staff_id,'.$request->id],
            'division' => ['nullable', 'integer'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$request->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
//         dd($request->all());
        $user = User::find($request->id);

        if(empty($request['password'])){
            $user->update([
                'staff_id' => $request->staff_id,
                'division' => (get_logged_in_user_id() === 1) ? $request->division : get_logged_user_division_id(),
                'email' => $request->email,
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        } else {
            $user->update([
                'staff_id' => $request->staff_id,
                'division' => (get_logged_in_user_id() === 1) ? $request->division : get_logged_user_division_id(),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'updated_by_id' => get_logged_in_user_id(),
            ]);
        }

        return redirect(route('users', absolute: false))->with('success', 'User Updated Successfully!!!');
    }

    public function userRoles(Request $request)
    {
//        dd($request->all());
        $user = User::find($request->id);
        $user->syncRoles($request->roles);

        return redirect(route('users', absolute: false))->with('success', 'User Permissions Added Successfully!!!');
    }

    public function destroy(Request $request)
    {
        // dd($request->id);
        DB::table('model_has_roles')->where('model_id', $request->id)->delete();
        User::find($request->id)->delete();

        return redirect(route('users', absolute: false))->with('success', 'User deleted Successfully!!!');
    }
}
