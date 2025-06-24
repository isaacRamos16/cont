
<div class="mt-4 dash" >
    <div class="card  w-full grid_superior shadow-md shadow-cyan-500/50 p-4 rounded-md">
      
        <div class="px-6 py-4">
        
            <div class="card_detail">
                <div class="item_1"><h1 class="text-2xl text-cyan-500">Depósitos</h1></div>

                <div class="item_2">Euros</div>
                <div class="item_2">{{ number_format($totales['EUR'] ?? 0, 2) }}</div>

                <div class="item_2">Soles</div>
                <div class="item_2">{{ number_format($totales['PEN'] ?? 0, 2) }}</div>

                <div class="item_2">Dólares</div>
                <div class="item_2">{{ number_format($totales['USD'] ?? 0, 2) }}</div>
            </div>

        </div>
        <div class="px-6 pt-4 pb-2">
             <a href="#" id="btnListarDepositos" 
            class="mt-4 text-white bg-cyan-700 hover:bg-cyan-800 focus:outline-none focus:ring-4 focus:ring-cyan-300 font-medium rounded-full text-xs px-3 py-1.5 text-center me-2 mb-2 dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800">
            Listar Depósitos
            </a>

        </div>

    </div>




     <div class="card  w-full grid_superior shadow-md shadow-red-500/50 p-4 rounded-md">
      
        <div class="px-6 py-4">
        
                <div class="card_detail">
                <div class="item_1"><h1 class="text-2xl text-red-500">Retiros</h1></div>

                <div class="item_2">Euros</div>
                <div class="item_2">{{ number_format($retiros['EUR'] ?? 0, 2) }}</div>

                <div class="item_2">Soles</div>
                <div class="item_2">{{ number_format($retiros['PEN'] ?? 0, 2) }}</div>

                <div class="item_2">Dólares</div>
                <div class="item_2">{{ number_format($retiros['USD'] ?? 0, 2) }}</div>
            </div>

        </div>
        <div class="px-6 pt-4 pb-2">
                <a href="#" id="btn-retiros" class="mt-4 text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-xs px-3 py-1.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Listar Retiros
            </a>

        </div>
    </div>




      <div class="card  w-full grid_superior shadow-md shadow-yellow-500/50 p-4 rounded-md">
      
        <div class="px-6 py-4">
        
                   <div class="card_detail">
                    <div class="item_1"><h1 class="text-2xl text-yellow-500">Eventos</h1></div>

                    <div class="item_2">Status</div>
                    <div class="item_2">{{ $eventos['Status'] ?? 0 }}</div>

                    <div class="item_2">Pickup</div>
                    <div class="item_2">{{ $eventos['PickupDeposit'] ?? 0 }}</div>
                </div>

        </div>
        <div class="px-6 pt-13 pb-2">
                <a href="" id="mostrar_eventos"  class="mt-4 text-white bg-yellow-700 hover:bg-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-xs px-3 py-1.5 text-center me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                Listar Eventos
                </a>
        </div>
    </div>



    
      <div class="card  w-full grid_superior shadow-md shadow-gray-500/50 p-4 rounded-md">
      
        <div class="px-6 py-4">
        
                  <div class="card_detail">
                    <div class="item_1"><h1 class="text-2xl text-gray-500">Cierre de Turno</h1></div>

                    <div class="item_2">Total de Cierre de Turno</div>
                    <div class="item_2">{{ $cierres }}</div>                 
                </div>

        </div>
        <div class="px-6 pt-8 pb-2">
                <a href="" id="cierre_turno"  class="mt-4 text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-xs px-3 py-1.5 text-center me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Listar Cierre de Turno
                </a>
        </div>
    </div>



     <div class="card  w-full grid_superior shadow-md shadow-stone-500/50 p-4 rounded-md">
      
        <div class="px-6 py-4">
        
                 <div class="card_detail">
                    <div class="item_1"><h1 class="text-2xl text-stone-500">XML</h1></div>
                    <div class="item_2">XML sin Leer</div>
                    <div class="item_2">{{ $totalXml }}</div>         
                </div>

        </div>
        <div class="px-6 pt-18 pb-2">
                <a href="" id="listar_xml"  data-serie="{{ $equipo->numero_serie }}"  class="mt-4 text-white bg-stone-700 hover:bg-stone-800 focus:outline-none focus:ring-4 focus:ring-stone-300 font-medium rounded-full text-xs px-3 py-1.5 text-center me-2 mb-2 dark:bg-stone-600 dark:hover:bg-stone-700 dark:focus:ring-stone-800">
                Listar XML
                </a>
        </div>
    </div>

</div>