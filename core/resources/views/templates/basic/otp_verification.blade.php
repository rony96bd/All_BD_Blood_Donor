@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $breadcrumb = getContent('breadcrumb.content', true);
    @endphp
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col d-md-block text-center d-none"></div>
                <div class="col text-center">
                    <div class="row justify-content-center" style="background: white; border-radius: 10px; padding-bottom: 20px; margin: 0;">
                        <h6 class="mt-3 text-center text-danger">OTP has been Send to {{__($donor->phone)}}. Please verify your phone number.</h6>

                        <form action="{{ route('verifyotp') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Enter OTP</label>
                                <input type="number" name="token" class="form-control" placeholder="Enter OTP">
                            </div>
                            <button type="submit" class="btn btn-primary">Verify</button>
                        </form>
                    </div>
                </div>
                <div class="col d-md-block d-none text-center"></div>
            </div>
        </div>
    </section>
@endsection
