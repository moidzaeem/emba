@extends('layouts.app')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">

            <div class="row">
                {{-- Total Participants --}}
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="mini-stat clearfix bg-primary text-white rounded p-3 shadow">
                        <span class="mini-stat-icon bg-white text-primary rounded-circle float-start p-2">
                            <i class="mdi mdi-account fs-3"></i>
                        </span>
                        <div class="mini-stat-info text-end">
                            <span class="counter h4">{{ $participants ?? 0 }}</span>
                            <p class="mb-0">{{ __('Total Participants') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Total Courses --}}
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="mini-stat clearfix bg-success text-white rounded p-3 shadow">
                        <span class="mini-stat-icon bg-white text-success rounded-circle float-start p-2">
                            <i class="mdi mdi-book-open-page-variant fs-3"></i>
                        </span>
                        <div class="mini-stat-info text-end">
                            <span class="counter h4">{{ $courses ?? 0 }}</span>
                            <p class="mb-0">{{ __('Total Courses') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Total Groups --}}
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="mini-stat clearfix bg-warning text-white rounded p-3 shadow">
                        <span class="mini-stat-icon bg-white text-warning rounded-circle float-start p-2">
                            <i class="mdi mdi-account-multiple-plus fs-3"></i>
                        </span>
                        <div class="mini-stat-info text-end">
                            <span class="counter h4">{{ $groups ?? 0 }}</span>
                            <p class="mb-0">{{ __('Total Groups') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add more dashboard sections below -->

        </div> <!-- container-fluid -->
    </div> <!-- page-content-wrapper -->
@endsection
