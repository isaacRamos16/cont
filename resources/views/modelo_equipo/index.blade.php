<x-layouts.app :title="__('Modelo Equipo')">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('modelo_equipo.index')">Modelo Equipo</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('modelo_equipo.create')">Registrar Modelo Equipo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Listado de Modelos de Equipo</h1>

   
        <a href="{{ route('modelo_equipo.create') }}">
            <button type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Registrar Modelo de Equipo
            </button>
        </a>


        <table id="example" class="display compact nowrap mt-8" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Nombre de Modelo </th>
             
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modelo_equipo as $item)
                <tr>
                    <td></td>
                    <td>{{ $item->id_modelo }}</td>
                    <td>{{ $item->nombre_modelo }}</td>
                    <td>
                        <div class="grid">
                            <div>
                                <flux:modal.trigger name="edit-{{ $item->id_modelo }}">
                                    <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-yellow-900">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </flux:modal.trigger>
                            </div>
                            <div>
                            <form action="{{ route('modelo_equipo.destroy', $item->id_modelo) }}" method="POST" class="form-eliminar">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-delete  focus:outline-none text-white bg-red-700 hover:bg-red-500 focus:ring-2 focus:ring-red-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-red-900" data-id="{{ $item->id_modelo }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            
                <flux:modal name="edit-{{ $item->id_modelo }}" class="md:w-96">
                    <form method="POST" action="{{ route('modelo_equipo.update', $item->id_modelo) }}">
                        @csrf
                        @method('PUT')
            
                        <div class="space-y-6">
                            <div>
                                <flux:heading size="lg">Editar Modelo de Equipo</flux:heading>
                                <flux:text class="mt-2">Nombre de Modelo de Equipo</flux:text>
                            </div>
            
                            <flux:input
                                type="text"
                                label="Nombre de Modelo"
                                name="nombre_modelo"
                                id="nombre_modelo"
                                value="{{ $item->nombre_modelo }}"
                            />
            
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
