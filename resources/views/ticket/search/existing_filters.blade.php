@if( empty( $filters ) == false )
<div class="accordion mb-3">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" style="background-color: #F7F7F7;" type="button" data-coreui-toggle="collapse" data-coreui-target="#existingFilters" aria-expanded="false" aria-controls="existingFilters">
                {{__('ticketsearch.existing_filters')}}
            </button>
        </h2>
        <div class="accordion-collapse collapse" id="existingFilters" aria-labelledby="headingOne" data-coreui-parent="#existingFilters">
            <div class="row p-3">
                <div class="col-sm">
                    @if( isset( $filters[0] ) == true && empty( $filters[0] ) == false )
                        @foreach( $filters[0] as $filter )
                            @include('ticket.search.filterelement', array('filter' => $filter ))
                        @endforeach
                    @endif
                </div>
                <div class="col-sm">
                    @if( isset( $filters[1] ) == true && empty( $filters[1] ) == false )
                        @foreach( $filters[1] as $filter )
                            @include('ticket.search.filterelement', array('filter' => $filter ))
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endif
