<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PetFindr</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .color-green {
            background-color: #009688 !important;
            border: 1px solid #009688 !important;
            color: #ffffff !important;
        }

        .text-green {
            color: #009688 !important;
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- header -->
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <span class="text-primary text-green fs-3">PET</span><span
                        class="fs-3 text-secondary fw-bold">FINDR</span>
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 fw-semibold">
                <li><a href="#" class="nav-link px-2 text-green">Inicio</a></li>
                <li><a href="#" class="nav-link px-2 link-secondary">¿Como funciona?</a></li>
                <li><a href="{{ route('pet.search') }}" class="nav-link px-2 link-secondary">Buscar</a></li>
                <li><a href="#" class="nav-link px-2 link-secondary">Adopta</a></li>
                <li><a href="#" class="nav-link px-2 link-secondary">Ayuda</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-secondary me-2">Login alianzas</button>
            </div>
        </header>
    </div>

    <!-- content -->
    <main>
        @yield('content')
    </main>

    <!-- footer -->
    <div class="container">
        <footer class="py-5">
            <div class="row">
                <div class="col-6 col-md-2 mb-3">
                    <h5>Nosotros</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Inicio</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">¿Cómo
                                funciona?</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('pet.search') }}"
                                class="nav-link p-0 text-body-secondary">Buscar</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#"
                                class="nav-link p-0 text-body-secondary">Reportar</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Comunidad</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Adopción
                                responsable</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Recolecta
                                de alimento</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Red
                                médica</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">¿Cómo
                                ayudar?</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Contacto</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Envia un
                                mensaje</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#"
                                class="nav-link p-0 text-body-secondary">Facebook</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#"
                                class="nav-link p-0 text-body-secondary">Instagram</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-5 offset-md-1 mb-3">
                    <form>
                        <h5 class="text-green">Regístrate a nuestro boletín de noticias</h5>
                        <p>Mensualmente enviamos noticias, tips e información relacionada con nuestros pequeños peludos.
                        </p>
                        <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Dirección de E-mail</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Email address"
                                control-id="ControlID-1" data-sharkid="__0" data-sharklabel="email">
                            <button class="btn btn-primary color-green" type="button"
                                control-id="ControlID-2">Suscribir</button>
                            <shark-icon-container data-sharkidcontainer="__0"></shark-icon-container>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                <p>&copy {{ date('Y') }} PETFINDR. Todos los derechos reservados.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24"
                                height="24">
                                <use xlink:href="#twitter"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi"
                                width="24" height="24">
                                <use xlink:href="#instagram"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi"
                                width="24" height="24">
                                <use xlink:href="#facebook"></use>
                            </svg></a></li>
                </ul>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>

</html>
