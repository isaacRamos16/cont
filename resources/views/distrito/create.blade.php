  <x-layouts.app :title="__('Distrito')">

    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('distrito.index')">Distrito</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('distrito.create')">Registrar Distrito</flux:breadcrumbs.item>
    </flux:breadcrumbs>


        <form action="{{ route('distrito.store') }}" method="POST">
        @csrf

        <div class="relative mb-6">
            <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Provincia</label>
            <select id="id_provincia" name="id_provincia" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none select2">
                <option value="">-- Seleccionar Provincia --</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id_provincia }}">{{ $provincia->provincia }}</option>
                @endforeach
            </select>
        </div>

        <div class="relative mb-6">
            <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Distrito</label>
            <input
                type="text"
                name="distrito"
                class="block w-full h-11 px-5 py-2.5 bg-white leading-7 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                placeholder="Nombre del distrito"
                required>
        </div>

        <button type="submit" class="w-40 h-12 bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 rounded-full shadow-xs text-white text-base font-semibold leading-6 mb-6">
            Registrar Distrito
        </button>
    </form>



</x-layouts.app>
