<x-layouts.app :title="__('Departamento')">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('departamento.index')">Departamento</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('departamento.create')">Registrar Departamento</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Registrar Departamentos</h1>





    <form method="POST" action="{{ route('departamento.store') }}">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
            <input
                type="text"
                id="departamento"
                name="departamento"
                value="{{ old('departamento') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('departamento') border-red-500 @enderror"
                placeholder="Departamento"
                required
            />

            @error('departamento')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar Departamento</button>
</form>





</x-layouts.app>
