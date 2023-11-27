<?php
/**
 * @var $entity \App\Models\Ticket
 */

?>
<div class="row mt-3">
    <div class="col-8">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" style="background-color: #F7F7F7;" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseDetails" aria-expanded="true" aria-controls="collapseDetails">
                        {{__('viewticket.details')}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse show" id="collapseDetails" aria-labelledby="headingOne" data-coreui-parent="#accordionExample">
                    <div class="row ms-2">
                        <div class="col-6">
                            <table>
                                <tr>
                                    <td style="height: 10px;"></td>
                                    <td></td>
                                </tr>
                                <tr id="container-change-action_id" onclick="Viewticket.changeValue( this );" data-item-db-field="action_id" data-item-config-key="action_changed" data-item-url="/ticket/actionorpriority" data-item-headline="{{__('viewticket.change_action')}}" data-item-model="App\Models\Action" data-item-ticket-id="{{$entity->id}}" data-item-current-value="{{$entity->action->id}}">
                                    <td style="width: 180px;font-size: 14px;"><strong>Vorgangstyp</strong></td>
                                    <td>@include('ticket.view.details_persons.span', array('entity' => $entity->action))</td>
                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                    <td></td>
                                </tr>
                                <tr id="container-change-priority_id" onclick="Viewticket.changeValue( this );" data-item-db-field="priority_id" data-item-config-key="priority_changed" data-item-url="/ticket/actionorpriority" data-item-headline="{{__('viewticket.change_priority')}}" data-item-model="App\Models\Priority" data-item-ticket-id="{{$entity->id}}" data-item-current-value="{{$entity->priority->id}}">
                                    <td style="width: 180px;font-size: 14px;"><strong>Priorität</strong></td>
                                    <td>@include('ticket.view.details_persons.span', array('entity' => $entity->priority))</td>
                                </tr>
                                <tr>
                                    <td style="height: 10px;"></td>
                                    <td></td>
                                </tr>
                                <tr id="container-change-state_id" onclick="Viewticket.changeValue( this );" data-item-db-field="state_id" data-item-config-key="state_changed" data-item-url="/ticket/groupstate" data-item-headline="{{__('viewticket.change_state')}}" data-item-model="App\Models\State" data-item-ticket-id="{{$entity->id}}" data-item-current-value="{{$entity->state->id}}">
                                    <td style="width: 180px;font-size: 14px;"><strong>Status</strong></td>
                                    <td>@include('ticket.view.details_persons.span', array('entity' => $entity->state ) ) </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-5">
                            <table>
                                <tr>
                                    <td style="height: 10px;"></td>
                                    <td></td>
                                </tr>
                                @foreach( $attributes as $attribute )
                                    <tr>
                                        <td style="width: 180px;font-size: 14px;"><strong>{{$attribute->name}}</strong></td>
                                        <td style="font-size: 14px;">{{\App\Helpers\Attribute::getAttributesValue( $entity, $attribute, true )}}</td>
                                    </tr>
                                    <tr>
                                        <td style="height: 10px;"></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" style="background-color: #F7F7F7;" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapsePersons" aria-expanded="true" aria-controls="collapsePersons">
                        {{__('viewticket.persons')}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse show" id="collapsePersons" aria-labelledby="headingOne" data-coreui-parent="#accordionExample">
                    <table class="ms-3 mt-2">
                        <tr data-item-is_required="yes" data-item-config-key="assignees_changed" onclick="Viewticket.changePerson( this, 'assigned' );" data-item-multiple="{{$entity->project->allow_multiple_assignees == 1 ? 'multiple' : ''}}" id="container-change-assigned" data-item-headline="{{__('viewticket.change_assigned')}}" data-item-ticket-id="{{$entity->id}}">
                            <td style="width: 180px;font-size: 14px;"><strong>{{__('viewticket.assigned')}}</td>
                            <td>
                                @foreach( $entity->assigned as $user )
                                    <span class="btn btn-info btn-sm" style="font-size: 12px;" data-item-user_id="{{$user->id}}">{{$user->name}}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 10px;"></td>
                            <td></td>
                        </tr>
                        <tr data-item-is_required="yes" data-item-config-key="author_changed" onclick="Viewticket.changePerson( this, 'author' );" data-item-multiple="" id="container-change-author" data-item-headline="{{__('viewticket.change_author')}}" data-item-ticket-id="{{$entity->id}}">
                            <td style="width: 180px; font-size: 14px;"><strong>{{__('viewticket.author')}}</strong></td>
                            <td>
                                <span style="font-size: 12px;" data-item-user_id="{{$entity->creator->id}}">{{$entity->creator->name}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 10px;"></td>
                            <td></td>
                        </tr>
                        <tr data-item-is_required="no" data-item-config-key="follower_changed" onclick="Viewticket.changePerson( this, 'follower' );" data-item-multiple="multiple" id="container-change-follower" data-item-headline="{{__('viewticket.change_follower')}}" data-item-ticket-id="{{$entity->id}}">
                            <td style="width: 180px; font-size: 14px;"><strong>{{__('viewticket.follower')}}</strong></td>
                            <td>
                                @forelse( $entity->follower as $user )
                                    <span style="font-size: 12px;" class="btn btn-info btn-sm" data-item-user_id="{{$user->id}}">{{$user->name}}</span>
                                @empty
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 10px;"></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
