@foreach( $rows as $row )

    <tr class="align-middle {{\App\Helpers\Grid::getEvenOrOdd()}}">
        <td>{{$row->id}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->unique_id}}</td>
        <td>{{$row->increment_id}}</td>
        <td>
            <span class="btn btn-danger" onclick="deleteEntity('{{url('project/delete/' . $row->id)}}', 'project-index-table');">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                </svg>
            </span>
            <a class="btn btn-success me-2" href="{{url('project/edit/' . $row->id)}}">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                </svg>
            </a>

        </td>
    </tr>
@endforeach
