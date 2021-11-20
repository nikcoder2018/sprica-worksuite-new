<div class="modal-header">
    <h5 class="modal-title">@lang('app.addNew') @lang('modules.breakhours.name')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <x-form id="createBreaHour" method="POST" class="ajax-form">

            <input type="hidden" value="true" name="page_reload" id="page_reload">

            <div class="row">

                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.breakhours.hours')"
                        :fieldPlaceholder="__('placeholders.breakhours.hours')" fieldName="hours" fieldId="hours"
                        fieldValue="" :fieldRequired="true" />
                </div>

                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.breakhours.break')"
                        :fieldPlaceholder="__('placeholders.breakhours.break')" fieldName="break" fieldId="break"
                        fieldValue="" :fieldRequired="true" />
                </div>
            </div>
        </x-form>
    </div>
</div>
<div class="modal-footer">
    <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
    <x-forms.button-primary id="save-breakhours-setting" icon="check">@lang('app.save')</x-forms.button-primary>
</div>

<script src="{{ asset('vendor/jquery/bootstrap-colorpicker.js') }}"></script>

<script>
    $(".select-picker").selectpicker();

    $('#colorpicker').colorpicker({
        "color": "#16813D"
    });

    $('#save-breakhours-setting').click(function() {
        $.easyAjax({
            container: '#createBreaHour',
            type: "POST",
            disableButton: true,
            blockUI: true,
            buttonSelector: "#save-breakhours-setting",
            url: "{{ route('breakhours-settings.store') }}",
            data: $('#createBreaHour').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    if (response.page_reload == 'true') {
                        window.location.reload();
                    } else {
                        $('#breakhours_id').html(response.data);
                        $('#breakhours_id').selectpicker('refresh');
                        $(MODAL_LG).modal('hide');
                    }
                }
            }
        })
    });
</script>
