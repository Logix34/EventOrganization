@extends('admin.layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset("assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")  }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset("assets/plugins/toastr/toastr.min.css")  }}">
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header col-sm-12">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ isset($detail)?"Edit Users":"Add Users" }}</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url("/admin/dashboard") }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ isset($detail)?"Edit Users":"Add Users" }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <se class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Info</h3>
                            </div>
                        </se>
                    </div>
                </div>
                <form role="form" id="quickForm" class="quickForm" method="post" action="{{ url("/submit-Brands-form") }}" enctype="multipart/form-data">
                    <input  type="hidden" name="id"  value="{{ isset($detail->id)?$detail->id:"" }}">
                    <div class="card-body row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="first_name" id="first_name" value="{{ isset($detail->first_name)?$detail->first_name:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first_name">Sure Name</label>
                                <div class="control">
                                    <input class="form-control" type="text" name="last_name" id="last_name" value="{{ isset($detail->last_name)?$detail->last_name:"" }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">Email</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="email" id="created_by" value="{{ isset($detail->email)?$detail->email:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">Address</label>
                                <div class="control">
                                    <input class="form-control" type="text"  name="address" id="address" required="" value="{{ isset($detail->address)?$detail->address:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class=" col-12">
                            <label for="profile_">Profile Picture</label>
                            <div class="control">
                                <input class="form-control" type="file" name="profile_picture" id="profile_picture" required="" value="{{ isset($detail->profile_picture)?$detail->profile_picture:"" }}">
                            </div>
                            @if(isset($detail->profile_picture)&& !empty($detail->profile_picture))<a href="{{ asset($detail->profile_picture) }}">Profile Image</a>@endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">Phone Number</label>
                                <div class="control">
                                    <input class="form-control" type="text"  name="phone_number" id="phone_number" required="" value="{{ isset($detail->phone_number)?$detail->phone_number:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">National ID</label>
                                <div class="control">
                                    <input class="form-control" type="text"  name="cnic_no" id="cnic_no" required="" value="{{ isset($detail->cnic_no)?$detail->cnic_no:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">City</label>
                                <div class="control">
                                    <input class="form-control" type="text"  name="city" id="city" required="" value="{{ isset($detail->city)?$detail->city:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">Address</label>
                                <div class="control">
                                    <input class="form-control" type="text"  name="address" id="address" required="" value="{{ isset($detail->address)?$detail->address:"" }}">
                                </div>
                            </div>
                        </div>
                        @csrf
                        <input name="id" value="{{ isset($detail->id)?$detail->id:"" }}" type="hidden">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

@endsection
