<div class="form-group">
    <label for="name">Nama Kamar Kos</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ old('name', isset($page) ? $page->name : '') }}" required>
</div>
<div class="form-group">
    <label for="description">Deskripsi Kamar Kos</label>
    <textarea class="form-control" id="description" name="description"required>{{ old('description', isset($page) ? $page->description : '') }}</textarea>
</div>
<div class="form-group">
    <label for="price">Harga Kamar Kos</label>
    <input type="number" class="form-control" id="price" name="price"
        value="{{ old('price', isset($page) ? $page->price : '') }}" required>
</div>
<div class="form-group">
    <label for="available">Available</label>
    <select class="form-control" id="available" name="available" required>
        <option @if (old('available', isset($page) ? $page->available : '') == '1') selected @endif value="1">Ya</option>
        <option @if (old('available', isset($page) ? $page->available : '') == '0') selected @endif value="0">Tidak</option>
    </select>
</div>
