@foreach( $rows as $row )

    <tr class="align-middle {{\App\Helpers\Grid::getEvenOrOdd()}}">
        <td>{{$row->id}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->project_name}}</td>
        <td><span class="btn {{$row->icon_class}}">{{$row->name}}</span></td>
        <td>
            <span class="btn btn-danger" onclick="deleteEntity('{{url('state/delete/' . $row->id)}}', 'state-index-table');">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                </svg>
            </span>
            <a class="btn btn-info" href="{{url('state/chain/' . $row->id)}}">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-filter"></use>
                </svg>
            </a>
            <a class="btn btn-success me-2" href="{{url('state/edit/' . $row->id)}}">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                </svg>
            </a>

        </td>
    </tr>
@endforeach
