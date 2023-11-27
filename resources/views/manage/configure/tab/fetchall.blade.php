@foreach( $rows as $row )

    <tr class="align-middle {{\App\Helpers\Grid::getEvenOrOdd()}}">
        <td>{{$row->id}}</td>
        <td>{{$row->name}}</td>
        <td>{{__('manage.' . $row->type )}}</td>


        <td>
            <span class="btn btn-danger" onclick="deleteEntity('{{url('manage/configure/' . $entity->id . '/delete?id=' . $row->id)}}', 'manage-index-table');">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                </svg>
            </span>

            <span class="btn btn-success me-2" onclick="Manage.addElement('{{$entity->id}}','{{$row->id}}');">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                </svg>
            </span>

        </td>
    </tr>
@endforeach
