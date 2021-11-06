@extends('layouts.app')

@section('content')

    <!-- SETTINGS START -->
    <div class="w-100 d-flex ">

        <x-setting-sidebar :activeMenu="$activeSettingMenu" />

        <x-setting-card>

            <x-slot name="buttons">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <x-forms.button-primary icon="plus" id="addNewCode" class="addNewCode mb-2">
                            @lang('app.addNew') @lang('modules.codes.name')
                        </x-forms.button-primary>
                    </div>
                </div>
            </x-slot>

            <x-slot name="header">
                <div class="s-b-n-header" id="tabs">
                    <h2 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                        @lang($pageTitle)</h2>
                </div>
            </x-slot>

            <!-- LEAVE SETTING START -->
            <div class="col-lg-12 col-md-12 ntfcn-tab-content-left w-100 p-4">

                <div class="table-responsive">
                    <x-table class="table-bordered">
                        <x-slot name="thead">
                            <th>@lang('modules.codes.number')</th>
                            <th>@lang('modules.codes.title')</th>
                            <th>@lang('modules.codes.money_1')</th>
                            <th>@lang('modules.codes.money_2')</th>
                            <th>@lang('modules.codes.slept')</th>
                            <th>@lang('modules.codes.active')</th>
                            <th class="text-right">@lang('app.action')</th>
                        </x-slot>

                        @forelse($codes as $key=>$code)
                            <tr id="code-{{ $code->id }}">
                                <td> {{ $code->number }}</td>
                                <td> {{ $code->title }}</td>
                                <td> {{ $code->money_1 }}</td>
                                <td> {{ $code->money_2 }}</td>
                                <td> 
                                    @if ($code->slept == 1)
                                        @lang('app.yes')
                                    @else
                                        @lang('app.no')
                                    @endif
                                </td>
                                <td>
                                    @if ($code->active == 1)
                                        @lang('modules.codes.status.active')
                                    @else
                                        @lang('modules.codes.status.inactive')
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="task_view">
                                        <a href="javascript:;" data-code-id="{{ $code->id }}"
                                            class="editCode task_view_more d-flex align-items-center justify-content-center">
                                            <i class="fa fa-edit icons mr-2"></i> @lang('app.edit')
                                        </a>
                                    </div>
                                    <div class="task_view mt-1 mt-lg-0 mt-md-0">
                                        <a href="javascript:;" data-code-id="{{ $code->id }}"
                                            class="delete-code task_view_more d-flex align-items-center justify-content-center">
                                            <i class="fa fa-trash icons mr-2"></i> @lang('app.delete')
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <x-cards.no-record icon="list" :message="__('messages.noCodeAdded')" />
                                </td>
                            </tr>
                        @endforelse
                    </x-table>
                </div>

            </div>
            <!-- LEAVE SETTING END -->

        </x-setting-card>

    </div>
    <!-- SETTINGS END -->

@endsection

@push('scripts')

    <script>

        $('body').on('click', '.delete-code', function() {

            var id = $(this).data('code-id');

            Swal.fire({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.deleteCode')",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "@lang('messages.confirmDelete')",
                cancelButtonText: "@lang('app.cancel')",
                customClass: {
                    confirmButton: 'btn btn-primary mr-3',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {

                    var url = "{{ route('code-settings.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        blockUI: true,
                        data: {
                            '_token': token,
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                $('#code-' + id).fadeOut();
                            }
                        }
                    });
                }
            });
        });

        // add new code
        $('#addNewCode').click(function() {
            var url = "{{ route('code-settings.create') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $(MODAL_LG).on('shown.bs.modal', function () {
            $('#page_reload').val('true')
        })

        // add code
        $('.editCode').click(function() {

            var id = $(this).data('code-id');

            var url = "{{ route('code-settings.edit', ':id ') }}";
            url = url.replace(':id', id);

            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

    </script>
@endpush
