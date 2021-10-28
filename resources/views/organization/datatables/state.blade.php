<p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
@switch ($row->state)
    @case('Andalucía')
        bg-green-100 text-green-800
        @break
    @case('Aragón')
        bg-red-100 text-red-800
        @break
    @case('Asturias, Principado de')
        bg-blue-100 text-blue-800
        @break
    @case('Balears, Illes')
        bg-yellow-100 text-red-800
        @break
    @case('Catalunya')
        bg-red-800 text-yellow-100
        @break
    @case('Canarias')
        bg-yellow-300 text-blue-800
        @break
    @case('Cantabria')
        bg-red-600 text-white
        @break
    @case('Castilla - La Mancha')
        bg-red-900 text-white
        @break
    @case('Extremadura')
        bg-green-600 text-white
        @break
@endswitch
    ">
    {{ $row->state }}
</p>
