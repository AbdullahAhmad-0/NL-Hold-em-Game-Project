<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Payment;
use App\Models\Payment_method;
use App\Models\Payment_withdraw;
use App\Models\Player_rake;
use App\Models\Profile;
use App\Models\User;
use App\Models\User_admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        return redirect('/admin/account');
    }
    public function users()
    {
        $data = User::orderBy('id', 'desc')->paginate(30);
        $data = ['items' => $data];
        return view('admin/users', $data);
    }
    public function users_d($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function users_e($id)
    {
        $user = User::where('id', $id)->first();
        $user->email_verified = 'yes';
        $user->email_token = '';
        $user->save();
        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function users_v($id)
    {
        $data = Profile::where('user_id', $id)->first();
        $data = ['item' => $data];
        return view('admin/profile-view', $data);
    }
    public function profiles()
    {
        $data = Profile::orderBy('id', 'desc')->paginate(30);
        $data = ['items' => $data];
        return view('admin/profiles', $data);
    }
    public function levels()
    {
        $data = Level::orderBy('id', 'desc')->paginate(30);
        $data = ['items' => $data];
        return view('admin/levels', $data);
    }
    public function levels_d($id)
    {
        $item = Level::findOrFail($id);
        $item->delete();
        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function levels_v($id)
    {
        $data = Level::where('id', $id)->first();
        $data = ['item' => $data];
        return view('admin/level-view', $data);
    }
    public function levels_e($id)
    {
        $data = Level::where('id', $id)->first();
        session()->flash('level', $data->level);
        session()->flash('prr_min', $data->prr_min);
        session()->flash('prr_max', $data->prr_max);
        // session()->flash('icon', $data->icon);
        $data = ['id' => $id];
        return view('admin/level-edit', $data);
    }
    public function levels_es($id, Request $request)
    {
        $data = Level::where('id', $id)->first();
        $data->level = $request->input('level');
        $data->prr_min = $request->input('prr_min');
        $data->prr_max = $request->input('prr_max');
        $data->save();
        return redirect('admin/levels');
    }
    public function levels_as(Request $request)
    {
        $data = new Level();
        $data->level = $request->input('level');
        $data->prr_min = $request->input('prr_min');
        $data->prr_max = $request->input('prr_max');
        $data->icon = 'images/demo-level.png';
        $data->save();
        return redirect('admin/levels');
    }
    public function levels_a()
    {
        return view('admin/level-add');
    }
    public function payments()
    {
        $data = Payment::orderBy('id', 'desc')->paginate(30);
        $data = ['items' => $data];
        return view('admin/payments', $data);
    }
    public function payments_d($id)
    {
        $item = Payment::findOrFail($id);
        $item->delete();
        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function payments_a($id)
    {
        $item = Payment::where('id', $id)->first();
        $user_id = $item->user_id;
        $amount = $item->amount;
        $item->approve = 'yes';
        $item->save();

        $profile = Profile::where('user_id', $user_id)->first();
        $profile->coin = (int) $profile->coin + (int) $amount;
        $profile->save();

        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function payments_v($id)
    {
        $data = Payment::where('id', $id)->first();
        $data = ['item' => $data];
        return view('admin/payment-view', $data);
    }
    public function player_rake()
    {
        $data = Player_rake::orderBy('id', 'desc')->paginate(30);
        $data = ['items' => $data];
        return view('admin/player-rake', $data);
    }
    public function player_rake_d($id)
    {
        $item = Player_rake::findOrFail($id);
        $item->delete();
        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function payment_withdraw()
    {
        $data = Payment_withdraw::orderBy('id', 'desc')->paginate(30);
        $data = ['items' => $data];
        return view('admin/payment-withdraw', $data);
    }
    public function payment_withdraw_d($id)
    {
        $item = Payment_withdraw::findOrFail($id);
        $item->delete();
        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function payment_withdraw_a($id)
    {
        $item = Payment_withdraw::where('id', $id)->first();
        $item->status = 'approve';
        $user_id = $item->user_id;
        $amount = $item->amount;
        $item->save();

        $profile = Profile::where('user_id', $user_id)->first();
        $profile->coin = (int) $profile->coin - (int) $amount;
        $profile->save();

        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function payment_withdraw_da($id)
    {
        $item = Payment_withdraw::where('id', $id)->first();
        $item->status = 'disapproved';
        $item->save();
        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function payment_methods()
    {
        $data = Payment_method::orderBy('id', 'desc')->paginate(30);
        $data = ['items' => $data];
        return view('admin/payment_methods', $data);
    }
    public function payment_methods_d($id)
    {
        $item = Payment_method::findOrFail($id);
        $item->delete();
        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash);
    }
    public function payment_methods_v($id)
    {
        $data = Payment_method::where('id', $id)->first();
        $data = ['item' => $data];
        return view('admin/payment_method-view', $data);
    }
    public function payment_methods_vc($id)
    {
        $data = Payment_method::where('name', $id)->first();
        $data = ['item' => $data];
        return view('admin/payment_method-view', $data);
    }
    public function payment_methods_e($id)
    {
        $data = Payment_method::where('id', $id)->first();
        session()->flash('pname', $data->name);
        session()->flash('details', $data->details);
        $data = ['id' => $id];
        return view('admin/payment_methods-edit', $data);
    }
    public function payment_methods_es($id, Request $request)
    {
        $data = Payment_method::where('id', $id)->first();
        $data->name = $request->input('pname');
        $data->details = $request->input('details');
        $data->save();
        return redirect('admin/payment_methods');
    }
    public function payment_methods_adds(Request $request)
    {
        $data = new Payment_method();
        $data->name = $request->input('pname');
        $data->details = $request->input('details');
        $data->save();
        return redirect('admin/payment_methods');
    }
    public function payment_methods_add()
    {
        return view('admin/payment_methods-add');
    }
    public function login(Request $request)
    {
        $user = User_admin::where('email', $request->input('email'))->first();
        try {
            // dd(Hash::make($request->input('password')));
            if ($user->email_verified != 'no') {
                if ($user && Hash::check($request->input('password'), $user->password)) {
                    // Remove Old Session
                    session()->pull('id_a');
                    session()->pull('name_a');
                    session()->pull('email_a');
                    session()->pull('password_a');

                    // Save New Session
                    session()->put('id_a', $user->id);
                    session()->put('name_a', $user->name);
                    session()->put('email_a', $user->email);
                    session()->put('password_a', $request->input('password'));

                    return redirect('/admin');
                } else {
                    return redirect('/login_admin')->with([
                        'error' => 'Invalid credentials',
                        'old_email' => $request->input('email')
                    ]);
                }
            } else {
                return redirect('/login_admin')->with([
                    'error' => 'Verify Your Email',
                    'old_email' => $request->input('email')
                ]);
            }
        } catch (\Exception $e) {
            return redirect('/login_admin')->with([
                'error' => 'Invalid credentials',
                'old_email' => $request->input('email')
            ]);
        }
    }
    public function logout()
    {
        session()->pull('id_a');
        session()->pull('name_a');
        session()->pull('email_a');
        session()->pull('password_a');
        return redirect('/login_admin');
    }
    public function account()
    {
        $data = User_admin::get();
        $data = ['data' => $data];
        return view('admin/account', $data);
    }
    public function save_webdet(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            Config::set('webdet.' . $key, $value);
        }
        $content = '<?php return ' . var_export(config('webdet'), true) . ';';
        File::put(config_path('webdet.php'), $content);

        $urlWithHash = url()->previous();
        return Redirect::to($urlWithHash . '#webdet-btn')->with('success-web', 'Data saved successfully. ');
    }
}
