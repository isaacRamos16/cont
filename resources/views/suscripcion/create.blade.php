<x-layouts.app :title="__('Suscripciones')">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('suscripcion.index')">Suscripciones</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('suscripcion.create')">Registrar Suscripciones</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Registrar Suscripciones</h1>

    <!-- Formulario para registrar suscripción -->
    <form method="POST" action="{{ route('suscripcion.store') }}">
        @csrf
        <div class="grid grid-cols-2 gap-8">
 
            <!-- Cliente -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cliente</label>
                <select id="id_cliente" name="id_cliente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0">Seleccionar Cliente</option>
                    @foreach ($cliente as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Equipo -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipo</label>
                <select id="id_equipo" name="id_equipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0">Seleccionar Equipo</option>
                    @foreach ($equipo as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre_equipo }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha de inicio -->
            <div>
                <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio de Suscripción</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>

            <!-- Fecha de fin -->
            <div>
                <label for="fecha_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Fin de Suscripción</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>

            <!-- Botón para registrar -->
            <div>
                <button type="submit" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Registrar Suscripción
                </button>
            </div>

        </div>
    </form>
</x-layouts.app>
