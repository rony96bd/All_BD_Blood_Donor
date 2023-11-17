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
                    Your Referers
                </div>
                <div class="card-body">
                    <span
                        style="border: 1px solid lightgray; margin-bottom: 15px; border-radius: 5px; padding: 3px 8px 2px 8px; background-color: bisque;">
                        Your Refer ID: <a
                            href="{{ route('apply.donor') }}?ref={{ auth()->guard('donor')->user()->referer_id }}">
                            {{ route('apply.donor') }}?ref={{ auth()->guard('donor')->user()->referer_id }}</a><button
                            id="copyBtn"
                            style="
                                background: none;
                                color: currentColor;
                            "
                            data-text="{{ route('apply.donor') }}?ref={{ auth()->guard('donor')->user()->referer_id }}"><i
                                class="fa-solid fa-copy"></i></button></span>


                    <script>
                        const copyBtn = document.querySelector('#copyBtn');
                        copyBtn.addEventListener('click', e => {
                            const input = document.createElement('input');
                            input.value = copyBtn.dataset.text;
                            document.body.appendChild(input);
                            input.select();
                            if (document.execCommand('copy')) {
                                alert('Link copied successfully');
                                document.body.removeChild(input);
                            }
                        });
                    </script>
                    <section style="background-color: #eee; border-radius: 10px;">
                        <div class="row bnfont">
                            <div class="col-lg-12">
                                <div class="card b-radius--10 ">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('ক্রমিক')</th>
                                                        <th>@lang('ছবি')</th>
                                                        <th>@lang('নাম')</th>
                                                        <th>@lang('ঠিকানা')</th>
                                                        <th>@lang('মোবাইল নম্বর')</th>
                                                        <th>@lang('রক্তের গ্রুপ')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $sn_count = 1;
                                                    @endphp
                                                    @forelse($referers as $referer)
                                                        <tr>
                                                            <td data-label="@lang('Serial')">
                                                                <span>{{ __($sn_count++) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    <img src="{{ getImage('assets/images/donor/' . $referer->image ?? '', imagePath()['donor']['size']) }}"
                                                                        alt="@lang('Donor Image')"
                                                                        class="rounded-circle img-fluid"
                                                                        style="width: 40px;">
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>{{ __($referer->name) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ __($referer->division->name) }},
                                                                    {{ __($referer->city->name) }},
                                                                    {{ __($referer->location->name) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ __($referer->phone) }}</span><br>
                                                                <span>{{ __($referer->phone2) }}</span>
                                                            </td>

                                                            <td>
                                                                <span>{{ __($referer->blood->name) }}</span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-muted text-center" colspan="100%">
                                                                {{ __($emptyMessage) }}</td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer py-4">
                                        {{ paginateLinks($referers) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
