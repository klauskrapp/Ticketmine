<div class="ms-3 mt-3 mb-3">
    <div>
        <a class="btn btn-sm btn-info" href="{{url('filter/moveto/' . $filter->id)}}">{{$filter->name}}</a>
        <a  class="btn btn-sm btn-danger" href="{{url('filter/delete/' . $filter->id)}}">
            <svg class="icon">
                <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
            </svg>
        </a>
    </div>
</div>
