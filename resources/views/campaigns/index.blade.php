@extends('layout.auth')
@section('title')
Dashboard
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('campaigns.index') }}" class="text-muted">Campaigns</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                    
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <button type="button" class="btn btn-dark font-weight-bolder btn-sm" id="syncWithLemlist">Sync With Lemlist</button>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">All Campaigns
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="exports-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Campaign Id</th>
                                            <th scope="col">Campaign Name</th>
                                            <th scope="col">Last Synced</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
                    <!--end::Card-->               
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection
@section('script')
<script>
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
        });
		$('#exports-table').DataTable({
            dom: 'Bfrtip',
            buttons: [],
            processing: true,
            serverSide: true,
            pageLength:25,
            ajax: {
                url:"{{ route('campaigns.get-campaigns')}}",
                type: 'GET',
                dataType:'json',
                data: function (d) {
                    //d.user = $('.search_by_user').val();
                    //d.project = $('#search_by_project').val();
                }
            },
            order: [
                    [3, "desc"],
                    [2, "asc"],
                ],
                columnDefs: [ { orderable: false, targets: [0,1] } ],
            columns: [
                { data: 'DT_RowIndex', searchable: false },
                { data: 'campaign_id' },
                { data: 'campaign_name' },
                { data: 'updated_at' },
            ],
            searching: true,
            language: {
                    processing: '<span class="spinner spinner-track spinner-primary spinner-lg mr-15"></span> ',
                    searchPlaceholder: 'Search by campaign name ...',
                    sSearch: ''
            }
	    });

        $(".search-filter").click(function(){
            $('#exports-table').DataTable().draw(true);
        });
        $('body').on('click','#syncWithLemlist',function(e){
            e.preventDefault();
            var $this = $(this)
            $this.html('Syncing.....')
            $this.attr('disabled','disabled')
            $this.addClass('spinner spinner-white spinner-right')
            //sync-with-lemlist
            $.ajax({
                url:"{{ route('campaigns.sync-with-lemlist')}}",
                type: 'POST',
                dataType:'json',
                success: function (response) {
                    if(response.processed==1){
                        window.location.reload()
                    }
                }
            });
        })
</script>
@endsection