<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Tampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Validasi input
    protected function validator(array $data)
    {
        $rules = [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        // Tambah validasi captcha kalau bukan di local
        if (!app()->environment('local')) {
            $rules['g-recaptcha-response'] = ['required'];
        }

        return Validator::make($data, $rules);
    }

    // Simpan data user baru
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'masyarakat',
        ]);
    }

    // Proses register
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Verifikasi reCAPTCHA hanya di production
        if (!app()->environment('local')) {
            $captcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
            ]);

            if (!$captcha->json()['success']) {
                return back()->withErrors(['captcha' => 'Captcha tidak valid, silakan coba lagi.'])->withInput();
            }
        }

        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
