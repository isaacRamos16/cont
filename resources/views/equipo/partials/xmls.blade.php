    {{-- [Vista: XMLS] --}}
    <h1 class="text-center font-bold">Listado de XML's</h1>
<div class="px-4 py-2">
    <div class="text-sm text-gray-600 mb-4 font-semibold">
        {{ $mensaje }}
    </div>

    <table id="example" class="display compact nowrap" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Serie</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($archivosXml as $archivo)
                <tr>
                    <td></td>
                    <td>{{ $archivo['nombre'] }}</td>
                    <td>{{ $archivo['serie'] }}</td>
                    <td>
                        <a href="{{ route('descargar.xml', ['serie' => $archivo['serie'], 'archivo' => $archivo['nombre']]) }}"
                           class="text-blue-600 hover:underline"
                           target="_blank">
                            Descargar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>