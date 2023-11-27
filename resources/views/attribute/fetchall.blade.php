@foreach( $rows as $row )

    <tr class="align-middle {{\App\Helpers\Grid::getEvenOrOdd()}}">
        <td>{{$row->id}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->code}}</td>
        <td>{{ __('attribute.' . $row->attribute_type_name)}}</td>
        <td>
            <span class="btn btn-danger" onclick="deleteEntity('{{url('attribute/delete/' . $row->id)}}', 'attribute-index-table');">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                </svg>
            </span>
            <a class="btn btn-success me-2" href="{{url('attribute/edit/' . $row->id)}}">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                </svg>
            </a>

        </td>
    </tr>
@endforeach
