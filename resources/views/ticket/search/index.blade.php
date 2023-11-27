@extends( 'layout.master' )
@section('content')
    <script type="text/javascript" src="/js/searchticket.js?version={{get_version()}}"></script>
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => __('ticketsearch.search') ))
        <div class="card p-3">
            <div class="card-body">

                @include('ticket.search.existing_filters')
                @include('ticket.search.filters')
                <div class="col-sm-12">
                    <table id="ticketsearch-index-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                        <thead>
                        <tr>
                            @if( auth()->user()->getSetting('show_column_unique_id') == 1 )
                                <th style="width: 100px;">{{__('ticketsearch.unique_id')}}</th>
                            @endif

                            @if( auth()->user()->getSetting('show_column_project') == 1 )
                                <th>{{__('ticketsearch.project')}}</th>
                            @endif

                            @if( auth()->user()->getSetting('show_column_name') == 1 )
                                <th>{{__('ticketsearch.name')}}</th>
                            @endif

                            @if( auth()->user()->getSetting('show_column_created_by') == 1 )
                                <th>{{__('ticketsearch.created_by')}}</th>
                            @endif

                            @if( auth()->user()->getSetting('show_assigned_to') == 1 )
                                <th >{{__('ticketsearch.assigned_to')}}</th>
                            @endif

                            @if( auth()->user()->getSetting('show_priority') == 1 )
                                <th style="text-align: center;">{{__('ticketsearch.priority')}}</th>
                            @endif

                            @if( auth()->user()->getSetting('show_state') == 1 )
                                <th style="text-align: center;">{{__('ticketsearch.state')}}</th>
                            @endif

                            @if( auth()->user()->getSetting('show_action') == 1 )
                                <th style="text-align: center;">{{__('ticketsearch.action')}}</th>
                            @endif
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    @include('components.grid.pager', array(
                      'show_margin' => true
                  ))
                </div>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="ticketsearch-save-filter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('ticketsearch.save_filters')}}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-3">
                        <label class="form-label bold">{{__('ticketsearch.filtername')}} <span class="required">*</span></label>
                        <input  type="text" value="" class="form-control"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <div style="width: 60%; float:left;">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">{{__('global.close')}}</button>
                    </div>
                    <div style="width: 30%;float:right;text-align: right">
                        <button type="button" class="btn btn-success" onclick="Searchticket.saveFilters();">{{__('global.save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        var CSRF_TOKEN      = '{{ csrf_token() }}';

        jQuery( document ).ready(function() {
            var grid		= new Grid();
            Grid.objects['ticketsearch-index-table']	= grid;
            grid.init({
                'content_id': 'ticketsearch-index-table',
                'has_pager': true,
                'url': '/ticket/fetchall',
                'filter_form': '#ticketsearch-index-table-filter',
                'params': {
                    'limit':  50,
                    'start' : 1,
                },
                'loader_dialog': 'grid-ajax-loader'
            });
            @if( request()->get('filter') == 1 )
                Searchticket.addFilters();
                Searchticket.gridsearch();
            @else
                grid.load();
            @endif

        });
    </script>
@endsection
