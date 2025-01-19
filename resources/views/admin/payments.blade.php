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

        tbody tr td img {
            max-height: 21.25px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 1));
        }

        /* .w-5 {display: none} */
    </style>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">

            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">{{ config('webdet.game_name') }} Payments</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Taransection ID</th>
                                <th scope="col">Approve</th>
                                <th scope="col">Time</th>
                                <th scope="col">Operation</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td><strong>{{ $item['id'] }}</strong></td>
                                    <td>{{ $item['user_id'] }}</td>
                                    <td>{{ $item['payment'] }}</td>
                                    <td>{{ $item['amount'] }}</td>
                                    <td>{{ $item['trid'] }}</td>
                                    <td><span class="badge badge-lg badge-dot">
                                        @if ($item['approve'] == 'no')
                                            <i class="bg-warning"></i>
                                        @else
                                            <i class="bg-success"></i>
                                        @endif
                                        {{ $item['approve'] }}
                                    </span></td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td class="text-end">
                                        @if ($item['approve'] == 'no')
                                            <a href="/admin/payments/approve/{{ $item['id'] }}" class="btn btn-sm btn-neutral">Approve Payment</a>
                                        @endif
                                        <a href="/admin/payments/view/{{ $item['id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-eye"></i></a>
                                        <a href="/admin/payments/delete/{{ $item['id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-trash"></i></a>
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
