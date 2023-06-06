<?php

 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;



    class LoginController extends Controller
    {
        public function __construct()
        {
            $this->middleware('guest')->except('logout');
        }

        public function showLoginForm()
        {
            return view('auth.login');
        }

        public function login(Request $request)
        {
            $this->validate($request, [
                'login' => 'required|string',
                'password' => 'required|min:8',
            ]);
        
            $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
            $credentials = [
                $field => $request->input('login'),
                'password' => $request->input('password'),
            ];
        
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                Log::info('Stored hashed password for user ' . $user->email . ': ' . $user->password);
                // Migrar el carrito de la sesión a la base de datos
                $cartItems = session()->get('cart', []);
                foreach ($cartItems as $item) {
                    $cartItem = CartItem::firstOrCreate(
                        ['user_id' => $user->id, 'productos_id' => $item['id']],
                        ['quantity' => 0]
                    );
                    $cartItem->increment('quantity', $item['quantity']);
                }
        
                session()->forget('cart');
        
                if ($user->role->name === 'admin') {
                    return redirect()->intended(route('admin.dashboard'));
                } else {
                    return redirect()->intended(route('tienda.index'));
                }
            } else {
                Log::info('Auth::attempt failed');
                Log::info('Credentials: ' . json_encode($credentials));
            }
            
        
            return redirect()->back()->withInput($request->only('login', 'remember'))->withErrors(['error' => 'These credentials do not match our records.']);
        }
        
        
        

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }



        //reset contraseña con correo

    public function showLinkRequestForm()
    {
        return view('auth.passwords.password_email');
    }
    

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            $token = Password::createToken($user);
    
            Mail::to($request->email)->send(new ResetPasswordMail($token));
    
            return redirect()->route('tienda.index')->with('status', 'Hemos enviado el enlace de restablecimiento de contraseña a tu correo electrónico!');
        }
    
        return back()->withErrors(['email' => 'No podemos encontrar un usuario con esa dirección de correo electrónico.']);
    }
    
    

    public function showResetForm(Request $request)
    {
        return view('auth.passwords.password_reset', ['token' => $request->route('token')]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required_without:name|email',
            'name' => 'required_without:email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('name', 'email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password // Aquí ya no es necesario usar Hash::make si lo manejas en el modelo
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
    
    
}
