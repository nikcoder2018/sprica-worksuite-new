@extends('layouts.app')

@section('content')

    <!-- SETTINGS START -->
    <div class="w-100 d-flex ">

        <x-setting-sidebar :activeMenu="$activeSettingMenu" />

        <x-setting-card>
            <x-slot name="header">
                <div class="s-b-n-header" id="tabs">
                    <h2 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                        @lang($pageTitle)</h2>
                </div>
                <div class="s-b-n-header" id="tabs">
                    <nav class="tabs px-4 border-bottom-grey">
                        <div class="nav" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link f-15 active general" href="{{ route('attendance-settings.index') }}"
                                role="tab" aria-controls="nav-attendanceSettings"
                                aria-selected="true">@lang('app.menu.general')
                            </a>

                            <a class="nav-item nav-link f-15 breakhours" href="{{ route('attendance-settings.index') }}?tab=breakhours"
                                role="tab" aria-controls="nav-attendanceBreakHours"
                                aria-selected="true">@lang('app.menu.breakHours')
                            </a>
                        </div>
                    </nav>
                </div>
            </x-slot>
            <x-slot name="buttons">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <x-forms.button-primary icon="plus" id="addBreakHours" class="type-btn mb-2 d-none">
                            @lang('app.addNew') @lang('modules.attendance.breakHours')
                        </x-forms.button-primary>
                    </div>
                </div>
            </x-slot>
            
            {{-- include tabs here --}}
            @include($view)
        </x-setting-card>

    </div>
    <!-- SETTINGS END -->
@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            var $insertBefore = $('#insertBefore');
            var $i = {{ count($ipAddresses) }};

            $('#office_end_time, #office_start_time, #halfday_mark_time').timepicker({
                @if ($global->time_format == 'H:i')
                    showMeridian: false,
                @endif
            });

            $('#save-form').click(function() {
                $.easyAjax({
                    url: "{{ route('attendance-settings.update', ['1']) }}",
                    container: '#editSettings',
                    disableButton: true,
                    blockUI: true,
                    buttonSelector: "#save-form",
                    type: "POST",
                    redirect: true,
                    data: $('#editSettings').serialize()
                })
            });

            $('#employee_clock_in_out').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#radius_check').removeAttr("disabled");
                    $('#ip_check').removeAttr("disabled");
                } else if ($(this).prop("checked") == false) {
                    if ($('#radius_check').prop("checked") == true) {
                        $('#radius_check').trigger('click');
                    }
                    if ($('#ip_check').prop("checked") == true) {
                        $('#ip_check').trigger('click');
                    }

                    $('#radius_check').attr("disabled", 'disabled');
                    $('#ip_check').attr("disabled", 'disabled');
                }
            });

            $('#radius_check').click(function() {
                $('#radiusBox').toggleClass('d-none');
            });

            $('#ip_check').click(function() {
                $('#ipBox').toggleClass('d-none');
            });

            // Add More Inputs
            $('#plusButton').click(function() {
                $i = $i + 1;
                var indexs = $i + 1;
                $(`<div id="addMoreBox${indexs}" class="row clearfix"><div class="col-md-5 "style="margin-left:5px;"><div class="form-group"><input class="form-control height-35 f-14" name="ip[${$i}]" type="text" value="" placeholder="@lang('modules.attendance.ipAddress')"/></div></div><div class="col-md-1"><div class="task_view mt-1"> <a href="javascript:;" onclick="removeBox(${indexs})" class="delete-agents task_view_more d-flex align-items-center justify-content-center dropdown-toggle" > <i class="fa fa-trash icons mr-2"></i> @lang('app.delete')</a> </div></div></div>`).insertBefore($insertBefore);
            });

            // Remove fields
            function removeBox(index) {
                $('#addMoreBox' + index).remove();
            }

        });

        $('#alert_after_status').click(function() {
            $('.alert_after_box').toggleClass('d-none');
        })
    </script>
@endpush
