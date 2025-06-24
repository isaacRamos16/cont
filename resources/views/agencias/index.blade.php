  <x-layouts.app :title="__('Cargos')">

    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('agencias.index')">Agencias</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('agencias.create')">Registrar Agencias</flux:breadcrumbs.item>
    </flux:breadcrumbs>


    <a href="{{ route('agencias.create') }}" class="bg-gray-800 mb-8 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">
        Registrar Nuevas Agencias
    </a>




<table id="example" class="display compact nowrap mt-8" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Cliente</th>               
            <th>Departamento</th>
            <th>Provincia</th>
            <th>Distrito</th>
            <th>Agencia</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($agencias as $item)
        <tr>
            <td></td>
            <td>{{ $item->id_agencia }}</td>
            <td> {{ $item->cliente->name }}  </td>               
             <td>{{ $item->departamento->departamento }}</td>
            <td>{{ $item->provincia->provincia }}</td>
            <td>{{ $item->distrito->distrito }}</td>
            <td>{{ $item->direccion }}</td>
            <td>
              <flux:modal.trigger name="edit-agencia">
                                    <button 
                                        type="button" 
                                        class="btn-editar-agencia focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-yellow-900"
                                        data-id="{{ $item->id_agencia }}"
                                        data-id_cliente="{{ $item->id_cliente }}"
                                        data-id_departamento="{{ $item->id_departamento }}"
                                        data-id_provincia="{{ $item->id_provincia }}"
                                        data-id_distrito="{{ $item->id_distrito }}"
                                        data-direccion="{{ $item->direccion }}"
                                    >
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </flux:modal.trigger>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<flux:modal name="edit-agencia" class="md:w-120">
        <form id="form-editar-agencia" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <flux:heading size="lg">Editar Agencia</flux:heading>

              <label class="block mb-2 text-sm font-medium">Cliente</label>
               <select name="id_cliente" id="edit_id_cliente" class="w-full">
                <option value="">Selecciona Cliente</option>
                @foreach ($clientes as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>


                <label class="block mb-2 text-sm font-medium">Departamento</label>
               <select name="id_departamento" id="edit_id_departamento" class="w-full">
                <option value="">Selecciona Departamento</option>
                @foreach ($departamentos as $d)
                    <option value="{{ $d->id_departamento }}">{{ $d->departamento }}</option>
                @endforeach
            </select>


              <label class="block mb-2 text-sm font-medium">Provincia</label>
               <select name="id_provincia" id="edit_id_provincia" class="w-full">
                <option value="">Selecciona Provincia</option>
                @foreach ($provincias as $p)
                    <option value="{{ $p->id_provincia }}">{{ $p->provincia }}</option>
                @endforeach
            </select>


             <label class="block mb-2 text-sm font-medium">Distrito</label>
               <select name="id_distrito" id="edit_id_distrito" class="w-full">
                <option value="">Selecciona Provincia</option>
                @foreach ($distritos as $d)
                    <option value="{{ $d->id_distrito }}">{{ $d->distrito }}</option>
                @endforeach
            </select>


             <flux:input
                type="text"
                label="direccion"
                name="direccion"
                id="edit_direccion"
            />
                
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Guardar Cambios</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>


<script>
let clienteChoices = null;
let departamentoChoices = null;
let provinciaChoices = null;
let distritoChoices = null;

document.addEventListener('DOMContentLoaded', function () {

    function initChoices() {
        if (clienteChoices) clienteChoices.destroy();
        clienteChoices = new Choices('#edit_id_cliente', {
            searchEnabled: true,
            shouldSort: false,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Seleccione una opción',
        });

        if (departamentoChoices) departamentoChoices.destroy();
        departamentoChoices = new Choices('#edit_id_departamento', {
            searchEnabled: true,
            shouldSort: false,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Seleccione un departamento',
        });

        if (provinciaChoices) provinciaChoices.destroy();
        provinciaChoices = new Choices('#edit_id_provincia', {
            searchEnabled: true,
            shouldSort: false,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Seleccione una provincia',
        });

        if (distritoChoices) distritoChoices.destroy();
        distritoChoices = new Choices('#edit_id_distrito', {
            searchEnabled: true,
            shouldSort: false,
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Seleccione un distrito',
        });
    }

    $(document).on('click', '.btn-editar-agencia', function () {
        const id = $(this).data('id');
        const id_cliente = $(this).data('id_cliente');
        const id_departamento = $(this).data('id_departamento');
        const id_provincia = $(this).data('id_provincia');
        const id_distrito = $(this).data('id_distrito');
            const direccion = $(this).data('direccion');


        console.log('✏️ Editando :', { id, id_cliente, id_departamento, id_provincia, id_distrito });

        $('#form-editar-agencia').attr('action', `/agencias/${id}`);

        document.dispatchEvent(new CustomEvent("flux:open", {
            detail: { name: 'edit-agencia' }
        }));

        setTimeout(() => {
            initChoices();

            if (clienteChoices && id_cliente) {
                clienteChoices.setChoiceByValue(id_cliente.toString());
            }
            if (departamentoChoices && id_departamento) {
                departamentoChoices.setChoiceByValue(id_departamento.toString());
            }
            if (provinciaChoices && id_provincia) {
                provinciaChoices.setChoiceByValue(id_provincia.toString());
            }
            if (distritoChoices && id_distrito) {
                distritoChoices.setChoiceByValue(id_distrito.toString());
            }

               // 🆕 Asignar dirección al input
        document.getElementById('edit_direccion').value = direccion ?? '';

        }, 300);
    });

});

</script>







</x-layouts.app> 
 