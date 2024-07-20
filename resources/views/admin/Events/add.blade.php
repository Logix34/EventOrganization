@extends('admin.layouts.app')
@section('style')
    <style>
        .hide {
            display: none;
        }
    </style>
@endsection
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
                            <h1 class="m-0 text-dark">{{ isset($detail)?"Edit Events":"Add Events" }}</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url("/admin/dashboard") }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ isset($detail)?"Edit Events":"Add Events" }}</li>
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
                <form role="form" id="quickForm" class="quickForm" method="post"
                      action="{{ url("/submit-events/form") }}" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ isset($detail->id)?$detail->id:"" }}">
                    <div class="card-body row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="event_type">Event Type/Name</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="event_type"
                                           id="event_type" value="{{ isset($detail->event_type)?$detail->event_type:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="organiser_name">Organiser Name</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="organiser_name"
                                           id="organiser_name" value="{{ isset($detail->organiser_name)?$detail->organiser_name:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="organiser_phone_number">Organiser Phone_No</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="organiser_phone_number"
                                           id="organiser_phone_number" value="{{ isset($detail->organiser_phone_number)?$detail->organiser_phone_number:"" }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="event_detail">Event Detail</label>
                                <div class="control">
                                    <input class="form-control" required="" type="text" name="event_detail"
                                           id="event_detail" value="{{ isset($detail->event_detail)?$detail->event_detail:"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="event_start">Event Start</label>
                                <div class="control">
                                    <input class="form-control" required="" type="date" name="event_start"
                                           id="event_start" value="{{ isset($detail->event_start)?date('Y-m-d',strtotime($detail->event_start)):"" }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="event_end">Event End</label>
                                <div class="control">
                                    <input class="form-control" type="date" name="event_end" id="event_end" required=""
                                           value="{{ isset($detail->event_end)?date('Y-m-d',strtotime($detail->event_end)):"" }}">
                                </div>
                            </div>
                        </div>
                        <!--
                            Form display block for submission of the data of the EventSpeakers
                                !-->
                        <div class="col-sm-12" style="display: block">
                            <label>Add Speaker Detail</label>
                        @if(isset($detail))
                            @foreach($detail->eventSpeakers as $k=>$speaker)
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="first_name[]" class="form-control required "
                                                   placeholder="First name"
                                                   value="{{ isset($speaker->first_name)?$speaker->first_name:"" }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="last_name[]" class="form-control required "
                                                   placeholder="last name"
                                                   value="{{ isset($speaker->last_name)?$speaker->last_name:"" }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="email[]" class="form-control required "
                                                   placeholder="email"
                                                   value="{{ isset($speaker->email)?$speaker->email:"" }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="phone_number[]" class="form-control required "
                                                   placeholder=" phone_number"
                                                   value="{{ isset($speaker->phone_number)?$speaker->phone_number:"" }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <select type="text" class="form-control" name="gender[]"
                                                >
                                            <option {{ isset($speaker->gender)&&$speaker->gender=='Male'?'selected':"" }} value="Male">Male</option>
                                            <option {{ isset($speaker->gender)&&$speaker->gender=='Female'?'selected':"" }} value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="date" name="date[]" class="form-control required "
                                                   placeholder="date" value={{isset($speaker->date)?date('Y-m-d',strtotime($speaker->date)):"" }}>
                                        </div>
                                    </div>
                                    @if($k==0)
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default removeButton"><i
                                                    class="fa fa-minus"></i></button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            @else
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="first_name[]" class="form-control required weight"
                                                   placeholder="First name"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="last_name[]" class="form-control required weight"
                                                   placeholder="last name"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="email[]" class="form-control required weight"
                                                   placeholder="email"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" name="phone_number[]" class="form-control required weight"
                                                   placeholder=" phone_number">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <select type="text" class="form-control" name="gender[]">
                                            <option value="Male">Male</option>
                                            <option value="Male">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="date" name="date[]" class="form-control required weight"
                                                   placeholder="date" value="">
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                </div>
                            @endif
                            <div class="row hide" id="hidden_template">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="first_name[]" class="form-control required weight"
                                               placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="last_name[]" class="form-control required weight"
                                               placeholder="last name">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="email[]" class="form-control required weight"
                                               placeholder="email">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <select type="text" class="form-control" name="gender[]">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="phone_number[]" class="form-control required weight"
                                               placeholder=" phone_number">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="date" name="date[]" class="form-control required weight"
                                               placeholder="date" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-default removeButton"><i
                                            class="fa fa-minus"></i></button>
                                </div>

                            </div>
                        </div>
                        @csrf
                        <input name="event_id" value="{{ isset($detail->id)?$detail->id:"" }}" type="hidden">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    @endsection
    @section('script')
        <script src="{{ asset("assets/plugins/jquery-validation/jquery.validate.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/jquery-validation/additional-methods.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript"
                src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
        <!-- SweetAlert2 -->
        <!-- Toastr -->
        <script src="{{ asset("assets/plugins/toastr/toastr.min.js") }}"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            $('#quickForm').validate({
                /*rules:{
                    custom_instruction: {
                        maxlength: 100,
                    },collection_option_text: {
                        maxlength: 100,
                    },
                },*/
                submitHandler: function (form) {

                    $.ajax({
                        url: "{{ url("submit-events/form") }}",
                        type: 'POST',
                        data: new FormData(form),
                        mimeType: "multipart/form-data",
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                Toast.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Event submit successfully',
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                                setTimeout(function () {
                                    window.location = "{{ url("admin/events") }}"
                                }, 500)
                            } else {
                                Toast.fire({
                                    type: 'error',
                                    title: data.error.message
                                });
                            }
                        }
                    })
                }
            });

            $('#quickForm')
                .on('click', '.addButton', function () {
                    var $template = $('#hidden_template'),
                        $clone = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .insertBefore($template),
                        $option = $clone.find('[event_type="event_id[]"]');

                    // Add new field
                    $('#quickForm').bootstrapValidator('addField', $option);
                })
                .on('click', '.removeButton', function () {
                    var $row = $(this).closest('.row'),
                        $option = $row.find('[event_type="event_id[]"]');
                    $row.remove();
                    $('#quickForm').bootstrapValidator('removeField', $option);
                });
        </script>
        @if(Session::has('success'))
            <script>
                Toast.fire({
                    type: 'success',
                    title: '{{ Session::get("success") }}'
                })
            </script>
        @endif
    @endsection
    </body>
