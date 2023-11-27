@extends( 'layout.master' )
@section('content')
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => __('attribute.manage_attribute') ))
        <div class="card p-3">

            <div class="card-body">
                @include('attribute.filters')
                <a href="{{url('attribute/edit')}}" class="btn btn-success mb-3 mt-5 btn-lg" type="button">{{__('attribute.create_attribute')}}</a>
                <div class="col-sm-12">
                    <table id="attribute-index-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('attribute.name')}}</th>
                                <th>{{__('attribute.code')}}</th>
                                <th>{{__('attribute.type')}}</th>
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
            Grid.objects['attribute-index-table']	= grid;
            grid.init({
                'content_id': 'attribute-index-table',
                'has_pager': true,
                'url': '/attribute/fetchall',
                'filter_form': '#attribute-index-table-filter',
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
