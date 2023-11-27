@extends( 'layout.master' )
@section('content')
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => __('manage.dashboard') ))
        <div class="card p-3">
            <div class="card-body">
                @include('manage.filters')
                <a href="{{url('manage/edit')}}" class="btn btn-success mb-3 mt-5 btn-lg" type="button">{{__('manage.create_dashboard')}}</a>
                <div class="col-sm-12">
                    <table id="manage-index-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('manage.name')}}</th>
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
            Grid.objects['manage-index-table']	= grid;
            grid.init({
                'content_id': 'manage-index-table',
                'has_pager': true,
                'url': '/manage/fetchall',
                'filter_form': '#manage-index-table-filter',
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
