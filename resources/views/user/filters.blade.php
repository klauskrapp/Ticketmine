<div class="accordion" id="user-index-table-filter">
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
                        <label class="form-label">{{__('user.name')}}</label>
                        <input data-item-operator="equalsorlike" data-item-table="user" data-item-field="name" data-item-type="filter" class="form-control form-control-lg" type="text" placeholder="{{__('user.name')}}">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="mb-3">
                        <label class="form-label">{{__('user.email')}}</label>
                        <input data-item-operator="equalsorlike" data-item-table="user" data-item-field="email" data-item-type="filter" class="form-control form-control-lg" type="text" placeholder="{{__('user.email')}}">
                    </div>
                </div>
            </div>


            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <button onclick="redirectTo('{{url('user')}}');" class="btn btn-danger btn-lg" type="button">{{__('global.reset')}}</button>
                    </div>
                    <div class="col-6 text-end">
                        <button onclick="gridsearch('user-index-table'); return false;" class="btn btn-lg btn-info" type="button">{{__('global.search')}}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
