<div class="modal-header">
    <h5 class="modal-title">@lang('app.addNew') @lang('modules.codes.name')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <x-form id="createCode" method="POST" class="ajax-form">

            <input type="hidden" value="true" name="page_reload" id="page_reload">

            <div class="row">

                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.codes.number')"
                        :fieldPlaceholder="__('placeholders.codes.number')" fieldName="code_number" fieldId="code_number"
                        fieldValue="" :fieldRequired="true" />
                </div>

                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.codes.title')"
                        :fieldPlaceholder="__('placeholders.codes.title')" fieldName="code_title" fieldId="code_title"
                        fieldValue="" :fieldRequired="true" />
                </div>
                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.codes.money_1')" fieldName="code_money_1" fieldId="code_money_1"
                        fieldValue="" :fieldRequired="true" />
                </div>
                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.codes.money_2')" fieldName="code_money_2" fieldId="code_money_2"
                        fieldValue="" :fieldRequired="true" />
                </div>
                <div class="col-lg-6">
                    <x-forms.select fieldId="code_slept" fieldLabel="Slept" fieldName="code_slept" search="true">
                        <option value="1">@lang('app.yes')</option>
                        <option value="0">@lang('app.no')</option>
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

    $('#colorpicker').colorpicker({
        "color": "#16813D"
    });

    $('#save-code-setting').click(function() {
        $.easyAjax({
            container: '#createCode',
            type: "POST",
            disableButton: true,
            blockUI: true,
            buttonSelector: "#save-code-setting",
            url: "{{ route('code-settings.store') }}",
            data: $('#createCode').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    if (response.page_reload == 'true') {
                        window.location.reload();
                    } else {
                        $('#code_id').html(response.data);
                        $('#code_id').selectpicker('refresh');
                        $(MODAL_LG).modal('hide');
                    }
                }
            }
        })
    });
</script>
