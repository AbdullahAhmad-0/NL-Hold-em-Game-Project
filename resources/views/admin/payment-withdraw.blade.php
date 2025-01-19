<x-admin.admin-template>
    <style>
        tbody tr td {
            white-space: normal;
            max-width: 200px;
            word-wrap: break-word;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .text-end {
            max-width: 1000px;
        }

        /* .w-5 {display: none} */
    </style>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">

            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">{{ config('webdet.game_name') }} Payment Withdraw Requests</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Bank Name</th>
                                <th scope="col">Name On Card</th>
                                <th scope="col">Card Number / USDT Wallet Address</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Time</th>
                                <th scope="col">Operation</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td><strong>{{ $item['user_id'] }}</strong></td>
                                    <td>{{ $item->user['name'] }}</td>
                                    <td>{{ $item['payment_method'] }}</td>
                                    <td>{{ $item['bank_name'] }}</td>
                                    <td>{{ $item['card_name'] }}</td>
                                    <td>{{ $item['card_no'] }}</td>
                                    <td>{{ $item['amount'] }}</td>
                                    <td>
                                        <span class="badge badge-lg badge-dot">
                                        @if ($item['status'] == 'approve')
                                            <i class="bg-success"></i> Approve
                                        @elseif ($item['status'] == 'request')
                                            <i class="bg-warning"></i> Request
                                        @else
                                            <i class="bg-warning"></i> Disapproved
                                        @endif
                                        </span>
                                    </td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td class="text-end">
                                        @if ($item['status'] == 'request')
                                            <a href="/admin/payment_withdraw/approve/{{ $item['id'] }}" class="btn btn-sm btn-neutral">Approve To Withdraw</a>
                                            <a href="/admin/payment_withdraw/disapprove/{{ $item['id'] }}" class="btn btn-sm btn-neutral">Decline Withdraw Request</a>
                                        @endif
                                        <a href="/admin/users/view/{{ $item['user_id'] }}" class="btn btn-sm btn-neutral">View User</a>
                                        <a href="/admin/player_rake/delete/{{ $item['id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer border-0 py-5">
                    <div class="pagination">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-admin.admin-template>
