<?php
/**
 * @var $entity \App\Models\User
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show" id="columnsettings" role="tabpanel" tabindex="0">
    @foreach( $settings_column as $item )
        <div class="mb-3 mt-3">
            <label for="usersettings[{{$item}}]" class="form-label bold">{{__('user.'. $item)}}</label>
            <select class="form-select form-control-lg" name="usersettings[{{$item}}]">
                    <?php $selected       = $entity->getSetting( $item ) == 1 ? 'selected' : ''; ?>
                <option value="1" {{$selected}}>{{__('global.yes')}}</option>
                    <?php $selected       = $entity->getSetting( $item ) == 0 ? 'selected' : ''; ?>
                <option value="0" {{$selected}}>{{__('global.no')}}</option>
            </select>
        </div>
    @endforeach
</div>
