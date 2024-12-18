@extends('layouts.master')
@section('title')
    @lang('translation.datatables')
@endsection
@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Reports
        @endslot
        @slot('title')
            Report
        @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="card col-auto">
            <h2 class="text-center mt-3 mb-0">Appendix 3X</h2>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap align-middle mdl-data-table">
                    <thead>
                        <tr>
                            <th class="text-center">ABN</th>
                            <th class="text-center">Company Name</th>
                            <th class="text-center">Director</th>
                            <th class="text-center">Appointment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if ($reportData['abn_verified'] == 0)
                                <td class="text-center text-danger" data-name="abn_fix" style="min-width: 250px">
                                    {{ $reportData['abn'] }}</td>
                            @else
                                <td class="text-center" style="min-width: 250px">{{ $reportData['abn'] }}</td>
                            @endif
                            <td class="text-center">{{ $reportData['company_name'] }}</td>
                            <td class="text-center">{{ $reportData['name_of_director'] }}</td>
                            <td class="text-center">{{ $reportData['date_of_appointment'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="floating-button">
        <a onclick="saveData()" class="btn btn-primary waves-effect"><i class="mdi mdi-content-save-outline"></i></a>
        <style>
            .floating-button {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
            }

            .floating-button .btn {
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .floating-button .btn:hover {
                box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
            }
        </style>

    </div>


    <div class="row">
        <div class="card col-6">
            <div class="card-body">
                <div class="">
                    <span>Page: <span id="page-num"></span> / <span id="page-count"></span></span>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <div id="navigation" style="height: 60px;"
                        class="position-absolute w-100 d-flex justify-content-between">
                        <button class="btn btn-primary btn-sm" id="prev-page">
                            << </button>
                                <button class="btn btn-primary btn-sm" id="next-page"> >> </button>
                    </div>
                    <canvas class="form-control" path="{{ env('API_URL') }}/{{ $reportData['pdf_path'] }}"
                        id="pdf-canvas"></canvas>
                </div>
            </div>
        </div>

        <div class="card col-6">

            {{-- Part 1 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">Director’s relevant interests in securities of which the
                        director is the
                        registered holder</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center d-flex align-items-center justify-content-center">Number &
                                        class of securities</th>
                                    <td class="col-6 text-center" data-name="part1s-0-number_class_of_securities">
                                        @for ($index = 0; $index < count($reportData['part1s']); $index++)
                                            {{ in_array(strtolower($reportData['part1s'][$index]['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part1s'][$index]['number_class_of_securities'] }}
                                            <br><br>
                                        @endfor
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Part 2 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">Director’s relevant interests in securities of which the
                        director is not
                        the registered holder</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table">
                            <thead>
                                <tr>
                                    <th width="50%" class="text-center">Holder & nature of interest</th>
                                    <th width="50%" class="text-center">Number & class of Securities</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($reportData['part2s']); $i++)
                                    <tr>
                                        <td class="text-center"
                                            data-name="part2s-{{ $i }}-name_of_holder_nature_of_interest">
                                            {{ in_array(strtolower($reportData['part2s'][$i]['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part2s'][$i]['name_of_holder_nature_of_interest'] }}
                                        </td>
                                        <td class="text-center"
                                            data-name="part2s-{{ $i }}-number_class_of_securities">
                                            {{ in_array(strtolower($reportData['part2s'][$i]['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part2s'][$i]['number_class_of_securities'] }}
                                        </td>
                                    </tr>
                                @endfor

                                {{-- @foreach ($reportData['part2s'] as $tr)
                                    <tr>
                                        <td class="text-center" data-name="part2s-name_of_holder_nature_of_interest">
                                            {{ in_array(strtolower($tr['name_of_holder_nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $tr['name_of_holder_nature_of_interest'] }}
                                        </td>
                                        <td class="text-center" data-name="part2s-number_class_of_securities">
                                            {{ in_array(strtolower($tr['number_class_of_securities']), ['n/a', 'nil', 'null']) ? '-' : $tr['number_class_of_securities'] }}
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Part 3 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">Director’s interests in contracts</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Detail of contract</th>
                                    <td class="col-6 text-center" data-name="part3s-0-detail_of_contract">
                                        {{ in_array(strtolower($reportData['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['detail_of_contract'] }}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Nature of interest</th>
                                    <td class="col-6 text-center" data-name="part3s-0-nature_of_interest">
                                        {{ in_array(strtolower($reportData['part3s'][0]['nature_of_interest']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['nature_of_interest'] }}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Name of registered holder (if issued securities)</th>
                                    <td class="col-6 text-center" data-name="part3s-0-name_of_registered_holder">
                                        {{ in_array(strtolower($reportData['part3s'][0]['name_of_registered_holder']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['name_of_registered_holder'] }}
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">No. and class of securities to which interest relates</th>
                                    <td class="col-6 text-center"
                                        data-name="part3s-0-no_and_class_of_securities_to_which_interest_relates">
                                        {{ in_array(strtolower($reportData['part3s'][0]['no_and_class_of_securities_to_which_interest_relates']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['no_and_class_of_securities_to_which_interest_relates'] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('script')
    <!-- Link to PDF.js library via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.6.172/pdf.min.js"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let htmlTag = document.getElementsByTagName('html')[0];
            htmlTag.setAttribute('data-sidebar-size', 'sm');
        })
    </script>

    <script>
        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        const scale = 2;
        let canvas = document.getElementById('pdf-canvas');
        let path = canvas.getAttribute('path');

        let url = path;

        // console.log(url);

        const ctx = canvas.getContext('2d');

        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.6.172/pdf.worker.min.js';

        /**
         * Render the current page.
         */
        function renderPage(num) {
            pageRendering = true;

            // Fetch the page
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({
                    scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                const renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(() => {
                    pageRendering = false;

                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });

                // Update page counters
                document.getElementById('page-num').textContent = pageNum;
            });
        }

        /**
         * If another page is currently rendering, wait until the rendering is
         * finished. Otherwise, execute immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Display the previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }

        /**
         * Display the next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }

        // Load the PDF document
        pdfjsLib.getDocument(url).promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;
            document.getElementById('page-count').textContent = pdfDoc.numPages;

            // Initial page rendering
            renderPage(pageNum);
        });

        // Button events
        document.getElementById('prev-page').addEventListener('click', onPrevPage);
        document.getElementById('next-page').addEventListener('click', onNextPage);
    </script>

    <script>
        var tds = document.getElementsByTagName("td");
        for (var i = 0; i < tds.length; i++) {
            if (tds[i].getAttribute('data-name')) {
                tds[i].addEventListener("dblclick", editCellValue);
            }
        }

        let reportData = @json($reportData);
        console.log(reportData);


        function editCellValue() {
            // check this.innerHTML already has a input tag 
            if (this.querySelector("textarea")) {
                return;
            }
            this.innerHTML =
                "<textarea id='textarea' class='form-control-sm m-0 text-center border-0 w-100' style='max-width:380px;' type='text' value='" +
                getvalue(this.innerHTML) + "'>" + getvalue(this.innerHTML) + "</textarea>";

            document.getElementById('textarea').style.height = document.getElementById('textarea').scrollHeight + 'px';

            var oldVallue;

            function getvalue(value) {

                value = value.trim();
                value = value.replace(/<br><br>/g, "\n");
                value = value.replace(/\s+\s+/g, '\n\n');
                oldVallue = value;

                return value;
            }
            var input = this.querySelector("textarea");
            input.select();
            input.focus();
            input.onblur = function() {
                if (is_enter) {
                    return;
                }
                if (valueCheck(this)) {
                    this.parentNode.innerHTML = htmlspecialchars(this.value);
                } else {
                    this.parentNode.innerHTML = htmlspecialchars(oldVallue);
                }
            }
            var is_enter = false;
            // if enter button press 
            input.onkeydown = function(e) {
                if (e.keyCode == 13) {
                    if (!e.shiftKey) {
                        is_enter = true;
                        if (valueCheck(this)) {
                            this.parentNode.innerHTML = htmlspecialchars(this.value);
                        } else {
                            this.parentNode.innerHTML = htmlspecialchars(oldVallue);
                        }
                    }
                }
            };


            function valueCheck(inputTag) {
                // const validPattern = /^-?\d*(\.\d+)?$|^-$|^[\w\s<>,.&'"/()\-]+$/;
                // if (validPattern.test(inputTag.value)) {
                //     updateJson(inputTag.parentNode.getAttribute('data-name'), inputTag.value);
                //     inputTag.blur();
                //     is_enter = false;
                //     return true;
                // } else {
                //     alert("Please Enter Valid Number");
                //     inputTag.value = oldVallue;
                //     inputTag.blur();
                //     is_enter = false;
                //     return false;
                // }
                if (inputTag.parentNode.getAttribute('data-name') == 'abn_fix') {
                    updateJsonAbn(inputTag.value);
                } else {
                    updateJson(inputTag.parentNode.getAttribute('data-name'), inputTag.value);
                }
                // inputTag.blur();
                is_enter = false;
                return true;
            }




            function updateJson(dataName, value) {
                console.log(dataName, value); //t1-receipts_from_customers_c_q 33
                splitDataName = dataName.split('-');
                tableName = splitDataName[0];
                rowIndex = splitDataName[1];
                cellName = splitDataName[2];

                //make rows multiline
                var points = value.split(/\n+/).map(point => point.trim()).filter(Boolean);
                if (points.length > 1) {
                    // clear old value 
                    reportData[tableName][rowIndex] = {};
                    for (var i = 0; i < points.length; i++) {
                        if (!reportData[tableName][i]) {
                            reportData[tableName][i] = {};
                        }
                        // reportData[tableName][i][i++] = reportData["id"];
                        reportData[tableName][i]["appendix3_x_id"] = reportData["id"];
                        reportData[tableName][i][cellName] = points[i];
                    }
                } else {
                    reportData[tableName][rowIndex][cellName] = value;
                }


                console.log(reportData);
            }

            function updateJsonAbn(value) {
                reportData['abn'] = value;
                // console.log(reportData);

            }

        }

        function saveData() {
            Swal.fire({
                title: "Saving Report...",
                text: 'That thing is still around?',
                html: '<i class="text-success mdi mdi-spin mdi-loading fs-48"></i>',
                // icon: 'question',
                // confirmButtonClass: 'btn btn-primary w-xs mt-2',
                // buttonsStyling: false,
                showCloseButton: false,
                showConfirmButton: false
            });

            // console.log(JSON.stringify(reportData));
            var request = new XMLHttpRequest();
            request.open("POST", "{{ route('user.save-report-3x') }}");
            request.setRequestHeader("Content-Type", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            request.send(JSON.stringify(reportData));
            // console.log(reportData2);

            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert("Report Saved Successfully");
                    $response = JSON.parse(this.responseText);
                    if ($response['message'] == 'Update Complete') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Report has been saved',
                            showConfirmButton: false,
                            timer: 2500,
                            showCloseButton: true
                        });
                        window.location.reload();
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: $response['message'],
                            showConfirmButton: false,
                            timer: 2500,
                            showCloseButton: true
                        });
                    }
                    window.location.reload();
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Something went wrong',
                        showConfirmButton: false,
                        timer: 2500,
                        showCloseButton: true
                    });
                    window.location.reload();

                }
            }

        }

        function htmlspecialchars(string) {
            if (typeof string !== "string") return string; // Ensure the input is a string
            // console.log(string);

            string = string
                .replace(/&/g, "&amp;") // Escape '&' first to prevent double-escaping
                .replace(/</g, "&lt;") // Escape '<'
                .replace(/>/g, "&gt;") // Escape '>'
                .replace(/"/g, "&quot;") // Escape '"'
                .replace(/'/g, "&#039;") // Escape single quotes
                .replace(/\n\n/g, "<br><br>")
                .replace(/\n/g, "<br><br>");

            // console.log(string);

            return string;

        }
    </script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
