<x-layouts.app :title="__('Clientes')">

<flux:breadcrumbs class="mb-8">
    <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('clientes.index')">Clientes</flux:breadcrumbs.item>
    <flux:breadcrumbs.item :href="route('clientes.create')">Registrar Cliente</flux:breadcrumbs.item>
</flux:breadcrumbs>

<a href="{{ route('clientes.create') }}" class="bg-gray-800 mb-8 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">
    Agregar Nuevos Clientes
</a>

<table id="example" class="display compact nowrap mt-8" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Id</th>
            <th>Name</th>
            <th>RUC</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Email Empresa</th>
            <th>Estado</th>
            <th>Fecha Registro</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td></td>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->name }}</td>
            <td>{{ $cliente->ruc }}</td>
            <td>{{ $cliente->direccion }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->email_empresa }}</td>
            <td>
                @if ($cliente->estado)
                    <span class="text-green-600 font-semibold">Activo</span>
                @else
                    <span class="text-red-600 font-semibold">Inactivo</span>
                @endif
            </td>
            <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <div class="grid">
                    <div>
                        <flux:modal.trigger name="edit-cliente">
                            <button 
                                type="button" 
                                class="btn-editar-cliente bg-yellow-400 hover:bg-yellow-500 text-white font-medium rounded-md text-xs px-2.5 py-1.5"
                                data-id="{{ $cliente->id }}"
                                data-name="{{ $cliente->name }}"
                                data-ruc="{{ $cliente->ruc }}"
                                data-direccion="{{ $cliente->direccion }}"
                                data-telefono="{{ $cliente->telefono }}"
                                data-email="{{ $cliente->email_empresa }}"
                                data-estado="{{ $cliente->estado }}"
                            >
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </flux:modal.trigger>
                    </div>
                    <div>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="form-eliminar">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete bg-red-700 hover:bg-red-500 text-white font-medium rounded-md text-xs px-2.5 py-1.5">
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

<flux:modal name="edit-cliente" class="md:w-96">
    <form id="form-editar-cliente" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <flux:heading size="lg">Editar Cliente</flux:heading>
            <flux:text class="mt-2">Datos del cliente</flux:text>

            <flux:input label="Cliente" name="name" id="edit_name" />
            <flux:input label="RUC" type="number" name="ruc" id="edit_ruc" />
            <flux:input label="Dirección" name="direccion" id="edit_direccion" />
            <flux:input label="Teléfono" type="number" name="telefono" id="edit_telefono" />
            <flux:input label="Email" type="email" name="email_empresa" id="edit_email" />

            <flux:select label="Estado" name="estado" id="edit_estado">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </flux:select>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Guardar cambios</flux:button>
            </div>
        </div>
    </form>
</flux:modal>

<script>
    let clienteData = {};

    document.addEventListener('DOMContentLoaded', function () {
        // Capturar data al hacer clic
        $(document).on('click', '.btn-editar-cliente', function () {
            clienteData = {
                id: $(this).data('id'),
                name: $(this).data('name'),
                ruc: $(this).data('ruc'),
                direccion: $(this).data('direccion'),
                telefono: $(this).data('telefono'),
                email: $(this).data('email'),
                estado: $(this).data('estado')
            };

            // Abrir modal
            document.dispatchEvent(new CustomEvent("flux:open", {
                detail: { name: 'edit-cliente' }
            }));
        });

        // Asignar valores cuando el modal ya está abierto
        document.addEventListener('flux:open', function (event) {
            if (event.detail.name === 'edit-cliente') {
                $('#form-editar-cliente').attr('action', `/clientes/${clienteData.id}`);
                $('#edit_name').val(clienteData.name);
                $('#edit_ruc').val(clienteData.ruc);
                $('#edit_direccion').val(clienteData.direccion);
                $('#edit_telefono').val(clienteData.telefono);
                $('#edit_email').val(clienteData.email);
                $('#edit_estado').val(clienteData.estado).trigger('change');
            }
        });
    });
</script>


</x-layouts.app>
