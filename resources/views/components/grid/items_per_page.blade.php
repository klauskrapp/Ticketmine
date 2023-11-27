<div class="d-flex justify-content-center">
    <div class="dataTables_length">
        <select class="form-select form-select-lg mb-3" style="width: 250px;" onchange="changeMaxItems( this, 'project-index-table' )">
            <option value="10">10 {{__('global.show_items_per_page')}}</option>
            <option value="20" selected>20 {{__('global.show_items_per_page')}}</option>
            <option value="50">50 {{__('global.show_items_per_page')}}</option>
            <option value="100">100 {{__('global.show_items_per_page')}}</option>
        </select>
    </div>
</div>
