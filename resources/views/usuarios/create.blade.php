<x-layouts.app :title="__('Usuarios')"> 
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('usuarios.index')">Usuarios</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('usuarios.create')">Crear Usuarios</flux:breadcrumbs.item>
    </flux:breadcrumbs>

     

 










    <form method="POST" action="{{ route('usuarios.store') }}">
           @csrf
                  <!-- Estado y superadmin por defecto -->
        <input type="hidden" name="estado" value="0">
        <input type="hidden" name="es_superadmin" value="0">


        <div class="flex gap-x-6 mb-6">
        <div class="w-full relative">
        <label class="flex  items-center mb-2 text-gray-600 text-sm font-medium">Nombre Usuario  </label>
        <input type="text" id="name" name="name"  class="block w-full h-11 px-5 py-2.5 bg-white leading-7 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none " placeholder="Nombre de Usuario" required="">
        </div>
        <div class="w-full relative">
        <label class="flex  items-center mb-2 text-gray-600 text-sm font-medium">Email </label>
        <input type="text" id="email" name="email" class="block w-full h-11 px-5 py-2.5 bg-white leading-7 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none " placeholder="Email" required="">
        </div>
        </div>
        <div class="relative mb-6">
        <label class="flex  items-center mb-2 text-gray-600 text-sm font-medium">Password </label>
        <input type="text" id="password" name="password" class="block w-full h-11 px-5 py-2.5 bg-white leading-7 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none " placeholder="" required="">
        </div>



<div class="flex gap-x-6 mb-6">
    <div class="w-full relative">
        <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Cliente</label>
        <select id="id_cliente" name="id_cliente" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none">
            <option value="">Selecciona un cliente</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="w-full relative">
        <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Agencia</label>
        <select id="id_agencia" name="id_agencia" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none">
            <option value="">Selecciona una agencia</option>
            @foreach ($agencias as $agencia)
                <option value="{{ $agencia->id_agencia }}" data-cliente="{{ $agencia->id_cliente }}">
                    {{ $agencia->direccion }}
                </option>
            @endforeach
        </select>
    </div>




</div>
<div class="relative mb-6">
<label class="flex  items-center mb-2 text-gray-600 text-sm font-medium">Cargo </label>

<select id="id_cargo" name="id_cargo" class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none">

                    @foreach ($cargos as $item)
                 
                        <option value="{{ $item->id }}">
                            {{ $item->descripcion }}
                        </option>
                 
                @endforeach
          
</select>



</div>
<button type="submit"  class="w-52 h-6 shadow-sm rounded-full bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 text-white text-base font-semibold leading-7">
    Registrar Usuario
</button>
</form>








</x-layouts.app>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const clienteSelect = document.getElementById('id_cliente');
    const agenciaSelect = document.getElementById('id_agencia');

    clienteSelect.addEventListener('change', function () {
        const selectedCliente = this.value;

        Array.from(agenciaSelect.options).forEach(option => {
            if (!option.value) {
                option.hidden = false; // Mostrar opción por defecto
                return;
            }

            const clienteId = option.getAttribute('data-cliente');
            option.hidden = (clienteId !== selectedCliente);
        });

        agenciaSelect.value = ""; // Resetear selección
    });
});
</script>
