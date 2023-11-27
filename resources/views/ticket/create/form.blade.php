<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" data-coreui-toggle="tab" data-coreui-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">{{__('global.general')}}</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" data-coreui-toggle="tab" data-coreui-target="#attributes" type="button" role="tab" aria-controls="general" aria-selected="true">{{__('createticket.attributes')}}</button>
    </li>
</ul>
<div class="tab-content">
    @include('ticket.create.form.general')
    @include('ticket.create.form.attributes')
</div>
