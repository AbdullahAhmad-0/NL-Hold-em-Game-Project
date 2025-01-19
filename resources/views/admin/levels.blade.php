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
                    <h5 class="mb-0">{{ config('webdet.game_name') }} Levels</h5><a href="/admin/levels/add">Add New Level</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Level Name</th>
                                <th scope="col">PRR MIN</th>
                                <th scope="col">PRR MAX</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Time</th>
                                <th scope="col">Operation</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td><strong>{{ $item['level'] }}</strong></td>
                                    <td>{{ $item['prr_min'] }}</td>
                                    <td>{{ $item['prr_max'] }}</td>
                                    <td><img src=" {{ asset($item['icon']) }}" alt="Icon"></td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td class="text-end">
                                        <a href="/admin/levels/view/{{ $item['id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-eye"></i></a>
                                        <a href="/admin/levels/edit/{{ $item['id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-pencil"></i></a>
                                        <a href="/admin/levels/delete/{{ $item['id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-trash"></i></a>
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
