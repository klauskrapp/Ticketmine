<?php
/**
 * @var $entity \App\Models\User
 * @var $disabeld boolean
 */
?>
<div class="tab-pane fade show active" id="general" role="tabpanel" tabindex="0">
    <input type="hidden" name="user[id]" value="{{$entity->id}}" id="user-entity-id" />

    <div class="mb-3 mt-3">
        <label for="user[name]" class="form-label bold">{{__('user.name')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->name}}" name="user[name]" placeholder="{{__('user.name')}}">
    </div>


    <div class="mb-3 mt-3">
        <label for="user[email]" class="form-label bold">{{__('user.email')}} <span class="required">*</span></label>
        <input type="text" data-item-validator="email" data-item-validate="yes" class="form-control form-control-lg" value="{{$entity->email}}" name="user[email]" placeholder="{{__('user.email')}}">
    </div>

    <div class="mb-3 mt-3">
        <label for="user[password]" class="form-label bold">{{__('user.password')}}</label>
        <input type="password" data-item-validator="text" data-item-validate="no" class="form-control form-control-lg" value="" name="user[password]" placeholder="{{__('user.password')}}">
    </div>

    <div class="mb-3 mt-3">
        <label for="avatar" class="form-label bold">{{__('user.avatar')}} <span class="required">*</span></label>
        <input type="file" name="avatar" class="form-control form-control-lg"/>
        <p>128x128px</p>
    </div>



    @if( auth()->user()->is_admin )
        <div class="mb-3 mt-4">
            <label for="user[is_admin]" class="form-label bold">{{__('user.is_admin')}}</label>
            <select class="form-select form-select-lg" name="user[is_admin]">
                <?php $selected       = $entity->is_admin == 1 ? 'selected' : ''; ?>
                <option value="1" {{$selected}}>{{__('global.yes')}}</option>
                <?php $selected       = $entity->is_admin == 0 ? 'selected' : ''; ?>
                <option value="0" {{$selected}}>{{__('global.no')}}</option>
            </select>
        </div>


        <div class="mb-3 mt-4">
            <label for="user[is_active]" class="form-label bold">{{__('user.is_active')}}</label>
            <select class="form-select form-select-lg" name="user[is_active]">
                    <?php $selected       = $entity->is_active == 1 ? 'selected' : ''; ?>
                <option value="1" {{$selected}}>{{__('global.yes')}}</option>
                    <?php $selected       = $entity->is_active == 0 ? 'selected' : ''; ?>
                <option value="0" {{$selected}}>{{__('global.no')}}</option>
            </select>
        </div>


        <div class="mb-3 mt-4">
            <label for="user[is_free_for_all_projects]" class="form-label bold">{{__('user.is_free_for_all_projects')}}</label>
            <select onchange="User.changeFreeForAll()" id="project-free-for-all" class="form-select form-select-lg" name="user[is_free_for_all_projects]">
                <?php $selected       = $entity->is_free_for_all_projects == 1 ? 'selected' : ''; ?>
                <option value="1" {{$selected}}>{{__('global.yes')}}</option>
                <?php $selected       = $entity->is_free_for_all_projects == 0 ? 'selected' : ''; ?>
                <option value="0" {{$selected}}>{{__('global.no')}}</option>
            </select>
        </div>



        <div class="mb-3 mt-4" id="project-select-free-for-all-projects">
            <label for="projects[]" class="form-label bold">{{__('user.use_for_projects')}}</label><br />
            <select style="width: 100%" class="selectcustom selectcustom-lg" id="user-free-for-all" name="projects[]" multiple>
                    <?php
                        $usersInProject     = $entity->projects;
                        $usersInProject     = index_by( $usersInProject, 'id');
                    ?>
                @foreach( \App\Models\Project::all() as $project )
                    <?php $selected          = isset( $usersInProject[ $project->id] ) ? 'selected="selected"' : ''; ?>
                    <option {{$selected}} value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
            </select>
        </div>
    @endif

</div>
