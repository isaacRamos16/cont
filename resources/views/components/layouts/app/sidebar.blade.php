@php
$main = [
    [
        'name' => 'Dashboard',
        'icon' => 'home',
        'url' => route('dashboard'),
        'current' => request()->routeIs('dashboard'),
    ],
    [
        'name' => 'Clientes',
        'icon' => 'users',
        'url' => route('admin.clientes.index'),
        'current' => request()->routeIs('admin.clientes.*'),
    ],
    
    [
        'name' => 'Departamentos',
        'icon' => 'users',
        'url' => route('admin.departamento.index'),
        'current' => request()->routeIs('admin.departamento.*'),
    ],
    [
        'name' => 'Provincia',
        'icon' => 'users',
        'url' => route('admin.provincia.index'),
        'current' => request()->routeIs('admin.provincia.*'),
    ],
        [
        'name' => 'Distrito',
        'icon' => 'users',
        'url' => route('admin.distrito.index'),
        'current' => request()->routeIs('admin.distrito.*'),
    ],
     [
        'name' => 'Agencias',
        'icon' => 'users',
        'url' => route('admin.agencias.index'),
        'current' => request()->routeIs('admin.agencias.*'),
    ],
        [
        'name' => 'Cargos',
        'icon' => 'briefcase', // puedes cambiar el icono si prefieres otro
        'url' => route('admin.cargo.index'),
        'current' => request()->routeIs('admin.cargo.*'),
    ],
    [ 
        'name' => 'Usuarios',
        'icon' => 'briefcase', // puedes cambiar el icono si prefieres otro
        'url' => route('admin.usuarios.index'),
        'current' => request()->routeIs('admin.usuarios.*'),
    ],
    [
        'name' => 'Modelo de Equipos',
        'icon' => 'briefcase', // puedes cambiar el icono si prefieres otro
        'url' => route('admin.modelo_equipo.index'),
        'current' => request()->routeIs('admin.modelo_equipo.*'),
    ],
    [
        'name' => 'Equipos',
        'icon' => 'briefcase', // puedes cambiar el icono si prefieres otro
        'url' => route('admin.equipo.index'),
        'current' => request()->routeIs('admin.equipo.*'),
    ],
    [
        'name' => 'Suscripciones',
        'icon' => 'briefcase', // puedes cambiar el icono si prefieres otro
        'url' => route('admin.suscripcion.index'),
        'current' => request()->routeIs('admin.suscripcion.*'),
    ],

   
];
@endphp


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head') 
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>


            <flux:navlist variant="outline">
                <flux:navlist.group class="flex flex-col gap-2">
                    @foreach ($main as $item)
                        <flux:navlist.item
                            :href="$item['url']"
                            :current="$item['current']"
                            icon="{{ $item['icon'] }}"
                            wire:navigate>
                            {{ __($item['name']) }}
                        </flux:navlist.item>
                    @endforeach
                </flux:navlist.group>
            </flux:navlist>
            




            <flux:spacer />
            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts



        @if ($errors->any())
        <script>
            let mensajes = '';
            @foreach ($errors->all() as $error)
                mensajes += '{{ $error }}\n';
            @endforeach
            Swal.fire({
                title: 'Errores en el formulario',
                text: mensajes,
                icon: 'error',
                confirmButtonText: 'Corregir'
            });
        </script>
    @endif

    


    @if(session('success'))
    <script>
        Swal.fire({
            title: '¡Éxito!',
            html: `{!! nl2br(e(session('success'))) !!}`,
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif



    @if(session('error'))
        <script>
            Swal.fire({
                title: 'Error',
                text: "{{ session('error') }}",
                icon: 'error'
            });
        </script>
    @endif
    
        

    <script>
        new DataTable('#example', {
    columnDefs: [
        {
            className: 'dtr-control',
            orderable: false,
            target: 0
        }
    ],
    order: [1, 'asc'],
    responsive: {
        details: {
            type: 'column',
            target: 'tr'
        }
    }
});
    </script>



<script>
    document.addEventListener('click', function (e) {
        // Solo si se hizo clic en el botón con la clase específica
        if (e.target.closest('.btn-delete')) {
            const btn = e.target.closest('.btn-delete');
            const form = btn.closest('form');

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Escoger Departamento',
        });
    });
</script>










    </body>
</html>
