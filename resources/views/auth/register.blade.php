@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registro de Usuario</h2>

    <form method="POST" action="{{ route('usuario.create') }}">
        @csrf

        <div class="mb-3">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" name="nombre_usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_tipo_usuario">Tipo de Usuario:</label>
            <select name="id_tipo_usuario" class="form-control" required onchange="mostrarFormulario(this.value)">
                <option value="">Seleccione un tipo</option>
                <option value="1">Estudiante</option>
                <option value="2">Docente</option>
                <option value="3">Evaluador</option>
            </select>
        </div>

        <div id="form-estudiante" style="display:none;">
            <h4>Datos del Estudiante</h4>
            <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2">
            <input type="email" name="correo" placeholder="Correo" class="form-control mb-2">
            <input type="text" name="documento" placeholder="Documento" class="form-control mb-2">
            <input type="number" name="id_programa" placeholder="ID Programa" class="form-control mb-2">
        </div>

        <div id="form-docente" style="display:none;">
            <h4>Datos del Docente</h4>
            <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2">
            <input type="email" name="correo" placeholder="Correo" class="form-control mb-2">
            <input type="text" name="documento" placeholder="Documento" class="form-control mb-2">
            <input type="number" name="id_departamento" placeholder="ID Departamento" class="form-control mb-2">
        </div>

        <div id="form-evaluador" style="display:none;">
            <h4>Datos del Evaluador</h4>
            <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2">
            <input type="email" name="correo" placeholder="Correo" class="form-control mb-2">
            <input type="text" name="documento" placeholder="Documento" class="form-control mb-2">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Registrar</button>
    </form>
</div>

<script>
    function mostrarFormulario(valor) {
        document.getElementById('form-estudiante').style.display = valor == 1 ? 'block' : 'none';
        document.getElementById('form-docente').style.display = valor == 2 ? 'block' : 'none';
        document.getElementById('form-evaluador').style.display = valor == 3 ? 'block' : 'none';
    }
</script>
@endsection

