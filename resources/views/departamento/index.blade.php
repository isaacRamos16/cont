<x-layouts.app :title="__('Departamento')">

<flux:breadcrumbs class="mb-8">
    <flux:breadcrumbs.item :href="route('departamento.index')">Departamento</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('departamento.create')">Registrar Departamento</flux:breadcrumbs.item>
</flux:breadcrumbs>

<a href="{{ route('departamento.create') }}">
    <button type="button" class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
        Registrar Departamento
    </button>
</a>

<table id="example" class="display compact nowrap mt-8" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Departamento</th>               
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departamento as $item)
        <tr>
            <td></td>
            <td>{{ $item->id_departamento }}</td>
            <td>{{ $item->departamento }}</td>               
            <td>
                <div class="grid">
                    <div>
                        <flux:modal.trigger name="edit-departamento">
                            <button 
                                type="button" 
                                class="btn-editar-departamento focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 rounded-md text-xs px-2.5 py-1.5"
                                data-id="{{ $item->id_departamento }}"
                                data-departamento="{{ $item->departamento }}"
                            >
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </flux:modal.trigger>
                    </div>
                    <div>
                        <form action="{{ route('departamento.destroy', $item->id_departamento) }}" method="POST" class="form-eliminar">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete text-white bg-red-700 hover:bg-red-500 rounded-md text-xs px-2.5 py-1.5">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<flux:modal name="edit-departamento" class="md:w-96">
    <form id="form-editar-departamento" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <flux:heading size="lg">Editar Departamento</flux:heading>
            <flux:text class="text-sm">Modifica el nombre del departamento.</flux:text>

            <flux:input
                type="text"
                label="Departamento"
                name="departamento"
                id="edit_departamento"
            />

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Guardar cambios</flux:button>
            </div>
        </div>
    </form>
</flux:modal>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.btn-editar-departamento', function () {
            const id = $(this).data('id');
            const nombre = $(this).data('departamento');

            $('#edit_departamento').val(nombre);
            $('#form-editar-departamento').attr('action', `/departamento/${id}`);
        });
    });
</script>

</x-layouts.app>
