@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $contact = getContent('contact_us.content', true);
    @endphp
    <div class="row" style="margin: 10px">

        @include($activeTemplate . 'donor.partials.donor_menu')

        <div class="col-md-10" style="padding-top: 10px">
            <div class="card" style="border-radius: 10px">
                <div class="card-header donor-menu-card-header">
                    Change Password
                </div>
                <div class="card-body">
                    <form action="{{ route('donor.password.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('Password')</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" placeholder="@lang('Password')"
                                    name="old_password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('New Password')</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" placeholder="@lang('New Password')" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('Confirm Password')</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" placeholder="@lang('Confirm Password')"
                                    name="password_confirmation">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-primary btn-block">@lang('Save Changes')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
