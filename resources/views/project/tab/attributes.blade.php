<?php
/**
 * @var $entity \App\Models\Project
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show" id="attributes" role="tabpanel" tabindex="0">
    <div class="col-sm-12 mt-3">
        <table id="attribute-option-table" class="table table-striped border datatable dataTable no-footer" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
            <thead>
            <tr>
                <th>{{__('project.enable_attribute_in_project')}}</th>
                <th>{{__('attribute.name')}}</th>
                <th>{{__('attribute.code')}}</th>
                <th>{{__('attribute.type')}}</th>
                <th>{{__('project.position_in_project')}}</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $projectsAttributes     = $entity->attributes;
                    $projectsAttributes     = index_by( $projectsAttributes, 'id' );
                ?>
                @foreach( \App\Models\Attribute::all() as $attribute )
                    <?php
                        $selectedAttribute       = isset( $projectsAttributes[ $attribute->id ]) == true ? $projectsAttributes[ $attribute->id ] : null;
                        $position                   = 99;
                        $selected                   = '';
                        if( $selectedAttribute ) {
                            $position               = $selectedAttribute->pivot->position;
                            $selected               = 'selected';
                        }
                    ?>
                    <tr>
                        <td>
                            <select class="form-select" name="attribute[{{$attribute->id}}][active]">
                                <option value="0">{{__('global.no')}}</option>
                                <option value="1" {{$selected}}>{{__('global.yes')}}</option>

                            </select>
                            <input type="hidden" name="attribute[{{$attribute->id}}][attribute_id]" value="{{$attribute->id}}" />
                        </td>
                        <td>{{$attribute->name}}</td>
                        <td>{{$attribute->code}}</td>
                        <td>{{__('attribute.' . $attribute->attributetype->name)}}</td>
                        <td><input type="text" class="form-control" value="{{$position}}" name="attribute[{{$attribute->id}}][position]" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
