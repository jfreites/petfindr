@extends('layouts.main')

@section('content')
    <div class="container">
        <img id="pet" src="{{ $pet->getFirstMediaUrl('pets') }}" style="width: 300px;" class="rounded">

        <div>
            <p>Nombre: {{ $pet->name }}</p>
            <p>Descripcion: {{ $pet->description }}</p>
            <p>Especie: {{ $pet->getSpeciesName() }}</p>
            <p>Ultima vez visto: {{ $pet->last_location }}</p>
            <p>Reportado por: {{ $pet->reporter->name }}</p>
            @if ($pet->is_protected)
                <p class="fw-semibold">Esta mascota se encuentra en resguardo con el reportante, contáctalo solo en el caso
                    que
                    sea
                    tu mascotas y tengas pruebas.
                </p>
            @endif
        </div>

        <div>
            @if ($pet->status == 'found')
                <form action="" method="post" id="reclaimForm">
                    @csrf
                    <button class="btn btn-primary color-green" type="submit">Es mi mascota</button>
                </form>
            @endif
        </div>
    </div>
@endsection


@section('scripts')
@endsection
