<div class="tab-pane fade show active" id="general" role="tabpanel" tabindex="0">
    <input type="hidden" name="project[id]" value="{{$entity->id}}" id="project-entity-id" />

    <div class="mb-3 mt-3">
        <label for="project[name]" class="form-label bold">{{__('project.name')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->name}}" name="project[name]" placeholder="{{__('project.set_projects_name')}}">
    </div>


    <div class="mb-3 mt-4">
        <label for="project[unique_id]" class="form-label bold">{{__('project.unique_id')}} <span class="required">*</span></label>
        <input {{$disableForm}} id="project-unique-id" data-item-validator="text" data-item-validate="yes" type="text" class="form-control form-control-lg" value="{{$entity->unique_id}}" name="project[unique_id]" placeholder="{{__('project.set_unique_id')}}">
        <p class="notice">{{__('project.cannot_be_changed_after_save')}}</p>
    </div>


    <div class="mb-3 mt-4">
        <label for="project[name]" class="form-label bold">{{__('project.allow_multiple_assignees')}}</label>
        <select class="form-select form-select-lg" name="project[allow_multiple_assignees]" >
            <?php $selected       = $entity->allow_multiple_assignees == 1 ? 'selected' : ''; ?>
            <option value="1" {{$selected}}>{{__('global.yes')}}</option>
            <?php $selected       = $entity->allow_multiple_assignees == 0 ? 'selected' : ''; ?>
            <option value="0" {{$selected}}>{{__('global.no')}}</option>
        </select>
        <p class="notice">{{__('project.if_yes_assign')}}</p>
    </div>


    <div class="mb-3 mt-4">
        <label for="project[is_free_for_all_user]" class="form-label bold">{{__('project.is_free_for_all_user')}}</label>
        <select id="project-free-for-all" class="form-select form-select-lg" name="project[is_free_for_all_user]" onchange="Project.changeFreeForAll()">
            <?php $selected       = $entity->is_free_for_all_user == 1 ? 'selected' : ''; ?>
            <option value="1" {{$selected}}>{{__('global.yes')}}</option>
            <?php $selected       = $entity->is_free_for_all_user == 0 ? 'selected' : ''; ?>
            <option value="0" {{$selected}}>{{__('global.no')}}</option>
        </select>
        <p class="notice">{{__('project.if_yes_free_for_all')}}</p>
    </div>

    <div class="mb-3 mt-4" id="project-select-free-for-all-users">
        <label for="users[]" class="form-label bold">{{__('project.users_for_project')}}</label><br />
        <select style="width: 100%;" class="selectcustom selectcustom-lg" id="project-free-for-all" name="users[]" multiple>
            <?php
                /**  \App\Model\User $user */
                $usersInProject     = $entity->users;
                $usersInProject     = index_by( $usersInProject, 'id');
            ?>
            @foreach( \App\Models\User::all() as $user )
                <?php $selected          = isset( $usersInProject[ $user->id] ) ? 'selected="selected"' : ''; ?>
                <option {{$selected}} value="{{$user->id}}">{{$user->name}} ({{$user->email}})</option>
            @endforeach
        </select>
    </div>





</div>
