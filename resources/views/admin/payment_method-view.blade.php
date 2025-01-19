<x-admin.admin-template>
    <div class="grid-item">
        <div class="contact-container">
            <form class="contact-form">
                <div class="form-group">
                    <label for="name">ID: {{ $item['id'] }}</label>
                </div>
                <div class="form-group">
                    <label for="name">Payment Method Name</label>
                    {{ $item['name'] }}
                </div>
                <div class="form-group">
                    <label for="name">Details</label>
                    {{ $item['details'] }}
                </div>
            </form>
            <br>
            <a href="/admin/payment_methods">Back To Payment Methods</a>
        </div>
    </div>
</x-admin.admin-template>
