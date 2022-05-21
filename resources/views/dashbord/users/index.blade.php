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
                                <input type="text" class="form-control" value="{{ Request::get('search') }}" name="search"
                                    placeholder="Search...">
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
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">{{ __('username') }}</th>
                                        <th scope="col">{{ __('email') }}</th>
                                        <th scope="col">{{ __('phone') }}</th>
                                        <th scope="col">{{ __('residence') }}</th>
                                        <th scope="col">{{ __('status') }}</th>
                                        <th scope="col">{{ __('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title avatar-sm rounded-circle">
                                                        <img class="avatar-sm rounded" src="{{ asset($user->avatar) }}"
                                                            alt="avatar">
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                                                        class="text-dark">{{ $user->firstname . ' ' . $user->lastname }}</a>
                                                </h5>
                                                <p class="text-muted mb-0">costomeer</p>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->residence->{'name_' . app()->getLocale()} ?? 'NAN' }}</td>

                                            <td>
                                                <span
                                                    class=" border  badge-soft-success px-1 rounded border-2 border-success ">
                                                    active
                                                </span>
                                            </td>
                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item px-2">
                                                        <form method="POST" id="form_delete"
                                                            action="{{ route('dashbord.users.delete', ['id' => $user->id]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <a class="delete" role='button'
                                                                onclick="document.getElementById('form_delete').submit()"
                                                                title="Delete"><i class="bx bx-trash-alt "></i></a>
                                                        </form>
                                                    </li>
                                                    {{-- <li class="list-inline-item px-2">
                                                        <a href="/user/edit/109" title="Edite"><i
                                                                class="bx bx-user-circle"></i></a>
                                                    </li> --}}
                                                    <li class="list-inline-item px-2">
                                                        <a href="/user/block/109" title="Block    "><i
                                                                class="bx bx-block"></i></a>
                                                    </li>

                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
    </div>
@endsection
