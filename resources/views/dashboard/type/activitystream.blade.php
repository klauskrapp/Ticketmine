<div class="card" id="dashboardelement-{{$element->id}}" data-item-id="{{$element->id}}" data-item-current-page="0" data-item-items-per-page="{{$element->elements_per_page}}">
    <div class="card-header {{$element->headline_background_color}}">
        <h5>{{$element->name}}</h5>
    </div>
    <div class="card-body" style="height: {{$element->height}}px; overflow:scroll;">
    </div>
    <div class="card-footer" style="height: 80px;">
        <div class="row justify-content-center">
            <button onclick="Activitystream.load({{$element->id}})" style="width: 50%" class="btn btn-info btn-lg">{{__('dashboard.load_more_entries')}}</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery( document ).ready(function() {
        Activitystream.load({{$element->id}});
    });
</script>
