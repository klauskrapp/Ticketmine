<div class="accordion" id="attribute-index-table-filter">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" style="background-color: #F7F7F7;" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{__('global.filters')}}
            </button>
        </h2>
        <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-coreui-parent="#accordionExample">
            <div class="row p-3">
                <div class="col-sm">
                    <div class="mb-3">
                        <label class="form-label">{{__('attribute.name')}}</label>
                        <input data-item-operator="equalsorlike" data-item-table="attribute" data-item-field="name" data-item-type="filter" class="form-control form-control-lg" type="text" placeholder="{{__('attribute.name')}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{__('attribute.type')}}</label>
                        <select data-item-operator="equalsorlike" class="form-select form-select-lg"  data-item-type="filter" data-item-table="attribute" data-item-field="attribute_type_id">
                            <option value="">{{__('global.please_select')}}</option>
                            @foreach( \App\Models\AttributeType::all() as $item )
                                <option value="{{$item->id}}">{{__('attribute.' . $item->name )}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label class="form-label">{{__('attribute.code')}}</label>
                        <input data-item-operator="equalsorlike" data-item-table="attribute" data-item-field="code" data-item-type="filter" class="form-control form-control-lg" type="text" placeholder="{{__('attribute.code')}}">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <button onclick="redirectTo('{{url('attribute')}}');" class="btn btn-danger btn-lg" type="button">{{__('global.reset')}}</button>
                    </div>
                    <div class="col-6 text-end">
                        <button onclick="gridsearch('attribute-index-table'); return false;" class="btn btn-lg btn-info" type="button">{{__('global.search')}}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
