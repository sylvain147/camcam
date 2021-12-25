@foreach($songs as $song)
    <tr class="text-gray-700 @if($song->selected) bg-green-200 @else bg-red-200 @endif">
        <td class="px-4 py-3 border">
            {{$song->name}}
        </td>
        <td class="px-4 py-3 text-ms font-semibold border">{{$song->artist->name}}</td>
        <td class="px-4 py-3 text-xs border">
            {{\Carbon\Carbon::parse($song->release_date)->format('d/m/Y')}}
        </td>
        <td class="px-4 py-3 text-xs border">

            @foreach($song->selectedBy() as $selected)
                    {{$selected->name}}<br>
            @endforeach
        </td>

    </tr>

@endforeach
