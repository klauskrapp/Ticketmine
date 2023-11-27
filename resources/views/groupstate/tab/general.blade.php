<?php
/**
 * @var $entity \App\Models\State
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show active" id="general" role="tabpanel" tabindex="0">
    <input type="hidden" name="groupstate[id]" value="{{$entity->id}}" />

    <div class="mb-3 mt-3">

        <label for="groupstate[name]" class="form-label bold">{{__('groupstate.name')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->name}}" name="groupstate[name]" placeholder="{{__('groupstate.name')}}">
    </div>



    <div class="mb-3 mt-3">
        <label for="states[]" class="form-label bold">{{__('groupstate.select_state')}}</label><br />
        <select style="width: 100%" multiple id="state-project-id" data-item-validator="select2" data-item-validate="no" class="selectcustom selectcustom-lg"  name="states[]">
            <?php
                $currentStates      = $entity->state;
                $currentStates      = index_by( $currentStates, 'id' );
            ?>
            @foreach( \App\Models\State::all() as $state )
                <?php $selected        = isset( $currentStates[ $state->id ]) == true ? 'selected="selected"' : ''; ?>
                <option {{$selected}} value="{{$state->id}}">{{$state->name}}</option>
            @endforeach
        </select>
    </div>

</div>
