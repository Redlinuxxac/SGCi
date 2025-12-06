<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/img/SGCI.png" type="image/png">
        <link rel="apple-touch-icon" href="/img/SGCI.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="w-full max-w-5xl mx-auto p-6 lg:p-8">


                <main class="mt-12 lg:mt-6">
                    <div class="flex flex-col lg:flex-row items-center gap-12">
                        <!-- Logo y Título -->
                        <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                            <img src="{{ asset('img/SGCI.png') }}" alt="Logo SGCi" class="h-32 w-32 object-contain">
                            <h1 class="mt-6 text-4xl font-bold text-gray-900 dark:text-white">
                                Sistema de Gestión Cooperativa Integrado
                            </h1>
                            <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-lg">
                                Una plataforma centralizada para administrar todas las operaciones esenciales de tu cooperativa. Eficiencia, transparencia y cumplimiento normativo al alcance de tu mano.
                            </p>
                             <a href="{{ route('login') }}" class="mt-8 inline-block dark:bg-blue-600 dark:hover:bg-blue-700 dark:text-white hover:bg-blue-600 px-6 py-3 bg-blue-500 rounded-md border border-transparent text-white text-base font-medium leading-normal shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150 ease-in-out">
                                Ir al Sistema
                            </a>
                        </div>
                        
                        <!-- Cards de Módulos -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full lg:w-1/2">
                            <!-- Card Socios -->
                            <div class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Gestión de Socios</h2>
                                <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                                    Administra de forma centralizada toda la información de los miembros de la cooperativa.
                                </p>
                            </div>

                            <!-- Card Préstamos -->
                            <div class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Créditos y Préstamos</h2>
                                <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                                    Gestiona el ciclo de vida completo de los préstamos, desde la solicitud hasta el pago final.
                                </p>
                            </div>

                            <!-- Card Contabilidad -->
                            <div class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Contabilidad Integrada</h2>
                                <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                                    Registros automáticos, plan de cuentas adaptable y generación de reportes financieros.
                                </p>
                            </div>

                            <!-- Card Documentación -->
                            <div class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Documentación</h2>
                                <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                                    Consulta el manual de usuario para aprender a utilizar todas las herramientas del sistema.
                                </p>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="py-12 text-center text-sm text-gray-500 dark:text-gray-400 mt-12">
                    SGCi v1.0 - Un sistema robusto para la gestión de tu cooperativa.
                </footer>
                 @fluxScripts
            </div>
        </div>
    </body>
</html>