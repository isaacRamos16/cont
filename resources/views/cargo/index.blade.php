<x-layouts.app :title="__('Cargos')">

    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('cargo.index')">Cargos</flux:breadcrumbs.item>
    </flux:breadcrumbs>

 

    <a href="{{ route('cargo.create') }}" class="bg-gray-800 mb-8 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">
        Agregar Nuevo Cargo
    </a>

    <table id="example" class="display compact nowrap mt-8" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Descripción</th>
                <th>Fecha Registro</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cargos as $cargo)
                <tr>
                    <td></td>
                    <td>{{ $cargo->id }}</td>
                    <td>{{ $cargo->descripcion }}</td>
                    <td>{{ $cargo->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="grid grid-cols-2 gap-1">
                            <div>
                                <flux:modal.trigger name="edit-{{ $cargo->id }}">
                                    <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-yellow-900">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </flux:modal.trigger>
                            </div>
                            <div>
                            <form action="{{ route('cargo.destroy', $cargo->id) }}" method="POST" class="form-eliminar">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-delete  focus:outline-none text-white bg-red-700 hover:bg-red-500 focus:ring-2 focus:ring-red-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-red-900" data-id="{{ $cargo->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                            </div>
                        </div>

                        {{-- MODAL DE EDICIÓN --}}
                        <flux:modal name="edit-{{ $cargo->id }}" class="md:w-96">
                            <form method="POST" action="{{ route('cargo.update', $cargo) }}">
                                @csrf
                                @method('PUT')
                                <div class="space-y-6">
                                    <div>
                                        <flux:heading size="lg">Editar Cargo</flux:heading>
                                        <flux:text class="mt-2">Datos del Cargo</flux:text>
                                    </div>
                                    <flux:input label="Descripción de Cargo" name="descripcion" id="descripcion" value="{{ $cargo->descripcion }}" />
                                    <div class="flex">
                                        <flux:spacer />
                                        <flux:button type="submit" variant="primary">Guardar cambios</flux:button>
                                    </div>
                                </div>
                            </form>
                        </flux:modal>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



</x-layouts.app>
