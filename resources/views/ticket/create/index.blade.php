<?php
/**
 * @var $user \App\Models\User
 */
$user           = auth()->user();
?>
@extends( 'layout.master' )
@section('content')
    <script type="text/javascript" src="/js/createticket.js?version={{get_version()}}"></script>
    <div class="body flex-grow-1">
    @include('components.headline', array('headline' => __('createticket.create') ))
        <div class="card p-3">
            <form action="{{url('ticket/save')}}" method="POST" id="createticket-form">
                @csrf
                <div class="card-body">


                    <div class="mb-3 mt-3">
                        <label for="create-ticket-project-id" class="form-label bold">{{__('createticket.select_project')}} <span class="required">*</span></label>
                        <select onchange="Createticket.loadForm();" id="create-ticket-project-id" data-item-validator="select2" data-item-validate="yes" class="selectcustom selectcustom-lg"  name="ticket[project_id]">
                            <option value="">{{__('global.please_select')}}</option>
                            @foreach( $user->visibleprojects as $project )
                                <?php $selected        = $user->default_project_id == $project->id ? 'selected' : ''; ?>
                                <option {{$selected}} value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="tab-content">




                    </div>
                </div>


                <div class="card-footer">
                    <div class="row">
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-lg" onclick="return Createticket.save();">{{__('global.save')}}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

    <script type="text/javascript">
        jQuery( document ).ready(function() {
            jQuery('#create-ticket-project-id').select2();

            Createticket.loadForm();
        });
    </script>
@endsection

@section( 'modals' )
    @include( 'editor.refer_ticket', array('project' => $project) )
    @include( 'editor.refer_user', array('project' => $project) )
@endsection
