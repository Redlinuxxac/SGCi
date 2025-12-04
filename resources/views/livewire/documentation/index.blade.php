<div>
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Manual de Usuario - SGCi</h1>

    <div class="prose prose-lg dark:prose-invert max-w-none">
        <p class="lead">
            Bienvenido al Sistema de Gestión Cooperativa Integrado (SGCi). Este manual está diseñado para guiar a los nuevos usuarios a través de las funcionalidades clave de la aplicación, desde la gestión de socios hasta la administración de la seguridad del sistema.
        </p>

        <div class="mt-8 p-6 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <h2 class="text-2xl font-semibold">Tabla de Contenidos</h2>
            <ul class="mt-4 space-y-2">
                <li><a href="#introduccion" class="text-blue-500 hover:underline">1. Introducción y Primeros Pasos</a></li>
                <li><a href="#socios" class="text-blue-500 hover:underline">2. Módulo de Gestión de Socios (MGS)</a></li>
                <li><a href="#prestamos" class="text-blue-500 hover:underline">3. Módulo de Crédito y Préstamos (MCP)</a></li>
                <li><a href="#ahorros" class="text-blue-500 hover:underline">4. Módulo de Ahorro y Captaciones (MAC)</a></li>
                <li><a href="#contabilidad" class="text-blue-500 hover:underline">5. Módulo Contable y Financiero (MCF)</a></li>
                <li><a href="#seguridad" class="text-blue-500 hover:underline">6. Módulo de Seguridad</a></li>
            </ul>
        </div>

        <section id="introduccion" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">1. Introducción y Primeros Pasos</h2>
            <p class="mt-4">
                El SGCi es una plataforma integral para administrar todas las operaciones de una cooperativa. Al iniciar sesión, serás recibido por el <strong>Dashboard</strong> principal, que ofrece una vista rápida de las actividades y métricas importantes.
            </p>
            <p>
                La navegación principal se encuentra en la barra lateral izquierda. Desde aquí, puedes acceder a todos los módulos del sistema. Tu acceso a cada módulo dependerá de los permisos asignados a tu rol de usuario.
            </p>
        </section>

        <section id="socios" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">2. Módulo de Gestión de Socios (MGS)</h2>
            <p class="mt-4">
                Este es el módulo central para administrar la información de los miembros de la cooperativa.
            </p>
            <h3 class="text-xl font-semibold mt-6">Funcionalidades:</h3>
            <ul class="list-disc pl-6 space-y-2">
                <li><strong>Ver Socios:</strong> La pantalla principal muestra una lista de todos los socios con su información básica.</li>
                <li><strong>Crear un Nuevo Socio:</strong>
                    <ol class="list-decimal pl-6 mt-2">
                        <li>Haz clic en el botón <strong>"Crear Socio"</strong>.</li>
                        <li>Rellena el formulario con los datos del nuevo socio (nombres, apellidos, cédula, etc.).</li>
                        <li>Haz clic en <strong>"Guardar"</strong>.</li>
                    </ol>
                </li>
                <li><strong>Editar un Socio:</strong>
                    <ol class="list-decimal pl-6 mt-2">
                        <li>En la lista de socios, haz clic en el botón <strong>"Editar"</strong> correspondiente al socio que deseas modificar.</li>
                        <li>Actualiza la información en el formulario.</li>
                        <li>Haz clic en <strong>"Guardar"</strong>.</li>
                    </ol>
                </li>
                <li><strong>Eliminar un Socio:</strong>
                    <ol class="list-decimal pl-6 mt-2">
                        <li>Haz clic en el botón <strong>"Eliminar"</strong>.</li>
                        <li>Confirma la acción en el cuadro de diálogo. Esto no borra el registro permanentemente (utiliza borrado suave), pero lo oculta de las listas principales.</li>
                    </ol>
                </li>
            </ul>
        </section>

        <section id="prestamos" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">3. Módulo de Crédito y Préstamos (MCP)</h2>
            <p class="mt-4">
                Permite la gestión completa del ciclo de vida de los préstamos otorgados a los socios. El proceso es similar al de la gestión de socios (Crear, Editar, Eliminar).
            </p>
            <h3 class="text-xl font-semibold mt-6">Campos Clave:</h3>
            <ul class="list-disc pl-6 space-y-2">
                <li><strong>Socio:</strong> Debes seleccionar un socio activo de la lista.</li>
                <li><strong>Monto:</strong> La cantidad total del préstamo.</li>
                <li><strong>Tasa de Interés:</strong> El porcentaje de interés anual.</li>
                <li><strong>Plazo (Meses):</strong> El número de meses para pagar el préstamo.</li>
                <li><strong>Estado:</strong> El estado actual del préstamo (Pendiente, Aprobado, Desembolsado, etc.).</li>
            </ul>
        </section>
        
        <section id="ahorros" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">4. Módulo de Ahorro y Captaciones (MAC)</h2>
            <p class="mt-4">
                Administra las diferentes cuentas de ahorro de los socios. La operativa de creación, edición y eliminación sigue el mismo patrón que los módulos anteriores.
            </p>
        </section>

        <section id="contabilidad" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">5. Módulo Contable y Financiero (MCF)</h2>
            <p class="mt-4">
                Este módulo es más complejo y se divide en dos secciones principales: el Plan de Cuentas y el Diario Contable (Asientos).
            </p>
            <h3 class="text-xl font-semibold mt-6">Plan de Cuentas:</h3>
            <p>Aquí se definen todas las cuentas contables que utiliza la cooperativa. Puedes crear nuevas cuentas o editar las existentes. Es importante notar que las cuentas no se pueden eliminar por seguridad contable.</p>
            <h3 class="text-xl font-semibold mt-6">Diario Contable (Asientos):</h3>
            <p>Registra todas las transacciones financieras. Para crear un asiento:</p>
            <ol class="list-decimal pl-6 mt-2">
                <li>Haz clic en <strong>"Crear Asiento"</strong>.</li>
                <li>Introduce la fecha y una descripción general.</li>
                <li>Añade filas para los movimientos. Cada fila debe tener una cuenta contable y un valor en la columna de <strong>Debe</strong> o <strong>Haber</strong>.</li>
                <li><strong>Importante:</strong> La suma total de los débitos debe ser igual a la suma total de los créditos para que el asiento pueda ser guardado.</li>
                <li>Haz clic en <strong>"Guardar Asiento"</strong>.</li>
            </ol>
            <p>Los asientos existentes solo se pueden visualizar, no editar ni eliminar, para mantener la integridad de los registros contables.</p>
        </section>
        
        <section id="seguridad" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">6. Módulo de Seguridad</h2>
            <p class="mt-4">
                Esta sección está reservada para los administradores del sistema y permite gestionar los roles y permisos de los usuarios.
            </p>
            <h3 class="text-xl font-semibold mt-6">Roles:</h3>
            <p>Puedes crear, editar y eliminar roles. Al editar un rol, puedes asignarle permisos específicos marcando las casillas correspondientes. Esto determina qué acciones puede realizar un usuario con ese rol.</p>
            <h3 class="text-xl font-semibold mt-6">Permisos:</h3>
            <p>Esta es una lista de solo lectura de todos los permisos disponibles en el sistema. Sirve como referencia al momento de configurar los roles.</p>
        </section>
    </div>
</div>