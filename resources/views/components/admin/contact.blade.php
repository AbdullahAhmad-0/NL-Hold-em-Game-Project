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
.w-5 {display: none}
</style>

<main class="py-6 bg-surface-secondary">
    <div class="container-fluid">

        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">Messages</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Message</th>
                            <th scope="col">Time</th>
                            <th scope="col">Operation</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Message</td>
                                <td>Time</td>
                                <td>
                                    <span class="badge badge-lg badge-dot">
                                            <i class="bg-success"></i>
                                            <i class="bg-warning"></i>
                                    </span>
                                </td>
                                <td class="text-end">
                                        <a href="/admin/contact/read/" class="btn btn-sm btn-neutral">Mark As Read</a>
                                    <a href="/admin/contact/view/" class="btn btn-sm btn-neutral">View</a>
                                    <a href="/admin/contact/delete/" class="btn btn-sm btn-neutral"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer border-0 py-5">
                <div class="pagination">
                    {{-- {{ $items->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</main>
