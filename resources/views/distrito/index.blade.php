<x-layouts.app :title="__('Distrito')">

    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('distrito.index')">Distrito</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('distrito.create')">Registrar Distrito</flux:breadcrumbs.item>
    </flux:breadcrumbs>


 <a href="{{ route('distrito.create') }}">
            <button type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Registrar Distrito
            </button>
        </a>

 <table id="example" class="display compact nowrap mt-8" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Provincia</th>    
                <th>Distrito</th>                          
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distritos as $item)
                <tr>
                    <td></td>
                    <td>{{ $item->id_distrito }}</td>
                    <td>{{ $item->provincia->provincia }}</td>
                    <td>{{ $item->distrito }}</td>               
                    <td>
                        <div class="grid">
                            <div>
                                <flux:modal.trigger name="edit-distrito">
                                    <button 
                                        type="button" 
                                        class="btn-editar-distrito focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-yellow-900"
                                        data-id="{{ $item->id_distrito }}"
                                        data-distrito="{{ $item->distrito }}"
                                        data-id_provincia="{{ $item->id_provincia }}"
                                    >
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </flux:modal.trigger>
                            </div>
                        </div>
                    </td>                
                </tr>
            @endforeach
        </tbody>
    </table>

    <flux:modal name="edit-distrito" class="md:w-96">
        <form id="form-editar-distrito" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <flux:heading size="lg">Editar Distrito</flux:heading>

                <label class="block mb-2 text-sm font-medium">Provincia</label>
                <select name="id_provincia" id="edit_id_provincia" class=" w-full">
                    <option value="">Seleccione una provincia</option>
                    @foreach ($provincias as $prov)
                        <option value="{{ $prov->id_provincia }}">{{ $prov->provincia }}</option>
                    @endforeach
                </select> 

                <flux:input
                    type="text"
                    label="Distrito"
                    name="distrito"
                    id="edit_distrito"
                />

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Guardar Cambios</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>



 <script>
    let provinciaChoices = null;

    document.addEventListener('DOMContentLoaded', function () {

        function initProvinciaChoices() {
            if (provinciaChoices) provinciaChoices.destroy();

            provinciaChoices = new Choices('#edit_id_provincia', {
                searchEnabled: true,
                shouldSort: false,
                itemSelectText: '',
                placeholder: true,
                placeholderValue: 'Seleccione una provincia',
            });
        }

        $(document).on('click', '.btn-editar-distrito', function () {
            const id = $(this).data('id');
            const distrito = $(this).data('distrito');
            const id_provincia = $(this).data('id_provincia');

            console.log('✏️ Editando distrito:', { id, distrito, id_provincia });

            $('#edit_distrito').val(distrito);
            $('#form-editar-distrito').attr('action', `/distrito/${id}`);

            document.dispatchEvent(new CustomEvent("flux:open", {
                detail: { name: 'edit-distrito' }
            }));

            setTimeout(() => {
                initProvinciaChoices();

                if (provinciaChoices && id_provincia) {
                    provinciaChoices.setChoiceByValue(id_provincia.toString());
                }
            }, 300);
        });
    });
</script>


</x-layouts.app>