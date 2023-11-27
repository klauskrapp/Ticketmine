@extends( 'layout.master' )
@section('content')
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => __('action.manage_action') ))
        <div class="card p-3">
            <div class="card-body">
                @include('action.filters')
                <a href="{{url('action/edit')}}" class="btn btn-success mb-3 mt-5 btn-lg" type="button">{{__('action.create_action')}}</a>
                <div class="col-sm-12">
                    <table id="action-index-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('action.name')}}</th>
                                <th>{{__('action.used_in_project')}}</th>
                                <th>{{__('action.icon_class')}}</th>
                                <th>{{__('global.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    @include('components.grid.pager', array(
                        'show_margin' => true
                    ))
                    @include('components.grid.items_per_page')
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery( document ).ready(function() {
            var grid		= new Grid();
            Grid.objects['action-index-table']	= grid;
            grid.init({
                'content_id': 'action-index-table',
                'has_pager': true,
                'url': '/action/fetchall',
                'filter_form': '#action-index-table-filter',
                'params': {
                    'limit':  20,
                    'start' : 1,
                },
                'loader_dialog': 'grid-ajax-loader'
            });
            grid.load();
        });
    </script>
@endsection
