<div class="">
    <div class="dropdown-head bg-primary bg-pattern rounded-top">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                </div>
                <div class="col-auto dropdown-tabs">
                    @if ($notificationCount > 0)
                        {{-- <span class="badge bg-light-subtle text-body fs-13">{{ $notificationCount }}&nbsp;&nbsp;New</span> --}}
                        <button wire:click="markAllAsRead" type="button"
                            class="btn btn-success btn-sm btn-label waves-effect waves-light"><i
                                class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Clear All</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="px-2 pt-2">
            <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab"
                role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                        aria-selected="true">
                        All ({{ $notificationCount }})
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content position-relative" id="notificationItemsTabContent">
        <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel" style="min-height: 300px">
            <div data-simplebar style="max-height: 300px;" class="pe-2">
                @foreach ($notifications as $notifi)
                    <div wire:click="markAsRead({{ $notifi->id }}, {{ $notifi->type }} ,{{ $notifi->report_id ?? 0}} ,'{{ $notifi->report_type ?? 'null'}}')"
                        class="text-reset notification-item d-block dropdown-item position-relative">
                        <div class="d-flex">
                            <div class="avatar-xs me-3 flex-shrink-0">
                                <span
                                    class="avatar-title {{ in_array($notifi->type, [3, 4]) ? 'bg-info-subtle text-info' : ($notifi->type == 2 ? 'bg-warning-subtle text-warning' : 'bg-danger-subtle text-danger') }} rounded-circle fs-16">
                                    <i
                                        class="mdi @switch($notifi->type)
                                                        @case(1)
                                                            mdi-file-document-alert-outline
                                                            @break
                                                        @case(2)
                                                            mdi-file-replace-outline
                                                            @break
                                                        @case(3)
                                                            mdi-file-clock-outline
                                                            @break
                                                        @case(4)
                                                            mdi-alert-decagram
                                                            @break
                                                        @default
                                                            mdi-information-outline
                                                        @endswitch
                                                    "></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <a class="stretched-link">
                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">
                                        {{ $notifi->file_name }}</h6>
                                </a>
                                <a class="stretched-link">
                                    <h6 class="mt-0 mb-2 lh-base">{{ $notifi->message }}</h6>
                                </a>
                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                    <span><i class="mdi mdi-clock-outline"></i>
                                        @php
                                            $date = new DateTime($notifi->created_at);
                                            // if it is a today, only show time
                                            if ($date->format('Y-m-d') == date('Y-m-d')) {
                                                echo $date->format('H:i');
                                            } elseif ($date->format('Y-m-d') == date('Y-m-d', strtotime('-1 days'))) {
                                                echo 'Yesterday at ' . $date->format('H:i');
                                            } else {
                                                echo $date->format('d M Y H:i');
                                            }
                                        @endphp
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <script>
                    function readNotification(id) {
                        const xhr = new XMLHttpRequest();
                        xhr.open("GET", "/read-notification/" + id, true);

                        // Set up a callback to reload after the request completes
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                // Request complete, reload the page
                                window.location.reload();
                            }
                        };

                        xhr.send();
                    }
                </script>
                <div class="my-3 text-center view-all">
                    <a href="{{ route(auth()->user()->role['role_name'] . '.activity-log') }}"
                        class="btn btn-soft-success waves-effect waves-light">View
                        Activity Log <i class="ri-arrow-right-line align-middle"></i></a>
                </div>
            </div>

        </div>
        <div class="notification-actions" id="notification-actions">
            <div class="d-flex text-muted justify-content-center">
                {{-- <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal"
                    data-bs-target="#removeNotificationModal">Remove</button> --}}
            </div>
        </div>
    </div>

    @script
        <script>
            $wire.on('refreshNotifications', (count) => {
                // console.log('call function');
                if (document.getElementById('notification-count-span')) {
                    document.getElementById('notification-count-span').innerHTML = count;
                }
            })
        </script>
    @endscript

</div>
