@extends('layouts.main')

@section('content')
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="https://www.aspca.org/sites/default/files/finding-a-lost-pet-main-v2.jpg"
                    class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Ayudamos a mascotas extraviadas a encontrar su
                    camino a casa
                </h1>
                <p class="lead">Petfindr es una plataforma digital comunitaria sin fines de lucro creada con el fin de
                    ayudar a reunir a
                    familias con sus mascotas perdidas.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="{{ route('pet.report.lost') }}" class="btn btn-primary color-green btn-lg px-4 me-md-2">Perdí a
                        mi
                        mascota</a>
                    <a href="{{ route('pet.report.found') }}" class="btn btn-secondary btn-lg px-4">Encontré un perro y/o
                        gato</a>
                </div>
            </div>
        </div>
    </div>
@endsection
