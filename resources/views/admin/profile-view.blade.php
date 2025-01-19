<x-admin.admin-template>
    <div class="grid-item">
        <div class="contact-container">
            <form class="contact-form">
                <div class="form-group">
                    <label for="name">ID: {{ $item->user['id'] }}</label>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    {{ $item->user['name'] }}
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    {{ $item->user['email'] }}
                </div>
                <div class="form-group">
                    <label for="phone">PRR</label>
                    {{ $item['prr'] }}
                </div>
                <div class="form-group">
                    <label for="message">Coin</label>
                    {{ $item['coin'] }}
                </div>
                <div class="form-group">
                    <label for="message">Chips</label>
                    {{ $item['chips'] }}
                </div>
                <div class="form-group">
                    <label for="message">Friends</label>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>PRR</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    try {
                                        $items = json_decode($item->friends, true);
                                        foreach ($items as $key => $item_) {
                                            echo '<tr>';
                                            echo '<td>' . $item_['id'] . '</td>';
                                            echo '<td>' . $item_['name'] . '</td>';
                                            echo '<td>' . $item_['prr'] . '</td>';
                                            echo '</tr>';
                                        }
                                    } catch (Exception $e) {
                                    }
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">History</label>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>Time</th>
                                    <th>Game Type</th>
                                    <th>Total Bet / Winning</th>
                                    <th>PRR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    try {
                                        $items = json_decode($item->history, true);
                                        foreach ($items as $key => $item_) {
                                            echo '<tr>';
                                            echo '<td>' . $item_['time'] . '</td>';
                                            echo '<td>' . $item_['game'] . '</td>';
                                            echo '<td>' . $item_['win'] . '</td>';
                                            echo '<td>' . $item_['prr'] . '</td>';
                                            echo '</tr>';
                                        }
                                    } catch (Exception $e) {
                                    }
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label for="time">Last Seen</label>
                    {{ $item->user['last_seen'] }}
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    {{ $item['created_at'] }}
                </div>
            </form>
            <br>
            <a href="/admin/users">Back To User Page</a>
            <a href="/admin/profiles">Back To Profile Page</a>
        </div>
    </div>
</x-admin.admin-template>
