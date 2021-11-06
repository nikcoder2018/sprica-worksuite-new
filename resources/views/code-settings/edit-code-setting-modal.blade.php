<div class="modal-header">
    <h5 class="modal-title">@lang('app.edit') @lang('modules.codes.name')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <x-form id="editCode" method="PUT" class="ajax-form">
            <div class="row">

                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.codes.number')"
                        :fieldPlaceholder="__('placeholders.codes.number')" fieldName="code_number" fieldId="code_number"
                        fieldValue="{{$code->number}}" :fieldRequired="true" />
                </div>

                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.codes.title')"
                        :fieldPlaceholder="__('placeholders.codes.title')" fieldName="code_title" fieldId="code_title"
                        fieldValue="{{$code->title}}" :fieldRequired="true" />
                </div>
                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.codes.money_1')" fieldName="code_money_1" fieldId="code_money_1"
                        fieldValue="{{$code->money_1}}" :fieldRequired="true" />
                </div>
                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.codes.money_2')" fieldName="code_money_2" fieldId="code_money_2"
                        fieldValue="{{$code->money_2}}" :fieldRequired="true" />
                </div>
                <div class="col-lg-6">
                    <x-forms.select fieldId="code_slept" fieldLabel="Slept" fieldName="code_slept" search="true">
                        <option value="1" {{ $code->slept == 1 ? 'selected' : ''}}>@lang('app.yes')</option>
                        <option value="0" {{ $code->slept == 0 ? 'selected' : ''}}>@lang('app.no')</option>
                    </x-forms.select>
                </div>
                <div class="col-lg-6">
                    <x-forms.select fieldId="code_active" fieldLabel="Active" fieldName="code_active" search="true">
                        <option value="1" {{ $code->active == 1 ? 'selected' : ''}}>@lang('app.active')</option>
                        <option value="0" {{ $code->active == 0 ? 'selected' : ''}}>@lang('app.inactive')</option>
                    </x-forms.select>
                </div>
            </div>
        </x-form>
    </div>
</div>
<div class="modal-footer">
    <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
    <x-forms.button-primary id="save-code-setting" icon="check">@lang('app.save')</x-forms.button-primary>
</div>

<script src="{{ asset('vendor/jquery/bootstrap-colorpicker.js') }}"></script>
<script>
    $(".select-picker").selectpicker();

    $('#save-code-setting').click(function() {
        $.easyAjax({
            container: '#editCode',
            type: "POST",
            disableButton: true,
            blockUI: true,
            url: "{{ route('code-settings.update', $code->id) }}",
            data: $('#editCode').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        })
    });
</script>
