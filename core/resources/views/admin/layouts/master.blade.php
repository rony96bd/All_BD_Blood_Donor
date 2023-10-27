<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $general->sitename($pageTitle ?? '') }}</title>
    <!-- site favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- bootstrap toggle css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/bootstrap-toggle.min.css') }}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/line-awesome.min.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&family=Noto+Serif+Bengali:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('style-lib')

    <!-- custom select box css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/nice-select.css') }}">
    <!-- code preview css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/prism.css') }}">
    <!-- select 2 css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
    <!-- jvectormap css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/jquery-jvectormap-2.0.5.css') }}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/datepicker.min.css') }}">
    <!-- timepicky for time picker css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/jquery-timepicky.css') }}">
    <!-- bootstrap-clockpicker css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/bootstrap-clockpicker.min.css') }}">
    <!-- bootstrap-pincode css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/bootstrap-pincode-input.css') }}">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.css">
    @stack('style')
</head>

<body>
    @yield('content')
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('assets/admin/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <!-- bootstrap-toggle js -->
    <script src="{{ asset('assets/admin/js/vendor/bootstrap-toggle.min.js') }}"></script>

    <!-- slimscroll js for custom scrollbar -->
    <script src="{{ asset('assets/admin/js/vendor/jquery.slimscroll.min.js') }}"></script>
    <!-- custom select box js -->
    <script src="{{ asset('assets/admin/js/vendor/jquery.nice-select.min.js') }}"></script>

    <script src="https://kit.fontawesome.com/88197b63d0.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

    @include('partials.notify')
    @stack('script-lib')

    <script src="{{ asset('assets/admin/js/nicEdit.js') }}"></script>

    <!-- code preview js -->
    <script src="{{ asset('assets/admin/js/vendor/prism.js') }}"></script>
    <!-- seldct 2 js -->
    <script src="{{ asset('assets/admin/js/vendor/select2.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    {{-- LOAD NIC EDIT --}}
    <script>
        "use strict";
        bkLib.onDomLoaded(function() {
            $(".nicEdit").each(function(index) {
                $(this).attr("id", "nicEditor" + index);
                new nicEditor({
                    fullPanel: true
                }).panelInstance('nicEditor' + index, {
                    hasPanel: true
                });
            });
        });
        (function($) {
            $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
                $('.nicEdit-main').focus();
            });
        })(jQuery);

        $("#phone").keyup(function() {
            if ($('#phone').val() > 9999999999) {
                $('#errorMsg').show();
            } else {
                $('#errorMsg').hide();
            }
        });
        // $(document).ready(function() {
        //     $('#division-dropdown').on('change', function() {
        //         var idDivision = this.value;
        //         $("#city-dropdown").html('');
        //         $.ajax({
        //             url: "{{ Route('fetchcity') }}",
        //             type: "POST",
        //             data: {
        //                 division_id: idDivision,
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             dataType: 'json',
        //             success: function(result) {
        //                 $('#city-dropdown').html(
        //                     '<option value="">-- জেলা সিলেক্ট করুন --</option>');
        //                 $.each(result.cities, function(key, value) {
        //                     $("#city-dropdown").append('<option value="' + value.id +
        //                         '">' + value.name + '</option>');
        //                 });
        //                 $('#location-dropdown').html(
        //                     '<option value="">-- Select City --</option>');
        //             }
        //         })
        //     });

        //     $('#city-dropdown').on('change', function() {
        //         var idCity = this.value;
        //         $("#location-dropdown").html('');
        //         $.ajax({
        //             url: "{{ Route('fetchlocation') }}",
        //             type: "POST",
        //             data: {
        //                 city_id: idCity,
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             dataType: 'json',
        //             success: function(result) {
        //                 $('#location-dropdown').html(
        //                     '<option value="">-- উপজেলা সিলেক্ট করুন --</option>');
        //                 $.each(result.locations, function(key, value) {
        //                     $("#location-dropdown").append('<option value="' + value
        //                         .id + '">' + value.name + '</option>');
        //                 });
        //             }
        //         })
        //     });
        // });
    </script>
    @stack('script')
</body>

</html>
