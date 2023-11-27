@extends( 'layout.master' )
@section('content')
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => __('priority.manage_priority') ))
        <div class="card p-3">
            <div class="card-body">
                @include('priority.filters')
                <a href="{{url('priority/edit')}}" class="btn btn-success mb-3 mt-5 btn-lg" type="button">{{__('priority.create_priority')}}</a>
                <div class="col-sm-12">
                    <table id="priority-index-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('priority.name')}}</th>
                                <th>{{__('priority.used_in_project')}}</th>
                                <th>{{__('priority.icon_class')}}</th>
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
            Grid.objects['priority-index-table']	= grid;
            grid.init({
                'content_id': 'priority-index-table',
                'has_pager': true,
                'url': '/priority/fetchall',
                'filter_form': '#priority-index-table-filter',
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
