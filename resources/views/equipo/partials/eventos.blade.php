{{-- [Vista: EVENTOS] --}}
<h1 class="text-center font-bold">Listado de  Eventos</h1>
<table id="example" class="display compact nowrap mt-8" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Equipo</th>
            <th>Machine ID</th>
            <th>User Name</th>
            <th>Transaction</th>
            <th>Función</th>
            <th>Detalle</th>
            <th>Fecha Generada</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventos as $e)
        <tr>
            <td></td>
            <td>{{ $e->id }}</td>
            <td>{{ $e->equipo->numero_serie ?? 'Sin serie' }}</td>
            <td>{{ $e->machine_id }}</td>
            <td>{{ $e->user_name }}</td>
            <td>{{ $e->transaction_no }}</td>
            <td>{{ $e->function }}</td>
            <td>{{ $e->status_detalle }}</td>
            <td>{{ $e->fecha_generada }}</td>
        </tr>
        @endforeach
    </tbody>
</table>