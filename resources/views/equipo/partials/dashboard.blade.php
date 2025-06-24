<div>
    <x-dashboard-card 
        icon="heroicon-s-currency-dollar"
        title="Depósitos"
        value="€ {{ number_format($totalEuros, 2) }}"
        soles="S/. {{ number_format($totalSoles, 2) }}"
        dolar="$ {{ number_format($totalDolares, 2) }}"
        color="green"
        linkText="Listado de Depósitos"
        linkUrl="#"
        onclick="cargarListadoDepositos({{ $equipo->id }})"
    />
</div>


    <div>
        <x-dashboard-card 
            icon="heroicon-s-chart-bar"
            title="Retiros"
            value="€ {{ number_format($totalRetirosEuros, 2) }}"
            soles="S/. {{ number_format($totalRetirosSoles, 2) }}"
            dolar="$ {{ number_format($totalRetirosDolares, 2) }}"
            color="red"
            linkText=" listado de Retiros"
            linkUrl="#"
        />
    </div>

    <div>
        <x-dashboard-card 
            icon="heroicon-s-receipt-refund"
            title="Eventos"
            value="Status: {{ $totalEventosStatus }}"
            pick="Pickup: {{ $totalEventosPickup }}"
            color="cyan"
            linkText=" listado de Eventos"
            linkUrl="#"
        />
    </div>

    <div>
        <x-dashboard-card 
            icon="heroicon-s-x-mark"
            title="Cierre Turno"
            value="{{ $totalCierresTurno }}"
            color="stone"
            linkText=" listado de Cierre Turno"
            linkUrl="#"
        />
    </div>

    <div>
        <x-dashboard-card
            icon="heroicon-s-x-mark"
            title="XML sin procesar"
            value="{{ $xmlCount }}"
            color="blue"
            linkText=" listado de XML sin procesar"
            linkUrl="#"
        />
    </div>
