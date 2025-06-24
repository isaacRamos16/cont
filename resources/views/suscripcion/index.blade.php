<x-layouts.app :title="__('Suscripciones')">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('suscripcion.index')">Suscripciones</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('suscripcion.create')">Registrar Suscripciones</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Listado de Suscripciones</h1>

    @if (auth()->user()->es_superadmin)
        <a href="{{ route('suscripcion.create') }}">
            <button type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Registrar Suscripción
            </button>
        </a>
    @endif

    <table id="example" class="display compact nowrap mt-8" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Equipo</th>
                <th>Cliente</th>
                <th>Fecha Inicio Suscripción</th>
                <th>Fecha Fin Suscripción</th>
                <th>Estado</th>
                <th>Usuario Encargado</th>
                <th>Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suscripcion as $item)
                <tr>
                    <td></td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->equipo->nombre_equipo }}</td>
                    <td>{{ $item->cliente->name }}</td>
                    <td>{{ $item->fecha_inicio }}</td>
                    <td>{{ $item->fecha_fin }}</td>
                    <td>
                        @if ($item->activa)
                            <span class="text-green-600 font-semibold">Activo</span>
                        @else
                            <span class="text-red-600 font-semibold">Inactivo</span>
                        @endif
                    </td>
                    <td>{{ $item->usuarioAsignado->name }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <div class="grid">
                            <!-- Editar -->
                            <div>
                                <flux:modal.trigger name="edit-{{ $item->id }}">
                                    <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-yellow-900">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </flux:modal.trigger>
                            </div>

                            <!-- Eliminar -->
                            @if (auth()->user()->es_superadmin)
                                <div>
                                <form action="{{ route('suscripcion.destroy', $item->id) }}" method="POST" class="form-eliminar">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-delete  focus:outline-none text-white bg-red-700 hover:bg-red-500 focus:ring-2 focus:ring-red-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-red-900" data-id="{{ $item->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
                <flux:modal name="edit-{{ $item->id }}" class="md:w-96">
    <form method="POST" action="{{ route('suscripcion.update', $item->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Editar Suscripción</flux:heading>
                <flux:text class="mt-2">Detalles de la Suscripción</flux:text>
            </div>

            <!-- Seleccionar Cliente -->
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cliente</label>
            <select id="id_cliente" name="id_cliente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($cliente as $cliente)
                    <option value="{{ $cliente->id }}" @if($cliente->id == $item->id_cliente) selected @endif>{{ $cliente->name }}</option>
                @endforeach
            </select>

            <!-- Seleccionar Equipo -->
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipo</label>
            <select id="id_equipo" name="id_equipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($equipo as $equipo)
                    <option value="{{ $equipo->id }}" @if($equipo->id == $item->id_equipo) selected @endif>{{ $equipo->nombre_equipo }}</option>
                @endforeach
            </select>

            <!-- Fecha de Inicio -->
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Inicio de Suscripción</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ $item->fecha_inicio }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />

            <!-- Fecha de Fin -->
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Fin de Suscripción</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="{{ $item->fecha_fin }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />

            <!-- Estado de la Suscripción -->
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado de Suscripción</label>
            <select id="activa" name="activa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" @if($item->activa == 1) selected @endif>Activa</option>
                <option value="0" @if($item->activa == 0) selected @endif>Inactiva</option>
            </select>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Guardar Cambios</flux:button>
            </div>
        </div>
    </form>
</flux:modal>

            @endforeach
        </tbody>
    </table>

</x-layouts.app>
