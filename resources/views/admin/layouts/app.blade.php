<!DOCTYPE html>
<html lang="en">

<!--began::Header-->
@include("admin.includes.header")
@yield('style')
<!--end::Header-->
<!--began::navbar-->
@include("admin.includes.navbar")
<!--end::navbar-->
<!--began::side_bar-->
@include("admin.includes.sidebar")
@yield('content')
<!--end::side_bar-->
<!--began::footer-->
@include("admin.includes.footer")
@yield('script')
<!--end::footer-->

</html>
