@extends( 'layout.master' )
@section('content')
    <script type="text/javascript" src="{{asset('js/activitystream.js')}}"></script>
    @if( $dashboard )
        <?php $dbElements       = $dashboard->getDashboardelementsGroupedByAlign(); ?>
        <div class="body flex-grow-1 px-3">
            <div class="row p-3">
                <div class="col-sm">
                    @foreach( $dbElements['left'] as $element )
                        @include('dashboard.type.' . $element->type )
                    @endforeach
                </div>
                <div class="col-sm">
                    @foreach( $dbElements['right'] as $element )
                        @include('dashboard.type.' . $element->type )
                    @endforeach
                </div>
            </div>

        </div>
    @endif
@endsection
