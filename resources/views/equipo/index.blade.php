<x-layouts.app :title="__('Equipos')">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('equipo.index')">Equipos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('equipo.create')">Registrar Equipo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Listado de Equipos</h1>

    @if (auth()->user()->es_superadmin)
        <a href="{{ route('equipo.create') }}">
            <button type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Registrar Equipo
            </button>
        </a>
    @endif

    <table id="example" class="display compact nowrap mt-8" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Nombre de Equipo</th>
                <th>Numero de Serie</th>
                <th>Cliente</th>
                <th>Agencia</th>
                <th>Modelo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipos as $item)
            <tr>
                <td></td> 
                <td>{{ $item->id }}</td>
                <td>{{ $item->nombre_equipo }}</td>
                <td>{{ $item->numero_serie }}</td>
                <td>{{ $item->cliente->name }}</td>
                <td>{{ $item->agencia->direccion }}</td>
                <td>{{ $item->modeloEquipo->nombre_modelo }}</td>
                <td>
                    <div class="grid2">
                        <div>
                           <flux:modal.trigger name="edit-{{ $item->id }}">
                                    <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-yellow-900">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </flux:modal.trigger>
                        
                        </div>
                        <div>
                          
                            <form action="{{ route('equipo.destroy', $item->id) }}" method="POST" class="form-eliminar">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-delete  focus:outline-none text-white bg-red-700 hover:bg-red-500 focus:ring-2 focus:ring-red-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-red-900" data-id="{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                           
                        </div>

                        <div>
                       <a href="{{ route('equipo.procesar_xml', $item->id) }}"> 
                        <button class="bg-green-600 hover:bg-green-700 text-white text-xs px-2 py-1 rounded-md">
                            <i class="fa-solid fa-gear"></i> Procesar XML
                        </button>
                    </a>



        </div>

                    </div>
                </td>
            </tr>

            <flux:modal name="edit-{{ $item->id }}" class="md:w-96">
                <form method="POST" action="{{ route('equipo.update', $item->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Editar Equipo</flux:heading>
                            <flux:text class="mt-2">Detalles de Equipo</flux:text>
                        </div>
 
                        <flux:input
                            type="text"
                            label="Nombre de Equipo"
                            name="nombre_equipo"
                            id="nombre_equipo"
                            value="{{ $item->nombre_equipo }}"
                        />

                        <flux:input   
                            type="text" 
                            label="Serie de Equipo"  
                            name="serie_equipo"  
                            id="serie_equipo"  
                            value="{{ $item->numero_serie }}"  
                        />

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cliente</label>
                        <select id="id_cliente_{{ $item->id }}" name="id_cliente" onchange="filtrarAgenciasEquipo({{ $item->id }})"   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="0">Seleccionar Cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" 
                                    @if($cliente->id == $item->id_cliente) selected @endif>
                                    {{ $cliente->name }}
                                </option>
                            @endforeach
                        </select>



                         <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agencia</label>
                        <select  id="id_agencia_{{ $item->id }}" name="id_agencia"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="0">Seleccionar Agencia</option>
                            @foreach ($agencias as $a)
                                <option value="{{ $a->id_agencia }}"
                                        @if($a->id_agencia == $item->id_agencia) selected @endif>
                                        {{ $a->direccion }}
                                    </option>

                            @endforeach
                        </select>




                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo Equipo</label>
                        <select id="id_modelo" name="id_modelo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="0">Seleccionar Modelo</option>
                            @foreach ($modelo_equipo as $modelo)   
                                <option value="{{ $modelo->id_modelo }}" 
                                    @if($modelo->id_modelo == $item->id_modelo) selected @endif>
                                    {{ $modelo->nombre_modelo }}
                                </option>
                            @endforeach
                        </select>

                        <div class="flex">
                            <flux:spacer />
                            <flux:button type="submit" variant="primary">Guardar cambios</flux:button>
                        </div>
                    </div>
                </form>
            </flux:modal>
            @endforeach
        </tbody>
    </table>
</x-layouts.app>



<script>
    const agenciasPorCliente = @json($agencias->groupBy('id_cliente'));

    function filtrarAgenciasEquipo(id) {
        const clienteId = document.getElementById(`id_cliente_${id}`).value;
        const agenciaSelect = document.getElementById(`id_agencia_${id}`);
        agenciaSelect.innerHTML = '';

        if (agenciasPorCliente[clienteId]) {
            agenciasPorCliente[clienteId].forEach(agencia => {
                const option = document.createElement('option');
                option.value = agencia.id_agencia;
                option.text = agencia.direccion;
                agenciaSelect.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.text = 'Sin agencias disponibles';
            option.disabled = true;
            agenciaSelect.appendChild(option);
        }
    }
</script>

