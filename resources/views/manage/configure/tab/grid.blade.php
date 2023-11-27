<div class="tab-pane fade show active" id="grid" role="tabpanel" tabindex="0">
    <div class="mt-3">
        <span class="btn btn-success mb-3 btn-lg" type="button" onclick="Manage.addElement('{{$entity->id}}','');">{{__('manage.add_new_element')}}</span>
        <div class="col-sm-12">
            <table id="configure-index-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('manage.name')}}</th>
                    <th>{{__('manage.type')}}</th>
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
<script type="text/javascript">
    jQuery( document ).ready(function() {
        var grid		= new Grid();
        Grid.objects['configure-index-table']	= grid;
        grid.init({
            'content_id': 'configure-index-table',
            'has_pager': true,
            'url': '/manage/configure/{{$entity->id}}/fetchall',
            'filter_form': '',
            'params': {
                'limit':  20,
                'start' : 1,
            },
            'loader_dialog': 'grid-ajax-loader'
        });
        grid.load();
    });
</script>
