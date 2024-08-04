@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row p-4">
            <div class="col">
                <label for="orderby">Ordenar por:</label>
                <select name="orderby" id="orderby" class="form-control">
                    <option value="-1" {{ $order == '-1' ? 'selected' : '' }}>Sin orden</option>
                    <option value="1" {{ $order == '1' ? 'selected' : '' }}>Mas recientes</option>
                    <option value="2" {{ $order == '2' ? 'selected' : '' }}>Mas antiguos</option>
                    <option value="3" {{ $order == '3' ? 'selected' : '' }}>Primero encontrados</option>
                    {{-- <option value="3" {{ $order == '3' ? 'selected' : '' }}>Cerca de mi zona</option>
                    <option value="4" {{ $order == '4' ? 'selected' : '' }}>Lejos de mi zona</option> --}}
                </select>
            </div>
            <div class="col">
                <label for="pagesize">Resultados por página</label>
                <select name="size" id="pagesize" class="form-control">
                    <option value="9" {{ $size == '9' ? 'selected' : '' }}>9 publicaciones</option>
                    <option value="15" {{ $size == '15' ? 'selected' : '' }}>15 publicaciones
                    </option>
                    <option value="21" {{ $size == '21' ? 'selected' : '' }}>21 publicaciones
                    </option>
                    <option value="34" {{ $size == '34' ? 'selected' : '' }}>34 publicaciones
                    </option>
                </select>
            </div>
            <div class="col"></div>
        </div>

        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4">
                @foreach ($pets as $pet)
                    <div class="col">
                        @if ($petImage = $pet->getFirstMediaUrl('pets', 'preview'))
                            <p><img src="{{ $petImage }}" class="rounded" /></p>
                        @else
                            <p><img src="https://placehold.co/250x300/green/white?text=Sin+Imagen" class="rounded" /></p>
                        @endif
                        <p>Nombre: {{ $pet->name }}</p>
                        <p>Vista en: {{ $pet->last_location }}</p>
                        <p>Reportado como: {{ $pet->getStatusName() }}</p>
                        <p><a href="{{ route('pet.report.details', $pet) }}">Ver detalles</a></p>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                {{ $pets->withQueryString()->links() }}
            </div>
        </div>
        <p class="text-sm text-center">* Las mascotas en status encontrado pueden o no estar con la persona que reporta.</p>
    </div>

    <form action="" method="GET" id="formFilter">
        <input type="hidden" name="page" id="page" value="{{ $page }}">
        <input type="hidden" name="size" id="size" value="{{ $size }}">
        <input type="hidden" name="order" id="order" value="{{ $order }}">
    </form>
@endsection


@section('scripts')
    <script>
        $('#pagesize').on('change', function() {
            $('#size').val($('#pagesize option:selected').val());

            $('#formFilter').submit();
        });

        $('#orderby').on('change', function() {
            $('#order').val($('#orderby option:selected').val());

            $('#formFilter').submit();
        });
    </script>
@endsection
