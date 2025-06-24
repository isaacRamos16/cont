<x-layouts.app :title="__('Provincia')"> 
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('provincia.index')">Provincia</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('provincia.create')">Registrar Provincia</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <h1 class="text-xl font-bold mb-4">Listado de Provincia</h1>

    <a href="{{ route('provincia.create') }}">
        <button type="button" class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Registrar Provincia
        </button>
    </a>

    <table id="example" class="display compact nowrap mt-8" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Departamento</th>    
                <th>Provincia</th>                          
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($provincia as $item)
            <tr>
                <td></td>
                <td>{{ $item->id_provincia }}</td>
                <td>{{ $item->departamento->departamento }}</td>
                <td>{{ $item->provincia }}</td>               
                <td>
                    <div class="grid">
                        <div>
                            <flux:modal.trigger name="edit-provincia">
                                <button 
                                    type="button" 
                                    class="btn-editar-provincia focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 font-medium rounded-md text-xs px-2.5 py-1.5 dark:focus:ring-yellow-900"
                                    data-id="{{ $item->id_provincia }}"
                                    data-provincia="{{ $item->provincia }}"
                                    data-departamento="{{ $item->id_departamento }}"
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

    <flux:modal name="edit-provincia" class="md:w-96">
        <form id="form-editar-provincia" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <flux:heading size="lg">Editar Provincia</flux:heading>

                <label class="block mb-2 text-sm font-medium">Departamento</label>
                <select name="id_departamento" id="edit_id_departamento" class=" w-full">
                    <option value="">Escoger Departamento</option>
                    @foreach ($departamento as $dep)
                        <option value="{{ $dep->id_departamento }}">{{ $dep->departamento }}</option>
                    @endforeach
                </select>

                <flux:input
                    type="text"
                    label="Provincia"
                    name="provincia"
                    id="edit_provincia"
                />

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Guardar Cambios</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</x-layouts.app>

<script>
    let departamentoChoices = null;

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-editar-provincia');

        // Inicializar Choices para el select de departamento
        function initDepartamentoChoices() {
            if (departamentoChoices) departamentoChoices.destroy();

            departamentoChoices = new Choices('#edit_id_departamento', {
                searchEnabled: true,
                shouldSort: false,
                itemSelectText: '',
                placeholder: true,
                placeholderValue: 'Escoger Departamento',
            });
        }

        document.addEventListener('click', function (event) {
            const button = event.target.closest('.btn-editar-provincia');
            if (!button) return;

            const id = button.dataset.id;
            const provincia = button.dataset.provincia;
            const departamento = button.dataset.departamento;

            document.querySelector('#edit_provincia').value = provincia || '';

            // Establecer acción del formulario
            form.action = `/provincia/${id}`;

            // Abrir modal
            document.dispatchEvent(new CustomEvent("flux:open", {
                detail: { name: 'edit-provincia' }
            }));

            // Inicializar Choices y preseleccionar
            setTimeout(() => {
                initDepartamentoChoices();

                if (departamentoChoices && departamento) {
                    departamentoChoices.setChoiceByValue(departamento.toString());
                }
            }, 300);
        });
    });
</script>

