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
                    <button class="accordion-button" style="background-color: #F7F7F7;" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseDescription" aria-expanded="true" aria-controls="collapseDetails">
                        {{__('viewticket.description')}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse show" id="collapseDescription" aria-labelledby="headingOne" data-coreui-parent="#accordionExample">
                    <div style="height: 40px;background-color: lightblue" data-item-field="toolbar">
                        <span onclick="Viewticket.openTinyMCE( this );" data-item-config="description_changed" data-item-type="description" data-item-comment_id="" data-item-ticket_id="{{$entity->id}}" class="btn btn-success" style="float:right; margin-top: 5px;margin-right: 10px;">
                            <svg class="icon">
                                <use xlink:href="/coreui/4_2/dist/vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass"></use>
                            </svg>
                        </span>
                    </div>

                    <div class="row ms-2 mt-3" data-item-field="content">
                        {!! $entity->getParsedDescription() !!}
                    </div>

                    <div class="row ms-2 me-2" style="display:none;" data-item-field="textarea">
                        <textarea></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" style="background-color: #F7F7F7;" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseDate" aria-expanded="true" aria-controls="collapsePersons">
                        {{__('viewticket.date')}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse show" id="collapseDate" aria-labelledby="headingOne" data-coreui-parent="#accordionExample">
                    <div class="ms-2 mt-2">
                        <table>
                            <tr>
                                <td style="width: 180px;font-size: 14px;"><strong>{{__('viewticket.created_at')}}</strong></td>
                                <td>
                                    {{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $entity->created_at)->format(config('app.datetime_format'))}}
                                </td>
                            </tr>
                            @if( $entity->updated_at != '' && $entity->updated_at != $entity->created_at )
                                <tr>
                                    <td style="height: 10px;"></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="width: 180px;font-size: 14px;">
                                        <strong>
                                            {{__('viewticket.updated_at')}}
                                        </strong></td>
                                    <td>
                                        {{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $entity->updated_at)->format(config('app.datetime_format'))}}
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
