<x-layouts.app >
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('equipo.index')">Equipos</flux:breadcrumbs.item>
    </flux:breadcrumbs>


<div class="shadow-md p-8">


<h1 for="" class="mt-4 mb-4">Detalles de Equipo</h1>
<div class="grid3 mt-4">
    
    <h1 class="">Modelo: {{ $equipo->nombre_equipo }} </h1>   
    <h1 class="">Serie : {{ $equipo->numero_serie }} </h1>   
    <h1 class="">Cliente : {{ $equipo->cliente->name ?? 'Sin cliente asignado' }} </h1>
    <h1 class="">Agencia : {{ $equipo->agencia->direccion ?? 'Sin Agencia Asignada' }} </h1>
</div>

             
<div class="grid3 mt-4 mb-4"> 
    <div class="mt-4">
        <flux:field>
            <flux:label>Fecha de Inicio</flux:label>             
            <flux:input type="date" name="fecha_inicio" id="fecha_inicio"/>
            <flux:error name="fecha_inicio" />
        </flux:field>
    </div>
    <div class="mt-4">
        <flux:field>
            <flux:label>Fecha de Fin</flux:label>             
            <flux:input type="date" name="fecha_fin" id="fecha_fin"/>
            <flux:error name="fecha_fin" />
        </flux:field>
    </div>
    <div class="mt-4">
        <flux:field>
            <flux:label>Buscar por Rango de Fecha</flux:label>             
            <flux:button id="btnFiltrarFechas" variant="primary" size="sm">Aplicar Filtro</flux:button>
        </flux:field>
    </div>

     <div class="mt-4">
        <flux:field>
            <flux:label>Eliminar Rango de Fecha</flux:label>             
            <flux:button id="btnEliminarFiltro" variant="danger" size="sm">Eliminar Filtro</flux:button>
        </flux:field>
    </div>
</div>








          
 




<div id="contenedorDatosXml"  data-id="{{ $equipo->id }}"  class="p-4 text-center text-gray-500">
    <i class="fa-solid fa-spinner fa-spin text-xl text-blue-500"></i>
    <p class="mt-2">Cargando datos...</p>
</div>




<div class="pt-12" id="mostrar_tabla">

</div>



</div>



<script>
function asignarEventosParciales() {
    const contenedor = document.getElementById('mostrar_tabla');
    const resumenContenedor = document.getElementById('contenedorDatosXml');
    let currentAbortController = null;

    // 🗓️ Obtener parámetros de fechas del formulario
    function obtenerParametrosFecha() {
        const inicio = document.getElementById('fecha_inicio')?.value;
        const fin = document.getElementById('fecha_fin')?.value;
        const params = new URLSearchParams();
        if (inicio) params.append('fecha_inicio', inicio);
        if (fin) params.append('fecha_fin', fin);
        return params.toString();
    }

    // 🔁 Cargar contenido parcial con filtros si aplica
    function cargarParcial(url, tipo, target = 'tabla', incluirFechas = true, callback = null) {
        const query = incluirFechas ? obtenerParametrosFecha() : '';
        const urlFinal = query ? `${url}?${query}` : url;

        console.log('🔁 Solicitando:', urlFinal);

        if (currentAbortController) currentAbortController.abort();
        currentAbortController = new AbortController();
        const { signal } = currentAbortController;

        const destino = (target === 'resumen') ? resumenContenedor : contenedor;

        destino.innerHTML = '';
        requestAnimationFrame(() => {
            destino.innerHTML = '⏳ Cargando ' + tipo + '...';

            fetch(urlFinal, { signal })
                .then(res => {
                    if (!res.ok) throw new Error(`Error al obtener ${tipo}`);
                    return res.text();
                })
                .then(html => {
                    const match = html.match(/\[Vista:\s(.*?)\]/);
                    const vista = match ? match[1] : tipo ?? 'Desconocida';
                    console.log(`📄 Vista parcial cargada: ${vista}`);

                    destino.innerHTML = html;

                    if (target === 'tabla') {
                        new DataTable('#example', {
                            columnDefs: [{ className: 'dtr-control', orderable: false, target: 0 }],
                            order: [1, 'asc'],
                            responsive: { details: { type: 'column', target: 'tr' } }
                        });
                    }

                    asignarEventosParciales();

                    if (typeof callback === 'function') callback();
                })
                .catch(err => {
                    if (err.name === 'AbortError') {
                        console.log('⏹️ Solicitud cancelada:', tipo);
                    } else {
                        destino.innerHTML = `❌ Error al cargar ${tipo}`;
                        console.error('❌ Error JS:', err);
                    }
                });
        });
    }

    function deshabilitarTemporalmente(boton) {
        boton.disabled = true;
        setTimeout(() => boton.disabled = false, 1000);
    }

    document.getElementById('btnListarDepositos')?.addEventListener('click', e => {
        e.preventDefault();
        deshabilitarTemporalmente(e.currentTarget);
        cargarParcial('/equipo/partial/depositos', 'DEPÓSITOS', 'tabla');
    });

    document.getElementById('btn-retiros')?.addEventListener('click', e => {
        e.preventDefault();
        deshabilitarTemporalmente(e.currentTarget);
        cargarParcial('/equipo/partial/retiros', 'RETIROS', 'tabla');
    });

    document.getElementById('mostrar_eventos')?.addEventListener('click', e => {
        e.preventDefault();
        deshabilitarTemporalmente(e.currentTarget);
        cargarParcial('/equipo/partial/eventos', 'EVENTOS', 'tabla');
    });

    document.getElementById('cierre_turno')?.addEventListener('click', e => {
        e.preventDefault();
        deshabilitarTemporalmente(e.currentTarget);
        cargarParcial('/equipo/partial/cierres', 'CIERRES', 'tabla');
    });

    document.getElementById('listar_xml')?.addEventListener('click', e => {
        e.preventDefault();
        const btn = e.currentTarget;
        const serie = btn.dataset.serie;
        deshabilitarTemporalmente(btn);

        if (currentAbortController) currentAbortController.abort();
        currentAbortController = new AbortController();

        const url = `/equipo/partial/xmls/${serie}`;

        contenedor.innerHTML = '⏳ Cargando XML...';
        console.log('📥 Solicitando archivos XML de la serie:', serie);

        fetch(url, { signal: currentAbortController.signal })
            .then(res => {
                if (!res.ok) throw new Error(`Servidor respondió con estado ${res.status}`);
                return res.text();
            })
            .then(html => {
                const match = html.match(/\[Vista:\s(.*?)\]/);
                const vista = match ? match[1] : 'XMLS';
                console.log(`📄 Vista parcial cargada: ${vista}`);

                contenedor.innerHTML = html;

                new DataTable('#example', {
                    columnDefs: [{ className: 'dtr-control', orderable: false, target: 0 }],
                    order: [1, 'asc'],
                    responsive: { details: { type: 'column', target: 'tr' } }
                });

                asignarEventosParciales();
            })
            .catch(err => {
                if (err.name === 'AbortError') {
                    console.log('⏹️ Solicitud cancelada: XML');
                } else {
                    contenedor.innerHTML = '❌ Error al cargar archivos XML';
                    console.error('❌ Error JS:', err);
                }
            });
    });

    document.getElementById('btnFiltrarFechas')?.addEventListener('click', e => {
        e.preventDefault();
        const equipoId = resumenContenedor?.dataset.id;
        if (!equipoId) {
            console.warn('⚠️ No se encontró el data-id en #contenedorDatosXml');
            return;
        }
        cargarParcial(`/equipo/${equipoId}/cargar-datos`, 'RESUMEN DE DATOS', 'resumen');
    });

    // 🧹 Botón Eliminar Filtro
    document.getElementById('btnEliminarFiltro')?.addEventListener('click', e => {
        e.preventDefault();

        const inputInicio = document.getElementById('fecha_inicio');
        const inputFin = document.getElementById('fecha_fin');
        if (inputInicio) inputInicio.value = '';
        if (inputFin) inputFin.value = '';

        const equipoId = resumenContenedor?.dataset.id;
        if (!equipoId) {
            console.warn('⚠️ No se encontró el data-id en #contenedorDatosXml');
            return;
        }

        // Ocultar la tabla mostrada
        contenedor.innerHTML = '';

        cargarParcial(`/equipo/${equipoId}/cargar-datos`, 'RESUMEN DE DATOS', 'resumen', false, () => {
            Swal.fire({
                icon: 'success',
                title: '✅ Filtro eliminado',
                text: 'Se actualizaron los datos sin rango de fechas.',
                timer: 1800,
                showConfirmButton: false
            });
        });
    });
}
</script>






<script>
document.addEventListener('DOMContentLoaded', function () {
    const equipoId = {{ $equipo->id }};
    const contenedor = document.getElementById('contenedorDatosXml');

    fetch(`/admin/equipo/${equipoId}/cargar-datos`)
        .then(res => {
            if (!res.ok) throw new Error('Error al cargar datos');
            return res.text();
        })
        .then(html => {
            contenedor.innerHTML = html;

            // Esperar que los elementos ya existan para asignar los eventos
            asignarEventosParciales();
        })
        .catch(err => {
            contenedor.innerHTML = '<p class="text-red-600">❌ Error al cargar los datos.</p>';
            console.error(err);
        });
});
</script>



</x-layouts.app> 
