@foreach( $rows as $row )

    <tr class="align-middle {{\App\Helpers\Grid::getEvenOrOdd()}}">
        <td>
            <a target="_blank" href="{{$row->getUrl()}}">{{$row->unique_id}} - {{$row->name}}</a>
        </td>
        <td>
            <?php  $users     = $row->assigned->pluck('name')->toArray(); ?>
            {{implode(' ', $users)}}
        </td>
        <td><span class="btn {{$row->priority->icon_class}} btn-sm">{{$row->priority->name}}</span></td>
        <td style="width: 100px;text-align: center"><span class="btn {{$row->action->icon_class}} btn-sm">{{$row->action->name}}</span></td>
        <td style="width: 100px;ext-align: center"><span class="btn {{$row->state->icon_class}} btn-sm">{{$row->state->name}}</span></td>
    </tr>
@endforeach
