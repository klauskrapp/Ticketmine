<?php
/**
 * @var $entity \App\Models\Attribute
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade ms-2 me-2" id="options" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    <div class="mt-3">
        @if( $entity->id == '' || $entity->attributetype->can_add_options == 0 )
            <strong>{{__('attribute.options_can_be_added_after_saving')}}</strong>
        @else
            <button type="submit" class="btn btn-info btn-lg" onclick="Attribute.addOption( '', '', '99', 0); return false;">{{__('attribute.add_option')}}</button>
            <div class="col-sm-12 mt-3">
                <table id="attribute-option-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                    <thead>
                    <tr>
                        <th>{{__('attribute.optionname')}}</th>
                        <th>{{__('global.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
            <span id="options-to-delete">


            </span>
            <script type="text/javascript">
                jQuery( document ).ready(function() {
                    @foreach( $entity->attributeoptions as $item )
                    Attribute.addOption('{{$item->id}}', '{{$item->name}}', '{{$item->position}}', 0)
                    @endforeach
                });
            </script>
        @endif
    </div>
</div>
