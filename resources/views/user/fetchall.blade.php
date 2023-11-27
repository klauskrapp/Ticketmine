@foreach( $rows as $row )

    <tr class="align-middle {{\App\Helpers\Grid::getEvenOrOdd()}}">
        <td>{{$row->id}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->email}}</td>
        <td>
            @if( $row->is_admin == 1 )
                <span class="btn btn-success btn-sm">{{__('global.yes')}}</span>
            @else
                <span class="btn btn-danger btn-sm">{{__('global.no')}}</span>
            @endif
        </td>
        <td>
            <span class="btn btn-danger" onclick="deleteEntity('{{url('action/delete/' . $row->id)}}', 'action-index-table');">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                </svg>
            </span>
            <a class="btn btn-success me-2" href="{{url('user/edit/' . $row->id)}}">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                </svg>
            </a>

        </td>
    </tr>
@endforeach
