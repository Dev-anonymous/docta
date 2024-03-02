<script src="{{ asset('plugins/common/common.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/settings.js') }}"></script>
<script src="{{ asset('js/gleek.js') }}"></script>
<script src="{{ asset('js/styleSwitcher.js') }}"></script>
<script>
    @if (!Auth::check())
        localStorage.setItem('token', '')
    @endif
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Accept': 'application/json'
        }
    });

    $('[logout]').click(function() {
        $(this).closest('.header-right').find('.user-img').html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('web.logout') }}',
            success: function(data) {
                localStorage.setItem('token', '');
                location.reload();
            },
            error: function(data) {
                location.reload();
            }
        })
    })
</script>

{{-- <script src="{{ asset('plugins/chart.js/Chart.bundle.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/circle-progress/circle-progress.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/d3v3/index.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/topojson/topojson.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/datamaps/datamaps.world.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/morris/morris.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/moment/moment.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/chartist/js/chartist.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script> --}}

{{-- <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script> --}}
