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
                    <div class="row justify-content-center bnfont" style="background: white; border-radius: 10px; padding-bottom: 20px; margin: 0;">
                        <h6 class="mt-3 text-center" style="color: #00B074">
                            {{__($donor->phone)}}
                            এই নম্বরে OTP পাঠানো হয়েছে। নিচে OTP কোডটি প্রবেশ করান।</h6>

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
