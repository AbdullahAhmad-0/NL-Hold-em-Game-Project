<x-admin.admin-template>
    <div class="grid-item">
        <div class="contact-container">
            <form class="contact-form" action="/admin/levels/edit/{{ $id }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">ID: {{ $id }}</label>
                    <input type="hidden" name="id" value="{{ $id }}">
                </div>
                <div class="form-group">
                    <label for="level">Level Name</label>
                    <input type="text" id="level" name="level" placeholder="Enter Level Name" value="{{ session('level') }}" required>
                </div>
                <div class="form-group">
                    <label for="prr_min">PRR Min</label>
                    <input type="number" id="prr_min" name="prr_min" placeholder="Enter Your PRR Min" value="{{ session('prr_min') }}" required>
                </div>
                <div class="form-group">
                    <label for="prr_max">PRR Max</label>
                    <input type="number" id="prr_max" name="prr_max" placeholder="Enter Your PRR Max" value="{{ session('prr_max') }}" required>
                </div>
                <button type="submit" class="submit-btn">Update</button>
            </form>
            <br>
            <a href="/admin/levels">Back To Level</a>
        </div>
    </div>
</x-admin.admin-template>
