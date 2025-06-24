<x-layouts.app :title="__('Provincia')">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('provincia.index')">Provincia</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('provincia.create')">Registrar Provincia</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Registrar Provincia</h1>
 
   
    <form method="POST" action="{{ route('provincia.store') }}">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                <select name="id_departamento" id="id_departamento" required
                class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500">
            
                    <option value="0">Escoger Departamento</option>
                    @foreach ($departamento as $item)
                        <option value="{{ $item->id_departamento }}">{{ $item->departamento }}</option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provincia</label>
                <input type="text" name="provincia" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500"
                    placeholder="Provincia" />
            </div>
        </div>
    
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
            Registrar Provincia
        </button>
    </form>
    


</x-layouts.app>


