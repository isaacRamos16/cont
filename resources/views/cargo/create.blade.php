<x-layouts.app :title="__('cargo')">

    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('cargo.index')">Cargos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('cargo.create')">Registrar Cargo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    

    <form method="POST" action="{{ route('cargo.store') }}">
        @csrf

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción del Cargo</label>
                <input type="text" id="descripcion" name="descripcion"
                    value="{{ old('descripcion') }}"
                    placeholder="Descripción de Cargo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
            </div>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 
            font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center 
            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Registrar
        </button>
    </form>

</x-layouts.app>
