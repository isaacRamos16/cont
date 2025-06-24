   {{-- [Vista: RETIROS] --}}
   <h1 class="text-center font-bold">Listado de Retiros</h1>
<table id="example" class="display compact nowrap mt-8" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Equipo</th>    
            <th>Moneda</th>
            <th>Denominación</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Fecha Generada</th>
        </tr>
    </thead>
   <tbody>
    @foreach($retiros as $r)
        <tr>
            <td></td>
            <td>{{ $r->id }}</td>
            {{-- <td>{{ optional($r->equipo)->numero_serie ?? 'Sin serie' }}</td> --}}
            <td>{{ $r->id_equipo }}</td>
            <td>{{ $r->moneda }}</td>
            <td>{{ $r->denominacion }}</td>
            <td>{{ $r->cantidad }}</td>
            <td>{{ $r->total }}</td>
            <td>{{ $r->created_at }}</td>
        </tr>
    @endforeach
</tbody>

</table>
