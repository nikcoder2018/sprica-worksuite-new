<div class="modal-header">
    <h5 class="modal-title">@lang('app.edit') @lang('modules.breakhours.name')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <x-form id="editBreakHours" method="PUT" class="ajax-form">
            <div class="row">
                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.breakhours.hours')"
                        :fieldPlaceholder="__('placeholders.breakhours.hours')" fieldName="hours" fieldId="hours"
                        fieldValue="{{$breakhours->hours}}" :fieldRequired="true" />
                </div>

                <div class="col-lg-6">
                    <x-forms.text :fieldLabel="__('modules.breakhours.break')"
                        :fieldPlaceholder="__('placeholders.breakhours.break')" fieldName="break" fieldId="break"
                        fieldValue="{{$breakhours->break}}" :fieldRequired="true" />
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

    $('#save-breakhours-setting').click(function() {
        $.easyAjax({
            container: '#editBreakHours',
            type: "POST",
            disableButton: true,
            blockUI: true,
            url: "{{ route('breakhours-settings.update', $breakhours->id) }}",
            data: $('#editBreakHours').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                }
            }
        })
    });
</script>
