<div class="grid-item">
    <div class="contact-container">
        <form class="contact-form" id="webdet" action="/admin/account/save_webdet" method="POST">
            @csrf
            <h2 class="heading-common-s">Website Details</h2>
            <div class="form-group">
                <label for="website_name">Website Name</label>
                <input type="text" id="website_name" name="website_name" placeholder="Enter Your Website Name" value="{{ config('webdet.website_name') }}" required>
            </div>
            <div class="form-group">
                <label for="game_name">Game Name</label>
                <input type="text" id="game_name" name="game_name" placeholder="Enter Your Game Name" value="{{ config('webdet.game_name') }}" required>
            </div>
            <div class="form-group">
                <label for="on_start_coin">On Start Coins</label>
                <input type="number" id="on_start_coin" name="on_start_coin" placeholder="Enter How Many Coins You Want To Give To New User" value="{{ config('webdet.on_start_coin') }}" required>
            </div>
            <div class="form-group">
                <label for="on_start_chips">On Start Chips</label>
                <input type="number" id="on_start_chips" name="on_start_chips" placeholder="Enter How Many Chips You Want To Give To New User" value="{{ config('webdet.on_start_chips') }}" required>
            </div>
            <div class="form-group">
                <label for="rake_amount">On Rake Percent</label>
                <input type="number" id="rake_amount" name="rake_amount" placeholder="Enter Rake Amount Percentage" value="{{ config('webdet.rake_amount') }}" required>
            </div>
            @if (session('success-web'))
                <div class="alert alert-success">
                    {{ session('success-web') }}
                </div>
            @endif
            <button type="submit" id="webdet-btn" class="submit-btn">Save</button>
        </form>
        <hr>
        {{-- <form class="contact-form" id="usrdet" action="/admin/account/save_usrdet" method="POST">
            @csrf
            <h2 class="heading-common-s">User Details</h2>
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" placeholder="Enter Your E-Mail Address." required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                Password is already set, enter a new one to change it.
                    <input type="password" id="password" name="password" placeholder="Enter your new secret password.">
                </div>
                @if (session('success-usr'))
                    <div class="alert alert-success">
                        {{ session('success-usr') }}
                    </div>
                @endif
            <button type="submit" id="usrdet-btn" class="submit-btn">Save</button>
        </form> --}}
    </div>
</div>
