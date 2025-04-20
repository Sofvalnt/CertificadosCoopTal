<<<<<<< HEAD
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Restablecer contraseña de usuario</h3>
    
    <form method="POST" action="{{ route('it.password.reset') }}">
        @csrf
        
        <div class="form-group">
            <label>Correo del usuario:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Contraseña temporal:</label>
            <input type="text" name="password" class="form-control" 
                   placeholder="Ej: Temp1234" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
=======
@extends('adminlte::page')

@section('content')
<div class="container">
    <h3>Restablecer contraseña de usuario</h3>
    
    <form method="POST" action="{{ route('it.password.reset') }}">
        @csrf
        
        <div class="form-group">
            <label>Correo del usuario:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Contraseña temporal:</label>
            <input type="text" name="password" class="form-control" 
                   placeholder="Ej: Temp1234" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
>>>>>>> 35a042960754fbf6964b47082aa075e639f610b5
@endsection