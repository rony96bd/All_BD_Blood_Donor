{{-- <div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-2">
    <div class="max-w-7xl mx-auto px-6">
        <div class="p-2 rounded-lg bg-yellow-100">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 items-center hidden md:inline">
                    <p class="ml-3 text-black cookie-consent__message">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                </div>
                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">
                    <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="cookie__wrapper">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <p class="txt my-2">
                @php echo @$cookie->data_values->description @endphp
                <a href="{{ @$cookie->data_values->link }}" target="_blank">@lang('Read Policy')</a>
            </p>
            <button href="javascript:void(0)" style="background-color: #00B074; border-radius: 5px; color: white;"
                class="js-cookie-consent-agree policy cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">
                {{ trans('cookie-consent::texts.agree') }}
            </button>
            {{-- <a href="javascript:void(0)" class="btn btn--base my-2 policy">@lang('Accept')</a> --}}
        </div>
    </div>
</div>

<script>
    $('.policy').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.get('{{ route('cookie.accept') }}', function(response) {
            $('.cookie__wrapper').addClass('d-none');
            notify('success', response);
        });
    });
</script>
