@extends( 'layout.master' )
@section('content')
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => __('user.manage_user') ))
        <div class="card p-3">
            <div class="card-body">
                @include('user.filters')
                <a href="{{url('user/edit')}}" class="btn btn-success mb-3 mt-5 btn-lg" type="button">{{__('user.create_user')}}</a>
                <div class="col-sm-12">
                    <table id="user-index-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('user.name')}}</th>
                                <th>{{__('user.email')}}</th>
                                <th>{{__('user.is_admin')}}</th>
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
            Grid.objects['user-index-table']	= grid;
            grid.init({
                'content_id': 'user-index-table',
                'has_pager': true,
                'url': '/user/fetchall',
                'filter_form': '#user-index-table-filter',
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
