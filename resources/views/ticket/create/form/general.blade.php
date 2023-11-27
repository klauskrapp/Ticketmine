<?php
/**
 * @var $project \App\Models\Project
 * @var $currentUser \App\Models\User
 */

$usersInProject     = $project->visibleusers;
$currentUser        = auth()->user();
?>
<div class="tab-pane fade show active" id="general" role="tabpanel" tabindex="0">
    <div class="mb-3 mt-3">
        <label for="ticket[name]" class="form-label bold">{{__('createticket.name')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="" name="ticket[name]" placeholder="{{__('createticket.name')}}">
    </div>


    <div class="mb-3 mt-3">
        <label for="ticket[priority_id]" class="form-label bold">{{__('createticket.priority')}} <span class="required">*</span></label>
        <select data-item-validator="text" data-item-validate="yes" class="form-select form-select-lg" name="ticket[priority_id]">
            <option value="">{{__('global.please_select')}}</option>
            @foreach( \App\Models\Priority::where('project_id', '=', $project->id )->orderBy('position', 'asc')->get() as $action )
                    <?php $selected     = $action->is_default == 1 ? 'selected' : ''; ?>
                <option {{$selected}} value="{{$action->id}}">{{$action->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3 mt-3">
        <label for="ticket[state_id]" class="form-label bold">{{__('createticket.state')}} <span class="required">*</span></label>
        <select data-item-validator="text" data-item-validate="yes" class="form-select form-select-lg" name="ticket[state_id]">
            <option value="">{{__('global.please_select')}}</option>
            @foreach( \App\Models\State::where('project_id', '=', $project->id )->orderBy('position', 'asc')->get() as $action )
                    <?php $selected     = $action->is_default == 1 ? 'selected' : ''; ?>
                <option {{$selected}} value="{{$action->id}}">{{$action->name}}</option>
            @endforeach
        </select>
    </div>



    <div class="mb-3 mt-3">
        <label for="ticket[action_id]" class="form-label bold">{{__('createticket.action')}} <span class="required">*</span></label>
        <select data-item-validator="text" data-item-validate="yes" class="form-select form-select-lg" name="ticket[action_id]">
            <option value="">{{__('global.please_select')}}</option>
            @foreach( \App\Models\Action::where('project_id', '=', $project->id )->orderBy('position', 'asc')->get() as $action )
                <?php $selected     = $action->is_default == 1 ? 'selected' : ''; ?>
                <option {{$selected}} value="{{$action->id}}">{{$action->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3 mt-3">
        <label for="create-ticket-assigned" class="form-label bold">{{__('createticket.assigned_to')}} <span class="required">*</span></label>
        <?php $multiple       = $project->allow_multiple_assignees == 1 ? 'multiple' : '' ;?>
        <select {{$multiple}} id="create-ticket-assigned" data-item-validator="text" data-item-validate="yes" class="selectcustom selectcustom-lg" name="assigned_to[]">
            @foreach( $usersInProject as $user )
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>





    <div class="mb-3 mt-3">
        <label for="create-ticket-follower" class="form-label bold">{{__('createticket.follower')}}</label>
        <select multiple id="create-ticket-follower" data-item-validator="text" data-item-validate="no" class="selectcustom selectcustom-lg" name="follower[]">
            @foreach( $usersInProject as $user )
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3 mt-3">
        <label for="create-ticket-created_by" class="form-label bold">{{__('createticket.created_by')}} <span class="required">*</span></label>
        <select id="create-ticket-created_by" data-item-validator="text" data-item-validate="yes" class="selectcustom selectcustom-lg" name="ticket[created_by]">
            @foreach( $usersInProject as $user )
                    <?php $selected     = $user->id == $currentUser->id ? 'selected' : ''; ?>
                <option {{$selected}} value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>



    <div class="mb-3 mt-3">
        <label for="create-ticket-description" class="form-label bold">{{__('createticket.description')}}</label>
        <textarea style="height: 350px;" id="create-ticket-description" class="form-control form-control-lg" name="ticket[description]"></textarea>
    </div>

</div>
