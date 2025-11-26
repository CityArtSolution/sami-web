@extends('backend.layouts.app', ['isBanner' => false])

@section('title') {{ 'Dashboard' }} @endsection

@section('content')
    
<div class="row">
  <div class="col-md-12">
  <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>{{ __('dashboard.lbl_performance') }}</h3>
      <div class="d-flex  align-items-center">
        <form action="{{ route('backend.home') }}" class="d-flex align-items-center gap-2">
          <div class="form-group my-0 ms-3">
            <input type="text" name="date_range" value="{{ $date_range }}" class="form-control dashboard-date-range"
              placeholder="24 may 2023 to 25 June 2023" readonly="readonly">
          </div>
          <button type="submit" name="action" value="filter" class="btn btn-primary" data-bs-toggle="tooltip"
            data-bs-title="{{ __('messages.submit_date_filter') }}">{{ __('dashboard.lbl_submit') }}</button>
          {{-- <button type="submit" name="action" value="reset" class="btn btn-secondary btn-icon"
            data-bs-toggle="tooltip" data-bs-title="Reset Filter"><i class="fa-solid fa-clock-rotate-left"></i></button>
          --}}
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-lg-2">
        <div class="card dashboard-cards appointments"
          style="background-image: url({{ asset('img/dashboard/appointment.svg') }})">
          <a href="{{ route('backend.bookings.datatable_view') }}" class="card-body">
            <div class="d-flex align-items-start justify-content-end mb-1">
                <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-title="{{__('messages.total_appointment_count')}}"></i>
              </div>
              <h3 class="mb-2">{{ $data['total_appointments'] }}</h3>
              <p class="mb-0">{{ __('dashboard.lbl_appointment') }}</p>
            </div>
          </a>
      </div>
      <div class="col-sm-6 col-lg-2">
        <div class="card dashboard-cards services"
          style="background-image: url({{ asset('img/dashboard/services.svg') }})">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-end mb-1">
              <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-title="{{__('messages.total_revenue')}}"></i>
            </div>
            <h3 class="mb-2">{{ $data['total_revenue'] }}</h3>
            <p class="mb-0">{{ __('dashboard.lbl_tot_revenue') }}</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2">
        <div class="card dashboard-cards revenue"
          style="background-image: url({{ asset('img/dashboard/revenue.svg') }})">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-end mb-1">
              <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-title="{{__('messages.total_paid_commission')}}"></i>
            </div>
            <h3 class="mb-2">{{ $data['total_commission'] }}</h3>
            <p class="mb-0">{{ __('dashboard.lbl_sales_commission') }}</p>
          </div>

        </div>
      </div>
      <div class="col-sm-6 col-lg-2">
        <div class="card dashboard-cards new-customer"
          style="background-image: url({{ asset('img/dashboard/new-users.svg') }})">
          <a href="{{ route('backend.customers.index') }}" class="card-body">
            <div class="d-flex align-items-start justify-content-end mb-1">
              <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-title="{{__('messages.total_new_customers')}}"></i>
            </div>
            <h3 class="mb-2">{{ $data['total_new_customers'] }}</h3>
            <p class="mb-0">{{ __('dashboard.lbl_new_customer') }}</p>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2">
        <div class="card dashboard-cards new-customer"
          style="background-image: url({{ asset('img/dashboard/new-users.svg') }})">
          <a href="{{ route('backend.orders.index') }}" class="card-body">
            <div class="d-flex align-items-start justify-content-end mb-1">
              <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-title="{{__('messages.total_new_sales')}}"></i>
            </div>
            <h3 class="mb-2">{{ $data['total_orders'] }}</h3>
            <p class="mb-0">{{ __('dashboard.lbl_orders') }}</p>
          </a>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2">
        <div class="card dashboard-cards new-customer"
          style="background-image: url({{ asset('img/dashboard/new-users.svg') }})">
          <a href="{{ route('backend.reports.order-report') }}" class="card-body">
            <div class="d-flex align-items-start justify-content-end mb-1">
              <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-title="{{__('messages.total_product_revenue')}}"></i>
            </div>
            <h3 class="mb-2">{{ $data['product_sales'] }}</h3>
            <p class="mb-0">{{ __('dashboard.lbl_product_sales') }}</p>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-8">
    <div class="col-lg-12">
      <div class="card card-block card-stretch card-height">
        <div class="card-body">
          <div id="chart-01"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="card-title">{{ __('dashboard.lbl_upcoming_appointment') }} </h4>
      <a href="{{ route('backend.bookings.index') }}">{{ __('messages.view_all') }}</a>
    </div>
    <div class="card">

      <div
        class="card-body py-0 upcoming-appointments {{ count($data['upcomming_appointments']) > 0 ? '' : 'iq-upcomming' }}">
        <ul class="list-group list-group-flush ">
          @forelse ($data['upcomming_appointments'] as $booking)
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex">
                <img src="{{ $booking->user->profile_image ?? default_user_avatar() }}" alt="01"
                  class="rounded-pill avatar avatar-60" loading="lazy">
                <div class="ms-3">
                  <h5 class="mb-2">{{ $booking->user->full_name ?? default_user_name() }}</h5>
                  <p class="mb-0 col-md-8">{{ date('M d | g:i A', strtotime($booking->start_date_time)) }} | {{ $booking->branch->name }}</p>
                </div>
              </div>
              <div class="d-flex align-items-center text-info col-5">
                <i class="fa-regular fa-clock me-2"></i>
                @php
                    $timezone = setting('default_time_zone') ?? 'UTC';
                    $currentDateTime = Carbon\Carbon::now($timezone);
                    $dateTime = Carbon\Carbon::parse($booking->start_date_time, $timezone);
                    $humanTimeDifference = $dateTime->diffForHumans($currentDateTime);
                    $timeUntil = $currentDateTime->copy()->add($dateTime->diff())->diffForHumans(null, true);
                @endphp

                In {{ $timeUntil }}
              </div>
              <div class="dropdown">
                <a href="{{ route('backend.bookings.index', ['booking_id' => $booking->id]) }}" class="text-primary">
                  <i class="fa-solid fa-chevron-right"></i>
                </a>
              </div>
            </div>
          </li>
          @empty
          <p class="text-center">{{ __('dashboard.lbl_upcoming_bookings') }}</p>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card card-block card-stretch card-height">
      <div class="card-body">
        <div class=" d-flex justify-content-between  flex-wrap">
          <h4 class="card-title">{{ __('dashboard.lbl_appointment_revenue') }} </h4>
        </div>
        <div id="chart-02"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card card-block card-stretch card-height">
      <div class="card-header">
        <h4 class="card-title">{{ __('dashboard.lbl_top_services') }} </h4>
      </div>
      <div class="card-body">
        <div class="table-responsive border rounded">
          <table class="table table-lg m-0">
            <thead>
              <tr class="text-white bg-primary">
                <th scope="col">{{ __('messages.service') }}</th>
                <th scope="col">{{ __('messages.total_count') }}</th>
                <th scope="col">{{ __('messages.total_amount') }}</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($data['top_services'] as $service)
              <tr>
                <td>{{ $service->service->name }}</td>
                <td>{{ $service->total_service_count }}</td>
                <td>{{ Currency::format($service->total_service_price) }}</td>
              </tr>
              @empty
              <tr>
                <td class="text-center" colspan="3">{{ __('messages.top_service_notfound') }}</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push ('after-styles')
<style>
  /* تغيير ألوان صفحة لوحة التحكم إلى #bf9456 */
  
  /* ألوان البطاقات الإحصائية */
  .dashboard-cards {
    border-left: 4px solid #bf9456 !important;
  }
  
  .dashboard-cards:hover {
    border-left-color: #a8834b !important;
  }
  
  .dashboard-cards .card-body {
    color: #bf9456 !important; 
  }
  
  .dashboard-cards .card-body h3 {
    color: #bf9456 !important;
  }
  
  .dashboard-cards .card-body p {
    color: #bf9456 !important;
  }
  
  .dashboard-cards .fa-circle-info {
    color: #bf9456 !important;
  }
  
  /* ألوان الأزرار */
  .btn-primary {
    background-color: #bf9456 !important;
    border-color: #bf9456 !important;
    color: white !important;
  }
  
  .btn-primary:hover {
    background-color: #a8834b !important;
    border-color: #a8834b !important;
  }
  
  /* ألوان الروابط */
  a {
    color: #bf9456 !important;
  }
  
  a:hover {
    color: #a8834b !important;
  }
  
  /* ألوان الجداول */
  .table thead tr.bg-primary {
    background-color: #bf9456 !important;
  }
  
  .table thead tr.text-white {
    color: white !important;
  }
  
  /* ألوان النصوص */
  .text-primary {
    color: #bf9456 !important;
  }
  
  .text-info {
    color: #bf9456 !important;
  }
  
  /* ألوان البطاقات */
  .card {
    border-color: #bf9456 !important;
  }
  
  .card-header {
    background-color: #bf9456 !important;
    color: white !important;
  }
  
  /* ألوان الحقول */
  .form-control:focus {
    border-color: #bf9456 !important;
    box-shadow: 0 0 0 0.2rem rgba(191, 148, 86, 0.25) !important;
  }
  
  /* ألوان القوائم */
  .list-group-item {
    border-color: #bf9456 !important;
  }
  
  .list-group-item:hover {
    background-color: rgba(191, 148, 86, 0.1) !important;
  }
  
  /* ألوان الأيقونات */
  .fa-chevron-right {
    color: #bf9456 !important;
  }
  
  .fa-clock {
    color: #bf9456 !important;
  }
  
  /* ألوان الرسوم البيانية */
  .apexcharts-legend-text {
    color: #bf9456 !important;
  }
  
  .apexcharts-tooltip {
    background-color: #bf9456 !important;
    color: white !important;
  }
  
  /* ألوان التنبيهات */
  .alert-primary {
    background-color: #bf9456 !important;
    border-color: #bf9456 !important;
    color: white !important;
  }
  
  /* ألوان البطاقات الإحصائية */
  .stat-card {
    border-left: 4px solid #bf9456 !important;
  }
  
  .stat-card .stat-icon {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في البطاقات */
  .card .card-icon {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في القوائم */
  .list-group .list-group-item i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في الجداول */
  .table .icon {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في البطاقات الإحصائية */
  .stats-card .icon {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في القوائم الجانبية */
  .sidebar .nav-link i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في الشريط العلوي */
  .navbar .nav-link i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في البطاقات */
  .card .card-header .card-title i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في الجداول */
  .table .btn-group .btn {
    background-color: #bf9456 !important;
    border-color: #bf9456 !important;
    color: white !important;
  }
  
  /* ألوان الأيقونات في النماذج */
  .form-group .form-label {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في التنبيهات */
  .alert .alert-icon {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في القوائم */
  .list-group .list-group-item i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في البطاقات الإحصائية */
  .stats-widget .icon {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في القوائم الجانبية */
  .sidebar-nav .nav-item .nav-link i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في الشريط العلوي */
  .navbar-nav .nav-item .nav-link i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في البطاقات */
  .card .card-header .card-title i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في الجداول */
  .table .table-actions .btn {
    background-color: #bf9456 !important;
    border-color: #bf9456 !important;
    color: white !important;
  }
  
  /* ألوان الأيقونات في النماذج */
  .form-floating .form-control:focus ~ label {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في التنبيهات */
  .toast .toast-header .btn-close {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في القوائم */
  .list-group-numbered .list-group-item i {
    color: #bf9456 !important;
  }
  
  /* ألوان الأيقونات في البطاقات الإحصائية */
  .statistics-card .icon {
    color: #bf9456 !important;
  }

  #chart-01 {
    height: 28.5rem;
  }

  #chart-02 {
    height: 22.5rem;
  }

  .list-group {
    --bs-list-group-item-padding-y: 1.5rem;
    --bs-list-group-color: inherit !important;
  }

  .date-calender {
    display: flex;
    justify-content: space-between;
  }

  .date-calender .date {
    width: 12%;
    display: flex;
    align-items: center;
    flex-direction: column
  }

  .upcoming-appointments {
    min-height: 28rem;
    max-height: 28rem;
    overflow-y: scroll;


  }

  .iq-upcomming {
    display: flex !important;
    justify-content: center;
    align-items: center;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.40.0/apexcharts.min.css"
  integrity="sha512-tJYqW5NWrT0JEkWYxrI4IK2jvT7PAiOwElIGTjALSyr8ZrilUQf+gjw2z6woWGSZqeXASyBXUr+WbtqiQgxUYg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push ('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.40.0/apexcharts.min.js"
  integrity="sha512-Kr1p/vGF2i84dZQTkoYZ2do8xHRaiqIa7ysnDugwoOcG0SbIx98erNekP/qms/hBDiBxj336//77d0dv53Jmew=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $(document).ready(function(){
        Scrollbar.init(document.querySelector('.upcoming-appointments'), {
          continuousScrolling: false,
          alwaysShowTracks: false
        })
        const range_flatpicker = document.querySelectorAll('.dashboard-date-range')
          Array.from(range_flatpicker, (elem) => {
            if (typeof flatpickr !== typeof undefined) {
              flatpickr(elem, {
                mode: "range",
              })
            }
          })
        if (document.querySelectorAll("#chart-01").length) {
            const variableColors = IQUtils.getVariableColor();
            const colors = [variableColors.primary, variableColors.secondary];
            const options = {
              series: [
                  {
                    name: "Sales",
                    data: @json($data['revenue_chart']['total_price']),
                  },
              ],
              colors: colors,
              chart: {
                  height: "100%",
                  type: "line",
                  toolbar: {
                    show: false,
                  },
              },
              stroke: {
                  width: 3,
                  curve: 'smooth',
                  lineCap: 'butt',
              },
              grid: {
                  show: true,
                  strokeDashArray: 7,
              },
              markers: {
                  size: 6,
                  colors: "#FFFFFF",
                  strokeColors: colors,
                  strokeWidth: 2,
                  strokeOpacity: 0.9,
                  strokeDashArray: 0,
                  fillOpacity: 0,
                  shape: "circle",
                  radius: 2,
                  offsetX: 0,
                  offsetY: 0,
              },
              xaxis: {
                  categories: @json($data['revenue_chart']['xaxis']),
                  labels: {
                    minHeight: 20,
                    maxHeight: 20,
                  },
                  axisBorder: {
                    show: false,
                  },
                  axisTicks: {
                    show: false,
                  },
                  tooltip: {
                    enabled: false,
                  },
              },
              yaxis: {
                labels: {
                    minWidth: 19,
                    maxWidth: 19,
                },
                tickAmount: 3
              }
            };

            const chart = new ApexCharts(
            document.querySelector("#chart-01"),
                options
            );
            chart.render();
        }
        if (document.querySelectorAll('#chart-02').length) {
          const variableColors = IQUtils.getVariableColor();
          const colors = [variableColors.secondary, variableColors.primary];
          const options = {
            series: [
              {
                name: "Sales",
                type: 'line',
                data: @json($data['revenue_chart']['total_price']),
              },
              {
                name: "Total Appointments",
                type: 'column',
                data: @json($data['revenue_chart']['total_bookings']),
              }
            ],
            colors: colors,
            chart: {
              height: "75%",
              type: "line",
              toolbar: {
                show: false,
              },
            },
            dataLabels: {
              enabled: true,
              enabledOnSeries: [0]
            },
            legend: {
              show:false,
            },
            stroke: {
              show: true,
              curve: 'smooth',
              lineCap: 'butt',
              width: 3
            },
            grid: {
              show: true,
              strokeDashArray: 3,
            },
            xaxis: {
              categories: @json($data['revenue_chart']['xaxis']),
              labels: {
                    minHeight: 20,
                    maxHeight: 20,
                  },
              axisBorder: {
                show: false,

            }
            },
            yaxis: [{
              title: {
                text: 'Sales',
              },
              labels: {
                    minWidth: 19,
                    maxWidth: 19,
                },
              tickAmount: 3,
              min: 0
            }, {
              title: {
                text: 'Appointments',
              },
              opposite: true,
              tickAmount: 3,
              min: 0
            }]
          };

          const chart = new ApexCharts(document.querySelector("#chart-02"), options);
          chart.render();
        }
    })

</script>

@endpush
