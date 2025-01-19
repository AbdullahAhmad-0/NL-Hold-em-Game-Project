<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Level;
use App\Models\Payment;
use App\Models\Payment_method;
use App\Models\Payment_withdraw;
use App\Models\Player_rake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Jobs\CheckUserStatus;
use Illuminate\Support\Facades\Queue;
use Carbon\Carbon;

class GameController extends Controller
{
    public function sign_up()
    {
        return view('game/sign/sign-up');
    }
    public function sign_up_save(Request $request)
    {
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email|max:400|unique:users,email',
            'password' => 'required|min:8|max:100|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-zA-Z0-9]).*$/',
        ];

        $messages = [
            'name.required' => 'Please enter your full name.',
            'name.max' => 'Your full name must not exceed :max characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Your email address must not exceed :max characters.',
            'email.unique' => 'An account with this email address already exists.',
            'password.required' => 'Please enter a password.',
            'password.max' => 'Your password must not exceed :max characters.',
            'password.min' => 'Your password must be at least :min characters.',
            'password.regex' => 'Your password must include at least one uppercase letter and one numeric character.',
        ];

        $this->validate($request, $rules, $messages);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        // dd(Hash::make($request->input('password')));
        $user->save();

        // Split the full name into first name and last name
        $name_parts = explode(" ", $request->input('name'));
        $first_name = $name_parts[0];
        try {
            $last_name = $name_parts[1];
        } catch (\Exception $e) {
        }
        // Create a new profile record
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->prr = '1';
        $profile->coin = config('webdet.on_start_coin');
        $profile->chips = config('webdet.on_start_chips');
        $profile->save();

        return redirect('/game/sign-in');
    }
    public function sign_in()
    {
        return view('/game/sign/sign-in');
    }
    public function sign_in_check(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        try {
            if ($user->email_verified != 'no') {
                if ($user && Hash::check($request->input('password'), $user->password)) {
                    // Remove Old Session
                    session()->pull('id');
                    session()->pull('name');
                    session()->pull('email');
                    session()->pull('password');

                    // Save New Session
                    session()->put('id', $user->id);
                    session()->put('name', $user->name);
                    session()->put('email', $user->email);
                    session()->put('password', $request->input('password'));

                    return redirect('/game/welcome');
                } else {
                    return redirect('/game/sign-in')->with([
                        'error' => 'Invalid credentials',
                        'old_email' => $request->input('email')
                    ]);
                }
            } else {
                return redirect('/game/sign-in')->with([
                    'error' => 'Verify Your Email',
                    'old_email' => $request->input('email')
                ]);
            }
        } catch (\Exception $e) {
            return redirect('/game/sign-in')->with([
                'error' => 'Invalid credentials',
                'old_email' => $request->input('email')
            ]);
        }
    }

    public function welcome()
    {
        return view('game.sign.welcome', ['name' => session('name')]);
    }

    public function main()
    {
        $profile = Profile::where('user_id', session('id'))->get();
        $user_prr = $profile[0]['prr'];
        $level = Level::where('prr_min', '<=', (int) $user_prr)
            ->where(function ($query) use ($user_prr) {
                $query->where('prr_max', '>=', (int) $user_prr)
                    ->orWhere('prr_max', '=', 0);
            })
            ->get();
        return view('game.main.main', ['profile' => $profile, 'level' => $level]);
    }
    public function profile()
    {
        $profiles = Profile::get();
        $profile = Profile::where('user_id', session('id'))->get();
        $user_prr = $profile[0]['prr'];
        $level = Level::where('prr_min', '<=', (int) $user_prr)
            ->where(function ($query) use ($user_prr) {
                $query->where('prr_max', '>=', (int) $user_prr)
                    ->orWhere('prr_max', '=', 0);
            })
            ->get();
        return view('game.main.profile', ['profile' => $profile, 'level' => $level, 'profiles' => $profiles]);
    }
    public function history()
    {
        $profile = Profile::where('user_id', session('id'))->get();
        return view('game.main.game-history', ['profile' => $profile]);
    }
    public function friends()
    {
        $profile = Profile::where('user_id', session('id'))->get();
        return view('game.main.friends', ['profile' => $profile]);
    }
    public function friends_q(Request $request)
    {
        $profile = Profile::where('user_id', session('id'))->get();
        $items = json_decode($profile[0]->friends, true);
        $searchTerm = $request->search;

        if ($items !== null && !empty($searchTerm)) {
            $filteredItems = array_filter($items, function ($row) use ($searchTerm) {
                foreach ($row as $value) {
                    if (stripos($value, $searchTerm) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }

        if (!empty($filteredItems)) {
            return view('game.main.friends', ['profile' => $profile, 'items' => $filteredItems]);
        } else {
            return view('game.main.friends', ['profile' => $profile]);
        }
    }
    public function friends_add($id)
    {
        $profile = Profile::where('user_id', $id)->first();

        if ((int) session('id') == (int) $profile->user_id) {
            return back();
        } else {
            $newFriend = [
                'id' => $profile->user_id,
                'name' => $profile->user->name,
                'prr' => $profile->prr
            ];
            $newFriend_ = [
                'id' => session('id'),
                'name' => $profile->user->name,
                'prr' => $profile->prr
            ];

            $profile = Profile::where('user_id', $id)->first();
            $originalProfileFriends = json_decode($profile->friends, true);
            $originalProfileFriends[] = $newFriend_;
            $ids = array_column($originalProfileFriends, 'id');
            $uniqueIds = array_unique($ids);
            $originalProfileFriends = array_intersect_key($originalProfileFriends, $uniqueIds);
            $profile->friends = json_encode($originalProfileFriends);
            $profile->save();

            $currentProfile = Profile::where('user_id', session('id'))->first();
            $friends = json_decode($currentProfile->friends, true);
            $friends[] = $newFriend;
            $ids = array_column($friends, 'id');
            $uniqueIds = array_unique($ids);
            $friends = array_intersect_key($friends, $uniqueIds);
            $currentProfile->friends = json_encode($friends);
            $currentProfile->save();
            return redirect('/game/chat/' . $id);
        }

    }
    public function friends_remove($id)
    {
        $idToRemove = session('id');
        $idToRemove_ = $id;
        $profile = Profile::where('user_id', $id)->first();
        $originalProfileFriends = json_decode($profile->friends, true);
        $originalProfileFriends = array_filter($originalProfileFriends, function ($element) use ($idToRemove) {
            return (int) $element['id'] !== (int) $idToRemove;
        });
        $profile->friends = json_encode($originalProfileFriends);
        $profile->save();

        $currentProfile = Profile::where('user_id', session('id'))->first();
        $friends = json_decode($currentProfile->friends, true);
        $friends = array_filter($friends, function ($element) use ($idToRemove_) {
            return (int) $element['id'] !== (int) $idToRemove_;
        });
        $currentProfile->friends = json_encode($friends);
        $currentProfile->save();

        return back();
    }
    public function world()
    {
        $profile = Profile::paginate(30);
        return view('game.main.world', ['profile' => $profile]);
    }
    public function world_q(Request $request)
    {
        $builder = Profile::query();
        $searchQuery = $request->search;
        $builder->where(function ($query) use ($searchQuery) {
            $query->where('id', 'LIKE', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($userQuery) use ($searchQuery) {
                    $userQuery->where('name', 'LIKE', '%' . $searchQuery . '%');
                });
        });
        return view('game.main.world', ['profile' => $builder->paginate(30)]);
    }
    public function store()
    {
        return view('game.main.store');
    }
    public function withdraw()
    {
        return view('game.main.withdraw');
    }
    public function withdraw_r(Request $request)
    {
        $profile = Profile::where('user_id', session('id'))->first();
        $coin = $profile->coin;
        if ((int) $coin >= (int) $request->input('amount')) {
            try {
                $payment_m = new Payment_withdraw();

                $payment_m->user_id = session('id');
                $payment_m->amount = $request->input('amount');
                $payment_m->payment_method = $request->input('payment_method');
                if ($request->input('payment_method') == 'crypto_wallet') {
                    $payment_m->bank_name = '-';
                    $payment_m->card_name = '-';
                } else {
                    $payment_m->bank_name = $request->input('bank_name');
                    $payment_m->card_name = $request->input('card_name');
                }
                $payment_m->card_no = $request->input('card_no');
                $payment_m->save();
                return redirect('/game/withdraw-history');
            } catch (\Throwable $e) {
                return redirect()->back()->with('error', 'Error');
            }
        } else {
            return redirect()->back()->with('error', "You don't have enough coin to withdraw");
        }

    }
    public function withdraw_history()
    {
        $payment = Payment_withdraw::where('user_id', session('id'))->paginate(30);
        return view('game.main.withdraw-history', ['payment' => $payment]);
    }
    public function payment()
    {
        $payment_method = Payment_method::get();
        return view('game.main.payment', ['payment_method' => $payment_method]);
    }
    public function conversion()
    {
        return view('game.main.conversion');
    }
    public function conversion_change(Request $request)
    {
        try {
            $usdt = $request->input('usdt');
            $item = Profile::where('user_id', session('id'))->first();
            $item->coin = (int) $item->coin - (int) $usdt;
            $item->chips = (int) $item->chips + ((int) $usdt * 100);
            $item->save();
            return redirect()->back()->with('error', 'Successfully Converted ' . (int) $usdt . ' usdt into ' . ((int) $usdt * 100) . ' chips');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error');
        }
    }
    public function payment_change(Request $request)
    {
        $payment_method = Payment_method::where('name', $request->input('payment_m'))->first();
        try {
            session()->flash('payment_md', $payment_method['details']);
            session()->flash('payment_m', $payment_method['name']);
        } catch (\Exception $e) {
        }
        $payment_method = Payment_method::get();
        return view('game.main.payment', ['payment_method' => $payment_method]);
    }
    public function pay(Request $request)
    {
        $payment_m = new Payment();
        $payment_m->user_id = session('id');
        $payment_m->payment = $request->input('payment');
        $payment_m->amount = $request->input('amount');
        $payment_m->trid = $request->input('trid');
        $payment_m->save();

        return redirect('/game/payment-history');
    }
    public function payment_history()
    {
        $payment = Payment::where('user_id', session('id'))->paginate(30);
        return view('game.main.payment-history', ['payment' => $payment]);
    }
    public function nl_holdem(Request $request)
    {
        $profile = Profile::where('user_id', session('id'))->first();
        $profile->coin = (int) $profile->coin - (int) $request->input('amount');
        if ($profile->coin >= 0) {
            $profile->save();
            return view('game.game.nl-holdem', ['start_amount' => $request->input('amount')]);
        } else {
            return redirect()->back()->with('msg', 'You Need Extra ' . $profile->coin * -1 . '$ To Play');
        }
    }
    public function nl_holdem_rebet(Request $request)
    {
        $profile = Profile::where('user_id', session('id'))->first();
        $profile->coin = (int) $profile->coin - (int) $request->input('amount');
        if ($profile->coin >= 0) {
            $profile->save();
            return response()->json(['message' => 'Request processed successfully']);
        } else {
            return response()->json(['message' => 'You Need Extra ' . $profile->coin * -1 . '$ To Play']);
        }
    }
    public function played(Request $request)
    {
        $profile = Profile::where('user_id', session('id'))->first();

        $player_str = $request->input('player');
        $player = json_decode($player_str, true);
        $win = (int) $player['bankroll'];
        $bet = (int) $player['total_bet'];
        $prr = (int) ($win / $bet) * 100;
        $rake = (((int) config('webdet.rake_amount')) / 100) * $win;
        $profile->coin = (int) $profile->coin + ($win - $rake);
        $profile->prr = (int) $profile->prr + $prr;

        $newHistory = [
            'game' => 'NL Holdem',
            'time' => Carbon::now()->format('H:i:s Y-m-d'),
            'win' => $bet . ' / ' . $win,
            'prr' => $prr,
        ];

        $history = json_decode($profile->history, true);
        $history[] = $newHistory;
        $profile->history = json_encode($history);
        $profile->save();

        $player_rake = new Player_rake();
        $player_rake->user_id = session('id');
        $player_rake->rake = $rake;
        $player_rake->save();

        return redirect('/game/main');
    }
    public function played_s(Request $request)
    {
        $profile = Profile::where('user_id', session('id'))->first();

        $player_str = $request->input('players');
        $player = json_decode($player_str, true);
        $win = (int) $player['bankroll'];
        $bet = (int) $player['total_bet'];
        $prr = (int) ($win / $bet) * 100;
        $rake = (((int) config('webdet.rake_amount')) / 100) * $win;
        $profile->coin = (int) $profile->coin + ($win - $rake);
        $profile->prr = (int) $profile->prr + $prr;

        $newHistory = [
            'game' => 'NL Holdem',
            'time' => Carbon::now()->format('H:i:s Y-m-d'),
            'win' => $bet . ' / ' . $win,
            'prr' => $prr,
        ];

        $history = json_decode($profile->history, true);
        $history[] = $newHistory;
        $profile->history = json_encode($history);
        $profile->save();

        $player_rake = new Player_rake();
        $player_rake->user_id = session('id');
        $player_rake->rake = $rake;
        $player_rake->save();

        return redirect('/game/select-table');
    }
    public function logout()
    {
        session()->pull('id');
        session()->pull('name');
        session()->pull('email');
        session()->pull('password');
        return redirect('/game/sign-in');
    }
    public function player_rank()
    {
        $profiles = Profile::orderBy('prr', 'desc')->paginate(30);
        return view('game.main.player-rank', ['profiles' => $profiles]);
    }
    public function chat($id)
    {
        $id_1 = session('id');
        $id_2 = $id;

        $chatRecord = Chat::where(function ($query) use ($id_1, $id_2) {
            $query->where('user1', $id_1)->where('user2', $id_2)
                ->orWhere('user1', $id_2)->where('user2', $id_1);
        })->first();

        if (!$chatRecord) {
            $chatRecord = new Chat();
            $chatRecord->user1 = $id_1;
            $chatRecord->user2 = $id_2;
            $chatRecord->save();
        }
        return view('game.main.chat', ['chats' => $chatRecord, 'id_r' => $id]);
    }
    public function chat_s($id, Request $request)
    {
        $id_1 = session('id');
        $id_2 = $id;

        $chatRecord = Chat::where(function ($query) use ($id_1, $id_2) {
            $query->where('user1', $id_1)->where('user2', $id_2)
                ->orWhere('user1', $id_2)->where('user2', $id_1);
        })->first();

        if (!$chatRecord) {
            $chatRecord = new Chat();
            $chatRecord->user1 = $id_1;
            $chatRecord->user2 = $id_2;
            $chatRecord->save();
        }
        if ((int) $id == (int) $chatRecord->user1) {
            $sender = 2;
        } elseif ((int) session('id') == (int) $chatRecord->user1) {
            $sender = 1;
        }

        if ($sender == 1) {
            $newMsg = [
                'user1' => '',
                'user2' => $request->input('msg'),
            ];
        } elseif ($sender == 2) {
            $newMsg = [
                'user1' => $request->input('msg'),
                'user2' => '',
            ];
        }

        $chatRecord = Chat::where(function ($query) use ($id_1, $id_2) {
            $query->where('user1', $id_1)->where('user2', $id_2)
                ->orWhere('user1', $id_2)->where('user2', $id_1);
        })->first();

        $originalProfileFriends = json_decode($chatRecord->chat, true);
        $originalProfileFriends[] = $newMsg;
        $chatRecord->chat = json_encode($originalProfileFriends);
        $chatRecord->save();

        return redirect()->back();
    }
}
