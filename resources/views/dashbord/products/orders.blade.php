@extends('dashbord.layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card p-3">
                        <form class="app-search d-none d-lg-block mx-3">
                            <div class="position-relative">
                                <input type="text" name="search" @if (request()->get('search')) autofocus @endif
                                    value="{{ request()->get('search') }}" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">{{ __('transaction id') }}</th>
                                        <th scope="col">{{ __('amount') }}</th>
                                        <th scope="col">{{ __('user') }}</th>
                                        <th scope="col">{{ __('created at') }}</th>
                                        <th scope="col">{{ __('donate') }}</th>
                                        <th scope="col">{{ __('delivered') }}</th>
                                        <th scope="col">{{ __('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>

                                                <h5 class="font-size-14 mb-1"><a
                                                        class="text-dark">{{ $order->transaction_id }} </h5>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a
                                                        class="text-dark">{{ $order->amount }}<span
                                                            class="font-size-10 text-muted">
                                                            ({{ $order->currency }})
                                                        </span></a>
                                                </h5>
                                            </td>
                                            <td>
                                                <div class="dropdown d-inline-block position-relative">
                                                    <button type="button" class="btn p-0 px-1 noti-icon  text-primary "
                                                        id="page-header-product-dropdown" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">

                                                        {{ $order->user->firstname . ' ' . $order->user->lastname }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 "
                                                        aria-labelledby="page-header-notifications-dropdown"
                                                        data-popper-placement="top">

                                                        <div data-simplebar="init" style="max-height: 300px;">
                                                            <div class="simplebar-wrapper" style="margin: 0px;">
                                                                <div class="simplebar-height-auto-observer-wrapper">
                                                                    <div class="simplebar-height-auto-observer"></div>
                                                                </div>
                                                                <div class="simplebar-mask">
                                                                    <div class="simplebar-offset"
                                                                        style="right: -17px; bottom: -20px;">
                                                                        <div class="simplebar-content-wrapper"
                                                                            style="height: auto; overflow: hidden scroll;">
                                                                            <div class="simplebar-content"
                                                                                style="padding: 0px;">
                                                                                <a href="javascript: void(0);"
                                                                                    class="text-reset notification-item">
                                                                                    <div class="d-flex">
                                                                                        <div class="avatar-sm me-3">
                                                                                            <img src="{{ asset($order->user->avatar) }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                        <div class="flex-grow-1">
                                                                                            <h6 class="mb-1"
                                                                                                key="t-your-username text-dark">
                                                                                                {{ $order->user->username }}
                                                                                            </h6>
                                                                                            <div
                                                                                                class="font-size-12 text-muted">
                                                                                                <p class="mb-1"
                                                                                                    key="t-email">
                                                                                                    {{ $order->user->email }}
                                                                                                </p>
                                                                                                <p class="mb-0">

                                                                                                    <span key="t-min-ago">
                                                                                                        {{ $order->user->phone }}</span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="simplebar-placeholder"
                                                                    style="width: auto; height: 388px;"></div>
                                                            </div>
                                                            <div class="simplebar-track simplebar-horizontal"
                                                                style="visibility: hidden;">
                                                                <div class="simplebar-scrollbar"
                                                                    style="transform: translate3d(0px, 0px, 0px); display: none;">
                                                                </div>
                                                            </div>
                                                            <div class="simplebar-track simplebar-vertical"
                                                                style="visibility: visible;">
                                                                <div class="simplebar-scrollbar"
                                                                    style="transform: translate3d(0px, 0px, 0px); display: block; height: 136px;">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                {{-- <a class="text-primary"></a> --}}
                                                </h5>
                                            </td>

                                            <td> <span
                                                    class="badge-soft-primary px-2 rounded shadow-sm ">{{ $order->created_at->format('d-m-y h:m:s A') }}</span>
                                            </td>


                                            <td>

                                                @if ($order->is_donate)
                                                    <span
                                                        class=" border  badge-soft-success px-1 rounded border-2 border-success ">
                                                        yes
                                                    @else
                                                        <span
                                                            class=" border  badge-soft-danger px-1 rounded border-2 border-danger ">
                                                            no
                                                @endif

                                                </span>
                                            </td>
                                            <td>

                                                @if ($order->is_donate)
                                                    <span
                                                        class=" border  badge-soft-success px-1 rounded border-2 border-success ">
                                                        yes
                                                    @else
                                                        <span
                                                            class=" border  badge-soft-danger px-1 rounded border-2 border-danger ">
                                                            no
                                                @endif

                                                </span>
                                            </td>
                                            <td class="text-dark">
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item px-2">
                                                        <a href="https://maps.google.com/?q=30.28882, -9.588312"
                                                            title="location"><i class="bx bx-map"></i></a>

                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <a href="" title="Edit"><i class=" bx bx-pencil"></i></a>
                                                    </li>

                                                    <li class="list-inline-item px-2">
                                                        <a href="" title="orders"><i class=" bx bx-receipt "></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
    </div>
@endsection
