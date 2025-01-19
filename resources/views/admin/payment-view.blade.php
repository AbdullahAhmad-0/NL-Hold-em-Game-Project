<x-admin.admin-template>
    <div class="grid-item">
        <div class="contact-container">
            <form class="contact-form">
                <div class="form-group">
                    <label for="name">ID: {{ $item['id'] }}</label>
                </div>
                <div class="form-group">
                    <label for="name">User ID <a href="/admin/users/view/{{ $item['user_id'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-eye"></i></a></label>
                    {{ $item['user_id'] }}
                </div>
                <div class="form-group">
                    <label for="name">Payment Method <a href="/admin/payment_methods/view/c/{{ $item['payment'] }}" class="btn btn-sm btn-neutral"><i class="bi bi-eye"></i></a></label>
                    {{ $item['payment'] }}
                </div>
                <div class="form-group">
                    <label for="name">Amount</label>
                    {{ $item['amount'] }}
                </div>
                <div class="form-group">
                    <label for="name">Transection ID</label>
                    {{ $item['trid'] }}
                </div>
                <div class="form-group">
                    <label for="name">Approve</label>
                    {{ $item['approve'] }}
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    {{ $item['created_at'] }}
                </div>
            </form>
            <br>
            <a href="/admin/payments">Back To Payments</a>
        </div>
    </div>
</x-admin.admin-template>
