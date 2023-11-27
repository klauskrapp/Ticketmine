<?php
/**
 * @var $entity \App\Models\User
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show" id="emailsettings" role="tabpanel" tabindex="0">

    @foreach( $settings_dropdown as $item )
        <div class="mb-3 mt-3">
            <label for="usersettings[{{$item}}]" class="form-label bold">{{__('user.'. $item)}}</label>
            <select class="form-select form-control-lg" name="usersettings[{{$item}}]">
                <?php $selected       = $entity->getSetting( $item ) == 1 ? 'selected' : ''; ?>
                <option value="1" {{$selected}}>{{__('global.yes')}}</option>
                <?php $selected       = $entity->getSetting( $item ) == 0 ? 'selected' : ''; ?>
                <option value="0" {{$selected}}>{{__('global.no')}}</option>
            </select>
            <p class="notice">{{__('user.'. $item . '_notice')}}</p>
        </div>
    @endforeach



        @foreach( $settings_multiselect as $item )
            <div class="mb-3 mt-3">
                <label for="usersettings[{{$item}}][]" class="form-label bold">{{__('user.'. $item)}}</label>
                <select multiple class="form-select form-control-lg" name="usersettings[{{$item}}][]">
                        <?php $flags = \App\Helpers\User::checkBitFlag( $entity->getSetting( $item ), \App\Helpers\User::assigned );?>
                        <?php $selected = $flags == true ? 'selected="selected"' : '';?>
                        <option value="1"  {{$selected}}>{{__('user.assigned')}}</option>

                        <?php $flags = \App\Helpers\User::checkBitFlag( $entity->getSetting( $item ), \App\Helpers\User::author);?>
                        <?php $selected = $flags == true ? 'selected="selected"' : '';?>
                        <option value="2" {{$selected}}>{{__('user.author')}}</option>


                        <?php $flags = \App\Helpers\User::checkBitFlag( $entity->getSetting( $item ), \App\Helpers\User::follower);?>
                        <?php $selected = $flags == true ? 'selected="selected"' : '';?>
                        <option value="4" {{$selected}}>{{__('user.follower')}}</option>
                </select>
                <p class="notice">{{__('user.'. $item . '_notice')}}</p>
            </div>
        @endforeach
</div>
