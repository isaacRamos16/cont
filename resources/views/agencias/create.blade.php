<x-layouts.app :title="__('Registrar Agencia')">

<flux:breadcrumbs class="mb-8">
    <flux:breadcrumbs.item :href="route('agencias.index')">Agencias</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('agencias.create')">Registrar Agencia</flux:breadcrumbs.item>
</flux:breadcrumbs>

<form action="{{ route('agencias.store') }}" method="POST" class="">
    @csrf

    <div class="flex gap-x-6 mb-6">
        <div class="w-full relative">
            <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Cliente</label>
            <select id="id_cliente" name="id_cliente" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none select2" required>
                <option value="">Seleccionar cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full relative">
            <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Departamento</label>
            <select id="id_departamento" name="id_departamento" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none select2" required>
                <option value="">Seleccionar departamento</option>
                @foreach ($departamentos as $dep)
                    <option value="{{ $dep->id_departamento }}">{{ $dep->departamento }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex gap-x-6 mb-6">
        <div class="w-full relative">
            <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Provincia</label>
            <select id="id_provincia" name="id_provincia" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none select2" required>
                <option value="">Seleccionar provincia</option>
                @foreach ($provincias as $prov)
                    <option value="{{ $prov->id_provincia }}">{{ $prov->provincia }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full relative">
            <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Distrito</label>
            <select id="id_distrito" name="id_distrito" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none select2" required>
                <option value="">Seleccionar distrito</option>
                @foreach ($distritos as $dis)
                    <option value="{{ $dis->id_distrito }}">{{ $dis->distrito }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="relative mb-6">
        <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Dirección de la Agencia</label>
        <input type="text" name="direccion" class="block w-full h-11 px-5 py-2.5 bg-white leading-7 text-base font-normal shadow-xs text-gray-900 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" placeholder="Ej: Av. Siempre Viva 123" required>
    </div>

    <button class="w-52 h-12 shadow-sm rounded-full bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 text-white text-base font-semibold leading-7">
        Registrar Agencia
    </button>
</form>

{{-- Si deseas encadenar selects más adelante: --}}
{{-- <script src="{{ asset('js/agencia-select-dinamico.js') }}"></script> --}}

</x-layouts.app>
