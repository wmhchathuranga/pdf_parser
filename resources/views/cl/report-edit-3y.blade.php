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
            <h2 class="text-center mt-3 mb-0">Appendix 3Y</h2>
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap align-middle mdl-data-table">
                    <thead>
                        <tr>
                            <th>ABN</th>
                            <th class="text-center">Company Name</th>
                            <th class="text-center">Director</th>
                            <th class="text-center">Appointment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td>{{ $reportData['abn'] }}</td>
                            <td class="text-center">{{ $reportData['company_name'] }}</td>
                            <td class="text-center">{{ $reportData['name_of_director'] }}</td>
                            <td class="text-center">{{ $reportData['date_of_appointment'] }}</td> --}}
                            <td>75 633 936 536</td>
                            <td class="text-center">Australian Gold and Copper Ltd (ASX:AGC)</td>
                            <td class="text-center">Zhang Yong</td>
                            <td class="text-center">2 January 2024</td>
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
                    {{-- <canvas class="form-control" path="{{ env('API_URL') }}/{{ $reportData['pdf_path'] }}" id="pdf-canvas"></canvas> --}}
                    <canvas class="form-control"
                        path="https://s203.q4cdn.com/353037891/files/doc_downloads/regulatory-filings-share-buybacks-and-related-documents/2019/09/193205d3-70eb-9098-5763-d3393f4dc50e.pdf"
                        id="pdf-canvas"></canvas>
                </div>
            </div>
        </div>

        <div class="card col-6">

            {{-- Part 1 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">Change of director’s relevant interests in securities</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Direct or indirect interest </th>
                                    {{-- <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['detail_of_contract'] }}
                                    </td> --}}
                                    <td class="col-6 text-center" data-name="aa">Indirect</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Nature of indirect interest (including registered holder)
                                    </th>
                                    <td class="col-6 text-center" data-name="aa">
                                        GeoZen Resources Group Co., Limited (formerly Delin Mining Group Cooperation
                                        Limited)
                                        <br><br>
                                        (Director and beneficiary)
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Date of change</th>
                                    <td class="col-6 text-center" data-name="aa">6 August 2024</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">No. of securities held prior to change</th>
                                    <td class="col-6 text-center" data-name="aa">122,222,222 Fully Paid Ordinary Shares</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Class</th>
                                    <td class="col-6 text-center" data-name="aa">Fully Paid Ordinary Shares</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Number acquired </th>
                                    <td class="col-6 text-center" data-name="aa">18,906,250</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Number disposed</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Value/Consideration</th>
                                    <td class="col-6 text-center" data-name="aa">$6,050,000</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">No. of securities held after change</th>
                                    <td class="col-6 text-center" data-name="aa">141,128,472 Fully Paid Ordinary Shares</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Nature of change</th>
                                    <td class="col-6 text-center" data-name="aa">
                                        Share Placement
                                        <br><br>
                                        (approved at EGM held 12 July 2024)
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
                    <p class="fs-14 mb-0 text-muted fw-light">Change of director’s interests in contracts</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Detail of contract</th>
                                    {{-- <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['detail_of_contract'] }}
                                    </td> --}}
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Nature of interest</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Name of registered holder (if issued securities)</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Date of change</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">No. and class of securities to which interest related
                                        prior to change</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Interest acquired</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Interest disposed</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Value/Consideration</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Interest after change</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Part 3 --}}
            <div class="card">
                <div class="card-header">
                    <p class="fs-14 mb-0 text-muted fw-light">+Closed period</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dt-responsive nowrap align-middle mdl-data-table"
                            data-editable="true">
                            <tbody>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">Were the interests in the securities or contracts
                                        detailed
                                        above traded during a +closed period where prior written
                                        clearance was required?</th>
                                    {{-- <td class="col-6 text-center">
                                        {{ in_array(strtolower($reportData['part3s'][0]['detail_of_contract']), ['n/a', 'nil', 'null']) ? '-' : $reportData['part3s'][0]['detail_of_contract'] }}
                                    </td> --}}
                                    <td class="col-6 text-center" data-name="aa">No</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">If so, was prior written clearance provided to allow the
                                        trade
                                        to proceed during this period?</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-6 text-center">If prior written clearance was provided, on what date was
                                        this
                                        provided?</th>
                                    <td class="col-6 text-center" data-name="aa">-</td>
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

        console.log(url);

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


    {{-- uncomment here --}}
    {{-- let reportData = @json($reportData);
        console.log(reportData); --}}
    <script>
        var tds = document.getElementsByTagName("td");
        for (var i = 0; i < tds.length; i++) {
            if (tds[i].getAttribute('data-name')) {
                tds[i].addEventListener("dblclick", editCellValue);
            }
        }




        function editCellValue() {
            // check this.innerHTML already has a input tag 
            if (this.querySelector("input")) {
                return;
            }
            this.innerHTML =
                "<input class='form-control-sm m-0 text-center border-0' style='max-width:280px;' type='text' value='" +
                getvalue(this.innerHTML) + "' />";

            var oldVallue;

            function getvalue(value) {
                oldVallue = value;
                // remove unnecessary spaces
                return value.replace(/\s+/g, '');
            }
            var input = this.querySelector("input");
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
                    is_enter = true;
                    if (valueCheck(this)) {
                        this.parentNode.innerHTML = htmlspecialchars(this.value);
                    } else {
                        this.parentNode.innerHTML = htmlspecialchars(oldVallue);
                    }
                }
            };

            // when focusout input save cell 
            // input.onblur = function() {
            //     valueCheck(this);
            // };

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
                updateJson(inputTag.parentNode.getAttribute('data-name'), inputTag.value);
                inputTag.blur();
                is_enter = false;
                return true;
            }




            function updateJson(dataName, value) {
                console.log(dataName, value); //t1-receipts_from_customers_c_q 33
                splitDataName = dataName.split('-');
                tableName = splitDataName[0];
                rowIndex = splitDataName[1];
                cellName = splitDataName[2];
                reportData[tableName][rowIndex][cellName] = value;

                console.log(reportData);
            }

        }

        function saveData() {
            // console.log(JSON.stringify(reportData));
            var request = new XMLHttpRequest();
            request.open("POST", "{{ route('user.save-report-3x') }}");
            request.setRequestHeader("Content-Type", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            request.send(JSON.stringify(reportData));

            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert("Report Saved Successfully");
                    console.log(this.responseText);
                    if (this.responseText == "sucess") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Report has been saved',
                            showConfirmButton: false,
                            timer: 2500,
                            showCloseButton: true
                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Something went wrong',
                            showConfirmButton: false,
                            timer: 2500,
                            showCloseButton: true
                        });
                    }
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Network Error',
                        showConfirmButton: false,
                        timer: 2500,
                        showCloseButton: true
                    });
                }
            };
        }

        function htmlspecialchars(string) {
            if (typeof string !== "string") return string; // Ensure the input is a string
            return string
                .replace(/&/g, "&amp;") // Escape '&' first to prevent double-escaping
                .replace(/</g, "&lt;") // Escape '<'
                .replace(/>/g, "&gt;") // Escape '>'
                .replace(/"/g, "&quot;") // Escape '"'
                .replace(/'/g, "&#039;"); // Escape single quotes
        }
    </script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
