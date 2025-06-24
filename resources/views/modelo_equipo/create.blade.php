<x-layouts.app :title="__('Modelo Equipo')"> 
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('modelo_equipo.index')">Modelo Equipo</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('modelo_equipo.create')">Registrar Modelo Equipo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Registrar Modelo de Equipos</h1>

    <form action="{{ route('modelo_equipo.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 gap-8 ">
            <div>
                <label for="nombre_modelo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de Modelo de Equipo</label>
                <input type="text" id="nombre_modelo" name="nombre_modelo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Modelo de Equipo" required />
            </div>

            <div>
                <button type="submit" class="px-3 mt-8 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar Modelo de Equipo</button>
            </div>
        </div>
    </form>
</x-layouts.app>