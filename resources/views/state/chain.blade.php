<?php
/**
 * @var $entity \App\Models\State
 * @var $disabeld boolean
 */

$disabled           = $entity->id != '' ? true : false;
$disableForm         = $disabled == true ? 'disabled' : '';
?>
@extends( 'layout.master' )
@section('content')
    <script type="text/javascript" src="/js/state.js?version={{get_version()}}"></script>
    <div class="body flex-grow-1">
        @include('components.headline', array('headline' => __('state.set_state_chain_for') . ' "' . $entity->name . '"'  ) )
        <div class="card p-3">
            <form action="{{url('state/savechain')}}" method="POST" id="state-form">
                @csrf
                <input type="hidden" name="entity_id" value="{{$entity->id}}" />
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-coreui-toggle="tab" data-coreui-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">{{__('state.chain')}}</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" tabindex="0">

                            <div class="mb-3 mt-3">
                                <label for="statechain[]" class="form-label bold">{{__('state.define_chain')}}</label><br />
                                <select style="width: 100%" multiple id="statechain" data-item-validator="select2" data-item-validate="yes" class="selectcustom selectcustom-lg"  name="statechain[]">
                                    <?php
                                        /** $state \App\Models\State */
                                        $savedStates        = $entity->statechain;
                                        $savedStates        = index_by( $savedStates, 'id' );
                                    ?>
                                    @foreach( $states as $state )
                                        <?php $selected        = isset( $savedStates[ $state->id ] ) == true ? 'selected="selected"' : ''; ?>
                                        @if( $state->id != $entity->id )
                                            <option {{$selected}} value="{{$state->id}}">{{$state->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <p class="notice">{{__('state.chain_notice')}}</p>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{url('state')}}" class="btn btn-secondary btn-lg" type="button">{{__('global.back')}}</a>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-success btn-lg">{{__('global.save')}}</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script type="text/javascript">
        jQuery( document ).ready(function() {
            jQuery('#statechain').select2();
        });
    </script>

@endsection
