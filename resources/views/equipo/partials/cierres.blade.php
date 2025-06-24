{{-- [Vista: CIERRES] --}}
<h1 class="text-center font-bold">Listado de  Cierre de Turno</h1>
<table id="example" class="display compact nowrap mt-8" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Equipo</th>
            <th>Machine ID</th>
            <th>User</th>
            <th>N° Transacción</th>
            <th>Fecha Generada</th>
            <th>Auto Cierre</th>
            <th>Archivo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cierres as $c)
        <tr>
            <td></td>
            <td>{{ $c->id }}</td>
            <td>{{ $c->equipo->numero_serie ?? 'Sin serie' }}</td>
            <td>{{ $c->machine_id }}</td>
            <td>{{ $c->user_name }}</td>
            <td>{{ $c->transaction_no }}</td>
            <td>{{ $c->fecha_generada }}</td>
            <td>{{ $c->automatic_close ? 'Sí' : 'No' }}</td>
            <td>{{ $c->archivo_origen }}</td>
        </tr>
        @endforeach
    </tbody>
</table>