<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\RandomPasswordEmail;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    protected function create(array $data)
    {
        $password = Str::random(10);

        // Generate system_id
        $system_id = User::generateSystemId();

        Mail::to($data['email'])->send(new RandomPasswordEmail(
            $password,
            $system_id,
            $data['name'],
            $data['email'],
            $data['regis__country'],
            $data['regis__university'],
            $data['regis__course'],
            $data['regis__uni__course']
        ));


        // Validate file uploads
        $validator = Validator::make($data, [
            'nid' => 'file',
            'o_level' => 'file',
            'a_level' => 'file',
            'graduate' => 'file',
            'post_graduate' => 'file',
            'photo' => 'file',
            'signature' => 'file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $paths = [];
        $uploadPath = public_path('upload/student');

        foreach (['nid', 'o_level', 'a_level', 'graduate', 'post_graduate', 'photo', 'signature', 'others'] as $field) {
            if (isset($data[$field])) {
                $file = $data[$field];
                $originalFilename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = $field . '_' . time() . '.' . $extension; // Append timestamp to filename
                $file->move($uploadPath, $filename);
                $paths[$field] = $filename;
            }
        }

        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'role_id' => 2,
            'phone' => $data['phone'],
            'email' => $data['email'],
            'is_primium' => $data['is_primium'], // Make sure is_primium is included in $data
            'amount' => $data['amount'] ?? null,
            'method' => $data['method'] ?? null,
            'txt_number' => $data['txt_number'] ?? null,
            'city' => $data['city'],
            // 'country' => $data['country'],
            'regis__country' => $data['regis__country'],
            'regis__university' => $data['regis__university'],
            'regis__program' => $data['regis__program'],
            'regis__course' => $data['regis__course'],
            'regis__uni__course' => $data['regis__uni__course'],
            'system_id' => User::generateSystemId(),
            'password' => Hash::make($password),
            'nid' => $paths['nid'] ?? null,
            'o_level' => $paths['o_level'] ?? null,
            'a_level' => $paths['a_level'] ?? null,
            'graduate' => $paths['graduate'] ?? null,
            'post_graduate' => $paths['post_graduate'] ?? null,
            'photo' => $paths['photo'] ?? null,
            'signature' => $paths['signature'] ?? null,
            'others' => $paths['others'] ?? null,
        ]);

        return $user;
    }


    protected function registered(Request $request, $user)
    {
        // Logout any existing user
        Auth::logout();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful. Check your email for login credentials.');
    }
}
