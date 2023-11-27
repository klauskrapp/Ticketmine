
<div style="float:right;">
    <form method="get" action="{{url('search')}}">
        <div class="input-group">
            <div class="input-group-text">
                <svg class="icon">
                    <use xlink:href="{{get_core_ui_path()}}vendors/@coreui/icons/svg/free.svg#cil-search"></use>
                </svg>
            </div>

                <input type="hidden" name="filter" value="1" />
                <input name="fulltext" class="form-control" type="text" placeholder="{{ __('global.search_for_ticket') }}" id="header-quicksearch">

        </div>
    </form>
</div>

