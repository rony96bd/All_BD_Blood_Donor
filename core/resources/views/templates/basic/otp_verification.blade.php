@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $breadcrumb = getContent('breadcrumb.content', true);
    @endphp
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="row justify-content-center">
                <h3 class="mt-5 text-center text-danger">Phone Verification</h3>

                <form action="{{ route('verifyotp') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter OTP</label>
                        <input type="number" name="token" class="form-control" placeholder="Enter OTP">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </section>
@endsection
