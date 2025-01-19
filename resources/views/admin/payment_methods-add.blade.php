<x-admin.admin-template>
    <div class="grid-item">
        <div class="contact-container">
            <form class="contact-form" action="/admin/payment_methods/add" method="post">
                @csrf
                <div class="form-group">
                    <label for="pname">Payment Method Name</label>
                    <input type="text" id="pname" name="pname" placeholder="Enter Payment Method Name" value="{{ session('pname') }}" required>
                </div>
                <div class="form-group">
                    <label for="details">Details</label>
                    <textarea id="details" name="details" placeholder="Enter Details Such As Bank Details So People Can Send You Money" value="{{ session('details') }}" required cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="submit-btn">Add</button>
            </form>
            <br>
            <a href="/admin/payment_methods">Back To Payment Methods</a>
        </div>
    </div>
</x-admin.admin-template>
