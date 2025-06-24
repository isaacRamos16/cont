<x-layouts.app :title="__('Clientes')">
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.clientes.index')">Clientes</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.clientes.create')">Registrar Cliente</flux:breadcrumbs.item>
    </flux:breadcrumbs>

  
    <form method="POST" action="{{ route('admin.clientes.store') }}">
        @csrf

        <div class="grid gap-6 mb-6 md:grid-cols-2">

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Cliente</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nombre de Cliente"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RUC</label>
                <input type="text" id="ruc" name="ruc" value="{{ old('ruc') }}" placeholder="RUC"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" placeholder="Dirección"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" id="email_empresa" name="email_empresa" value="{{ old('email_empresa') }}" placeholder="Email"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                       dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

        </div>

        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
                       focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto 
                       px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 
                       dark:focus:ring-blue-800">
            Registrar Cliente
        </button>
    </form>
</x-layouts.app>
