@extends( 'layout.master' )
@section('content')
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => __('project.manage_project') ))
        <div class="card p-3">
            <div class="card-body">
                @include('project.filters')
                <a href="{{url('project/edit')}}" class="btn btn-success mb-3 mt-5 btn-lg" type="button">{{__('project.create_project')}}</a>
                <div class="col-sm-12">
                    <table id="project-index-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('project.name')}}</th>
                                <th>{{__('project.unique_id')}}</th>
                                <th>{{__('project.last_id')}}</th>
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
            Grid.objects['project-index-table']	= grid;
            grid.init({
                'content_id': 'project-index-table',
                'has_pager': true,
                'url': '/project/fetchall',
                'filter_form': '#project-index-table-filter',
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
