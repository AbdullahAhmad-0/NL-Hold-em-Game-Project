<table wire:poll.5s>
    <tr>
        <th class="left">Received</th>
        <th class="right">Sended</th>
    </tr>
    @php
        try {
            $items = json_decode($chats->chat, true);
            foreach ($items as $key => $item) {
                echo '<tr>';
                if ($sender == 1) {
                    echo '<td class="left">' . $item['user1'] . '</td>';
                    echo '<td class="right">' . $item['user2'] . '</td>';
                } elseif ($sender == 2) {
                    echo '<td class="left">' . $item['user2'] . '</td>';
                    echo '<td class="right">' . $item['user1'] . '</td>';
                }
                echo '</tr>';
            }
        } catch (Exception $e) {
        }
    @endphp
</table>