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
                    <h5 class="mb-0">{{ config('webdet.game_name') }} Users</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">E-Mail Verified</th>
                                <th scope="col">Time</th>
                                <th scope="col">Last Seen</th>
                                <th scope="col">Current Status</th>
                                <th scope="col">Operation</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td><strong>{{ $item['id'] }}</strong></td>
                                    <td><strong>{{ $item['name'] }}</strong></td>
                                    <td>{{ $item['email'] }}</td>
                                    <td><span class="badge badge-lg badge-dot">
                                            @if ($item['email_verified'] == 'no')
                                                <i class="bg-warning"></i>
                                            @else
                                                <i class="bg-success"></i>
                                            @endif
                                            {{ $item['email_verified'] }}
                                        </span></td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>{{ $item['last_seen'] }}</td>
                                    <td><span class="badge badge-lg badge-dot">
                                            @if (Cache::has('user-is-online-' . $item['id']))
                                                <i class="bg-success"></i>Online
                                            @else
                                                <i class="bg-warning"></i>Offline
                                            @endif
                                        </span></td>
                                    <td class="text-end">
                                        @if ($item['email_verified'] == 'no')
                                            <a href="/admin/users/email-verify/{{ $item['id'] }}" class="btn btn-sm btn-neutral">Verify Email</a>
                                        @endif
                                        <a href="/admin/users/view/{{ $item['id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-eye"></i></a>
                                        <a href="/admin/users/delete/{{ $item['id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-trash"></i></a>
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
