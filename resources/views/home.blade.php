@extends('layouts.master.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <style>
        table tr td, table tr th {
            max-width: 14vw;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        table {
            width: 100%;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 70px !important;
        }
    </style>
@endpush

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2">
                <h4 class="fw-bold py-1"><span class="text-muted fw-light">Dashboard / </span>Overview</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="d-flex justify-content-between pb-2">
                    <div>
                        <h5>August</h5>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="pt-1 me-2">
                            <h5>Filter</h5>
                        </div>
                        <div class="dropdown">
                            <button
                            class="btn btn-sm btn-outline-primary dropdown-toggle"
                            type="button"
                            id="growthReportId"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            >
                            Monthly
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                <a class="dropdown-item" href="javascript:void(0);">August</a>
                                <a class="dropdown-item" href="javascript:void(0);">September</a>
                                <a class="dropdown-item" href="javascript:void(0);">October</a>
                                <a class="dropdown-item" href="javascript:void(0);">November</a>
                                <a class="dropdown-item" href="javascript:void(0);">December</a>
                                <a class="dropdown-item" href="javascript:void(0);">January</a>
                                <a class="dropdown-item" href="javascript:void(0);">Febuary</a>
                                <a class="dropdown-item" href="javascript:void(0);">March</a>
                                <a class="dropdown-item" href="javascript:void(0);">April</a>
                                <a class="dropdown-item" href="javascript:void(0);">May</a>
                                <a class="dropdown-item" href="javascript:void(0);">June</a>
                                <a class="dropdown-item" href="javascript:void(0);">July</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Total Premiums</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Expenses</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Investments</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="fw-semibold d-block mb-1">Balance</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Total Revenue -->
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0 p-4">
                        <table id="summaryTable" class="display"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    function Employee (name, position, salary, office) {
        this.name = name;
        this.position = position;
        this.salary = salary;
        this._office = office;
    
        this.office = function () {
            return this._office;
        }
    };
    
    $('#summaryTable').DataTable({
        data: [
            new Employee( "Tiger Nixon", "System Architect", "$3,120", "Edinburgh" ),
            new Employee( "Garrett Winters", "Director", "$5,300", "Edinburgh" )
        ],
        columns: [
            { data: 'name' },
            { data: 'salary' },
            { data: 'office' },
            { data: 'position' }
        ]
    });
    // const dataSet = [
    //     ["1", "Byaruhanga Violet",  "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"],
    //     ["2", "Gimbo Fatuma", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"],
    //     ["3", "Kilama Emmanuel", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"],
    //     ["4", "Obua Isaac", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"],
    //     ["5", "Okwakol Simon Fabian", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"],
    //     ["6", "Olowo David", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"],
    //     ["7", "Otim Fredrick", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"],
    //     ["8", "Ssemakula Julius", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"],
    //     ["9", "Wanichan Franco", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"]
    //     ["10", "Class 2003", "200,000", "100,000", "-", "-", "100,000", "-", "-", "-", "-", "-",  "-", "-", "-"]
    // ];
    // $(document).ready(function () {
    //     $('#summaryTable').DataTable({
    //         columns: [
    //             { title: 'SNO' },
    //             { title: 'Name' },
    //             { title: 'Contributions' },
    //             { title: 'Aug' },
    //             { title: 'Sept' },
    //             { title: 'Oct' },
    //             { title: 'Nov' },
    //             { title: 'Dec' },
    //             { title: 'Jan' },
    //             { title: 'Feb' },
    //             { title: 'Mar' },
    //             { title: 'Apr' },
    //             { title: 'May' },
    //             { title: 'Jun' },
    //             { title: 'Jul' }
    //         ],
    //         data: dataSet,
    //         scrollCollapse: true,
    //         scrollY: '60vh'
    //     });

    //     let table = new DataTable('#summaryTable');
    //     table.on('click', 'tbody tr', function () {
    //         let data = table.row(this).data();
        
    //         alert('You clicked on ' + data[0] + "'s row");
    //     });
    // });
</script>
@endpush