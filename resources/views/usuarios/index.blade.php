<x-layouts.app :title="__('Usuarios')">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.usuarios.index')">Usuarios</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.usuarios.create')">Crear Usuarios</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Listado de Usuarios</h1>

 
        <a href="{{ route('usuarios.create') }}">
            <button type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Registrar Usuarios
            </button>
        </a>
  

    <table id="example" class="display compact nowrap mt-8" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th> 
                <th>Cargo</th>
                <th>Cliente</th>
                <th>Agencia</th>
                <th>Estado</th>
                <th>Admin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> 
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->cargo->descripcion ?? 'N/A' }}</td>
                    <td>{{ $usuario->cliente ? $usuario->cliente->name : 'sin empresa' }}</td>
                    <td>{{ $usuario->Agencia->direccion ?? 'N/A' }}</td>
                    <td>
                        @if($usuario->estado)
                            <span class="text-green-600 font-semibold">Activo</span>
                        @else
                            <span class="text-red-600 font-semibold">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        @if($usuario->es_superadmin)
                            <span class="text-green-600 font-semibold">Super Admin</span>
                        @else
                            <span class="text-gray-500 text-sm">Usuario Normal</span>
                        @endif
                    </td>
                    <td>
                        <div class="grid">
                           
                                <div>
                                    <flux:modal.trigger name="edit-{{ $usuario->id }}">
                                        <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-yellow-900">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </flux:modal.trigger>
                                </div>
                         

                          
                                <div>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="form-eliminar">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-delete  focus:outline-none text-white bg-red-700 hover:bg-red-500 focus:ring-2 focus:ring-red-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-red-900" data-id="{{ $usuario->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                                </div>
                     
                        </div>
                    </td>
                </tr>
             
              
                    <flux:modal name="edit-{{ $usuario->id }}" class="md:w-96">
                        <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
                            @csrf
                            @method('PUT')
                        
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">Editar Usuario</flux:heading>
                                    <flux:text class="mt-2">Datos del Usuario</flux:text>
                                </div>

                                <flux:input label="Nombre de Usuario" name="name" id="name" value="{{ $usuario->name }}"  />
                                <flux:input type="email" label="Correo electrónico" name="email" id="email" value="{{ $usuario->email }}"  />

                                

                           
                                <flux:select label="Cargo" name="id_cargo" id="id_cargo">
                                    @foreach ($cargo as $item)
                                        <option value="{{ $item->id }}" @if($usuario->id_cargo == $item->id) selected @endif>
                                            {{ $item->descripcion }}
                                        </option>
                                    @endforeach
                                </flux:select>
                       
                            


                          <flux:select label="Cliente" name="id_cliente" id="id_cliente_{{ $usuario->id }}" onchange="filtrarAgencias({{ $usuario->id }})">
                            @foreach ($cliente as $item)
                                <option value="{{ $item->id }}" @if($usuario->id_cliente == $item->id) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </flux:select>

                        <flux:select label="Agencia" name="id_agencia" id="id_agencia_{{ $usuario->id }}">
                            @foreach ($agencias->where('id_cliente', $usuario->id_cliente) as $item)
                                <option value="{{ $item->id_agencia }}" @if($usuario->id_agencia == $item->id_agencia) selected @endif>
                                    {{ $item->direccion }}
                                </option>
                            @endforeach
                        </flux:select>

                        

             
                        <flux:select label="¿Es Superadmin?" name="es_superadmin" id="es_superadmin">
                            <option value="1" @if($usuario->es_superadmin) selected @endif>Sí</option>
                            <option value="0" @if(!$usuario->es_superadmin) selected @endif>No</option>
                        </flux:select>
             
                    

                    <flux:select label="Estado" name="estado" id="estado">
                        <option value="1" @if($usuario->estado) selected @endif>Activo</option>
                        <option value="0" @if(!$usuario->estado) selected @endif>Inactivo</option>
                    </flux:select>
        
                

                                <flux:input
                                    type="password"
                                    label="Nueva contraseña (opcional)"
                                    name="password"
                                    id="password"
                                    placeholder="Dejar en blanco para mantener contraseña actual"
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




<script>
    const agenciasPorCliente = @json($agencias->groupBy('id_cliente'));

    function filtrarAgencias(usuarioId) {
        const clienteId = document.getElementById(`id_cliente_${usuarioId}`).value;
        const agenciaSelect = document.getElementById(`id_agencia_${usuarioId}`);

        // Limpiar agencias actuales
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
