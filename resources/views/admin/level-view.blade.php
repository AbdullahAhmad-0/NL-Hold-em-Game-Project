<x-admin.admin-template>
    <div class="grid-item">
        <div class="contact-container">
            <form class="contact-form">
                <div class="form-group">
                    <label for="name">ID: {{ $item['id'] }}</label>
                </div>
                <div class="form-group">
                    <label for="name">Level Name</label>
                    {{ $item['level'] }}
                </div>
                <div class="form-group">
                    <label for="name">PRR Min</label>
                    {{ $item['prr_min'] }}
                </div>
                <div class="form-group">
                    <label for="name">PRR Max</label>
                    {{ $item['prr_max'] }}
                </div>
                <div class="form-group">
                    <label for="name">Icon</label>
                    <img style="width: 200px;" src="{{ asset($item['icon']) }}" alt="icon">
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    {{ $item['created_at'] }}
                </div>
            </form>
            <br>
            <a href="/admin/levels">Back To Level</a>
        </div>
    </div>
</x-admin.admin-template>
