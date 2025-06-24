<x-layouts.app :title="__('Equipos')"> 
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('equipo.index')">Equipos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('equipo.create')">Registrar Equipo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Registrar Nuevo Equipo</h1>

    <form method="POST" action="{{ route('equipo.store') }}">
        @csrf

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <!-- Nombre Equipo -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de Equipo</label>
                <input type="text" id="nombre_equipo" name="nombre_equipo" required placeholder="Nombre de Equipo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>

            <!-- Numero de Serie -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de Serie</label>
                <input type="text" id="numero_serie" name="numero_serie" required placeholder="Número de Serie"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>

            <!-- Clientes -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cliente</label>
                <select id="id_cliente" name="id_cliente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0">Seleccionar Cliente</option>
                    @foreach ($clientes as $item)   
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Modelo Equipo -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo Equipo</label>
                <select id="id_modelo" name="id_modelo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0">Seleccionar Modelo</option>
                    @foreach ($modelo_equipo as $item)   
                        <option value="{{ $item->id_modelo }}">{{ $item->nombre_modelo }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Botón Registrar -->
        <div class="flex  mt-4">
            <button type="submit" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Registrar Equipo
            </button>
        </div>
    </form>
</x-layouts.app>
