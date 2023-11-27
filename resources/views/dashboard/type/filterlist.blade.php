<div class="card" data-item-id="{{$element->id}}" data-item-current-page="1" data-item-items-per-page="{{$element->elements_per_page}}">
    <div class="card-header {{$element->headline_background_color}}">
        <h5>{{$element->name}}</h5>
    </div>
    <div class="card-body" style="height: {{$element->height}}px; overflow:scroll;" id="dashboardelement-{{$element->id}}" >
        <div class="col-sm-12">
            <table class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                <thead>
                <tr>
                    <th style="font-size: 13px;">{{__('dashboard.name')}}</th>
                    <th style="font-size: 13px;">{{__('dashboard.assigned')}}</th>
                    <th style="font-size: 13px;">{{__('dashboard.priority')}}</th>
                    <th style="font-size: 13px;">{{__('dashboard.actiontype')}}</th>
                    <th style="font-size: 13px;">{{__('dashboard.state')}}</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
    <div class="card-footer" style="height: 80px;">
        @include('components.grid.pager', array(
            'show_margin' => false
        ))
    </div>
</div>
<script type="text/javascript">
    jQuery( document ).ready(function() {
        var grid		= new Grid();
        Grid.objects['dashboardelement-{{$element->id}}']	= grid;
        grid.init({
            'content_id': 'dashboardelement-{{$element->id}}',
            'has_pager': true,
            'url': '/dashboard/fetchfilterlist/{{$element->id}}/{{$element->filter_id}}',
            'filter_form': '',
            'params': {
                'limit':  {{$element->elements_per_page}},
                'start' : 1,
            },
            'loader_dialog': 'grid-ajax-loader'
        });
        grid.load();
    });
</script>
