<div class="form-group">
    <label for="name">Nama Penyewa</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ old('name', isset($page) ? $page->name : '') }}" required>
</div>

<div class="form-group">
    <label for="address">Alamat</label>
    <textarea class="form-control" id="address" name="address"required>{{ old('address', isset($page) ? $page->address : '') }}</textarea>
</div>

<div class="form-group">
    <label for="phone_number">No HP</label>
    <input type="text" class="form-control" id="phone_number" name="phone_number"
        value="{{ old('phone_number', isset($page) ? $page->phone_number : '') }}" required>
</div>

<hr>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email"
        value="{{ old('email', isset($user) ? $user->email : '') }}" required>
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" value="{{ old('password', '') }}"
        @if (!isset($page)) required @endif>
</div>
