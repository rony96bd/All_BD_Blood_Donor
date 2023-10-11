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
                    Your Blood Request List
                </div>
                <div class="card-body">
                    <section style="background-color: #eee; border-radius: 10px;">
                        <div class="row bnfont">
                            <div class="col-lg-12">
                                <div class="card b-radius--10 ">
                                    <div class="card-body p-0">
                                        <div class="table-responsive--sm table-responsive">
                                            <table class="table table--light style--two">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('বিভাগ - জেলা - উপজেলা')</th>
                                                        <th>@lang('ব্লাড গ্রুপ - রোগীর সমস্যা')</th>
                                                        <th>@lang('রক্তের পরিমান')</th>
                                                        <th>@lang('রক্তদানের তারিখ ও সময়')</th>
                                                        <th>@lang('রক্ত দানের স্থান')</th>
                                                        <th>@lang('যোগাযোগের নম্বর')</th>
                                                        <th>@lang('Action')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($bloodRequests as $bloodRequest)
                                                        <tr>
                                                            <td>
                                                                <span>বিভাগ:
                                                                    {{ __($bloodRequest->division->name) }}</span><br>
                                                                <span>জেলা: {{ __($bloodRequest->city->name) }}</span><br>
                                                                <span>উপজেলা: {{ __($bloodRequest->location->name) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ __($bloodRequest->blood->name) }}</span><br>
                                                                <span>{{ __($bloodRequest->problem) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ __($bloodRequest->amount_of_blood) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ __($bloodRequest->donate_date) }}</span><br>
                                                                <span>{{ __($bloodRequest->donate_time) }}</span>
                                                            </td>

                                                            <td>
                                                                <span>{{ __($bloodRequest->donate_address) }}</span>
                                                            </td>

                                                            <td>
                                                                <span>{{ __($bloodRequest->phone) }}</span>
                                                            </td>

                                                            <td data-label="@lang('Action')">

                                                                <a href="{{ route('donor.blood-request.edit', $bloodRequest->id) }}"
                                                                    class="icon-btn btn--primary ml-1"><i
                                                                        class="las la-pen"></i></a>
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
                                        {{ paginateLinks($bloodRequests) }}
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
