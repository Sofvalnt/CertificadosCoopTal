<form action="{{ route('procesar.csv') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="archivo_csv">Cargar archivo CSV:</label>
    <input type="file" name="archivo_csv" accept=".csv" required>
    <button type="submit">Cargar CSV</button>
</form>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif
