
{{-- [Vista: DEPOSITOS] --}}

<h1 class="text-center font-bold">Listado de  Depositos</h1>
<table id="example" class="display compact nowrap mt-8" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Equipo</th>    
            <th>Machine ID</th>                          
            <th>User Name</th>
            <th>N° Transacción</th>
            <th>Moneda</th>
            <th>Denominación</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Fecha Generada</th>
        </tr>
    </thead>
    <tbody>
        @foreach($depositos as $d)
        <tr>
            <td></td>
            <td>{{ $d->id }}</td>
           <td>{{ $d->equipo->numero_serie ?? 'Sin serie' }}</td>

            <td>{{ $d->machine_id }}</td>
            <td>{{ $d->user_name }}</td>
            <td>{{ $d->transaction_no }}</td>
            <td>{{ $d->moneda }}</td>
            <td>{{ $d->denominacion }}</td>
            <td>{{ $d->cantidad }}</td>
            <td>
                @php
                    switch($d->moneda) {
                        case 'PEN':
                            echo 'S/. ' . number_format($d->total, 2);
                            break;
                        case 'USD':
                            echo '$ ' . number_format($d->total, 2);
                            break;
                        case 'EUR':
                            echo '€ ' . number_format($d->total, 2);
                            break;
                        default:
                            echo number_format($d->total, 2);
                    }
                @endphp
            </td>
            <td>{{ $d->fecha_generada }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
