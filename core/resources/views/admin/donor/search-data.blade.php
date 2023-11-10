<div class="card-body p-0">
    <div class="table-responsive--sm table-responsive">
        <table class="table table--light style--two">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>@lang('Name - Profession')</th>
                    <th>@lang('Email - Phone')</th>
                    <th>@lang('Blood Group - Location')</th>
                    <th>@lang('Religion - Address')</th>
                    <th>@lang('Gender - Age')</th>
                    <th>@lang('Refer ID - Refer By - Total Refer')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Last Update')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sn_count = 1;
                @endphp
                @forelse($donors as $donor)
                    <tr>
                        <td data-label="@lang('Serial')">
                            <span>{{ __($sn_count++) }}</span>
                        </td>
                        <td data-label="@lang('Name - Profession')">
                            <span>{{ __($donor->name) }}</span><br>
                            <span>{{ __($donor->profession) }}</span>
                        </td>
                        <td data-label="@lang('Email - Phone')">
                            <span>{{ __($donor->email) }}</span><br>
                            <span>{{ __($donor->phone) }}</span>
                        </td>
                        <td data-label="@lang('Blood Group - Location')">
                            <span>{{ __($donor->blood->name) }}</span><br>
                            <span>{{ __($donor->location->name) }}</span>
                        </td>
                        <td data-label="@lang('Religion - Address')">
                            <span>{{ __($donor->religion) }}</span><br>
                            <span>{{ __($donor->address) }}</span>
                        </td>

                        <td data-label="@lang('Gender - Age')">
                            <span>
                                @if ($donor->gender == 1)
                                    @lang('Male')
                                @else
                                    @lang('Female')
                                @endif
                            </span><br>
                            <span>{{ Carbon\Carbon::parse($donor->birth_date)->age }}
                                @lang('Years')</span>
                        </td>

                        <td data-label="@lang('Referer info')">
                            <span>Refer ID: {{ __($donor->referer_id) }}</span><br>
                            <span>Refer By:
                                @if ($donor->referer_by == 0)
                                    {{ '' }}
                                @else
                                    {{ $donor->referer_by }}
                                @endif
                            </span><br>
                            <span>Total Refer:
                                @php
                                    $total_refer_donor = App\Models\Donor::where('referer_by', $donor->referer_id)->count();
                                @endphp
                                {{ __($total_refer_donor) }}
                            </span><br>
                        </td>

                        <td data-label="@lang('Status')">
                            @if ($donor->status == 1)
                                <span class="badge badge--success">@lang('Active')</span>
                            @elseif($donor->status == 2)
                                <span class="badge badge--danger">@lang('Banned')</span>
                            @else
                                <span class="badge badge--primary">@lang('Pending')</span>
                            @endif
                        </td>

                        <td data-label="@lang('Last Update')">
                            {{ showDateTime($donor->updated_at) }}<br>
                            {{ diffForHumans($donor->updated_at) }}
                        </td>

                        <td data-label="@lang('Action')">
                            @if ($donor->status == 2)
                                <a href="javascript:void(0)" class="icon-btn btn--success ml-1 approved"
                                    data-toggle="tooltip" data-original-title="@lang('Approve')"
                                    data-id="{{ $donor->id }}"><i class="las la-check"></i></a>
                            @elseif($donor->status == 1)
                                <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 cancel"
                                    data-toggle="tooltip" data-original-title="@lang('Banned')"
                                    data-id="{{ $donor->id }}"><i class="las la-times"></i></a>
                            @elseif($donor->status == 0)
                                <a href="javascript:void(0)" class="icon-btn btn--success ml-1 approved"
                                    data-toggle="tooltip" data-original-title="@lang('Approve')"
                                    data-id="{{ $donor->id }}"><i class="las la-check"></i></a>
                                <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 cancel"
                                    data-toggle="tooltip" data-original-title="@lang('Banned')"
                                    data-id="{{ $donor->id }}"><i class="las la-times"></i></a>
                            @endif
                            <a href="{{ route('admin.donor.edit', $donor->id) }}" class="icon-btn btn--primary ml-1"><i
                                    class="las la-pen"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
<div class="card-footer py-4">
    {{ paginateLinks($donors) }}
</div>
