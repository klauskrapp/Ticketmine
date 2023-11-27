<div class="tab-pane fade show" id="element" role="tabpanel" tabindex="0">
    <form action="/manage/configure/{{$entity->id}}/save" method="post" id="element-form">
        <input id="element-id" type="hidden" name="element[id]" value="{{$entity->id}}" />
        @csrf
        <div class="mb-3 mt-3">
            <label for="element[name]" class="form-label bold">{{__('manage.element_name')}} <span class="required">*</span></label>
            <input id="element-name" type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="" name="element[name]" placeholder="{{__('manage.element_name')}}">
        </div>


        <div class="mb-3 mt-3">
            <label for="element[type]" class="form-label bold">{{__('manage.type')}} <span class="required">*</span></label>
            <select onchange="Manage.changeType();" id="element-type" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" name="element[type]">
                <option value="activitystream">{{__('manage.activitystream')}}</option>
                <option value="filterlist">{{__('manage.filter')}}</option>
            </select>
        </div>

        <div class="mb-3 mt-3" id="filter_id_container">
            <label for="element[filter_id]" class="form-label bold">{{__('manage.filter')}}</label><br />
            <select style="width: 100%" id="element-filter_id" class="form-select form-select-lg" name="element[filter_id]">
                @foreach( auth()->user()->filters as $filter )
                    <?php $selected        = $filter->id == $entity->filter_id ? 'selected="selected"' : ''; ?>
                    <option {{$selected}} value="{{$filter->id}}">{{$filter->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-3 mt-3">
            <label for="element[headline_background_color]" class="form-label bold">{{__('manage.headline_background_color')}} <span class="required">*</span></label>
            <select   onchange="Manage.changeHeadlineClass();" id="manage-headlinelass" class="form-control form-control-lg" value="99" name="element[headline_background_color]">
                <option value="text-bg-dark">text-bg-dark</option>
                <option value="text-bg-light">text-bg-light</option>
                <option value="text-bg-info">text-bg-info</option>
                <option value="text-bg-warning">text-bg-warning</option>
                <option value="text-bg-danger">text-bg-danger</option>
                <option value="text-bg-success">text-bg-success</option>
                <option value="text-bg-secondary">text-bg-secondary</option>
                <option value="text-bg-primary">text-bg-primary</option>
            </select>
            <p class="notice"><span>Lorem Ipsum</span></p>

        </div>


        <div class="mb-3 mt-3">
            <label for="element[position]" class="form-label bold">{{__('manage.position')}} <span class="required">*</span></label>
            <input id="element-position" type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="99" name="element[position]" placeholder="{{__('manage.position')}}">
        </div>


        <div class="mb-3 mt-3">
            <label for="element[align]" class="form-label bold">{{__('manage.align')}} <span class="required">*</span></label>
            <select id="element-align" data-item-validator="text" data-item-validate="yes" class="form-select form-select-lg" name="element[align]">
                <option value="left">{{__('manage.left')}}</option>
                <option value="right">{{__('manage.right')}}</option>
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="element[height]" class="form-label bold">{{__('manage.height')}} <span class="required">*</span></label>
            <input id="element-height" type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="250" name="element[height]" placeholder="{{__('manage.height')}}">
        </div>

        <div class="mb-3 mt-3">
            <label for="element[elements_per_page]" class="form-label bold">{{__('manage.elements_per_page')}} <span class="required">*</span></label>
            <input id="element-elements_per_page" type="text" data-item-validator="text" data-item-validate="yes" class="form-control form-control-lg" value="7" name="element[elements_per_page]" placeholder="{{__('manage.elements_per_page')}}">
        </div>
    </form>
</div>
<script type="text/javascript">
    jQuery( document ).ready(function() {
        Manage.changeType();
        jQuery('#element-filter_id').select2();
    });

</script>
