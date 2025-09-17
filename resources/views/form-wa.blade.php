<form action="{{ route('kirim.wa') }}" method="POST">
    @csrf
    <label>No HP:</label>
    <input type="text" name="no_hp" required>
    <br>
    <label>Nama:</label>
    <input type="text" name="nama" required>
    <br>
    <label>Jam:</label>
    <input type="text" name="jam" required>
    <br>
    <button type="submit">Kirim WA</button>
</form>
