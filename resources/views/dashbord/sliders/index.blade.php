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
                        <div class="col d-flex justify-content-end mx-3">
                            <a type="button" href="{{ route('dashbord.sliders.create') }}"
                                class="btn btn-success waves-effect waves-light d-block mx-1 font-size-14 ">
                                <i class=" bx bx-add-to-queue  font-size-16 align-middle me-2"></i>
                                create
                            </a>
                        </div>
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

                                        <th scope="col">{{ __('title') }}</th>
                                        <th scope="col">{{ __('image') }}</th>
                                        <th scope="col">{{ __('active') }}</th>

                                        <th scope="col">{{ __('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>

                                            <td>
                                                <h5 class="font-size-14 mb-1"><a
                                                        class="text-dark">{{ $slider->title }}</a>
                                                </h5>
                                            </td>

                                            <td class="text-dark"><img src="{{ asset($slider->image) }}" alt=""></td>
                                            <td>

                                                @if ($slider->active)
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
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item px-2 ">
                                                        <form method="POST" id="form_delete"
                                                            action="{{ route('dashbord.sliders.delete', ['id' => $slider->id]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <a class="delete" role='button'
                                                                onclick="$(this).parent().submit()" title="Delete"><i
                                                                    class="bx bx-trash-alt text-danger "></i></a>
                                                        </form>
                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <a href="{{ route('dashbord.sliders.edit', ['id' => $slider->id]) }}"
                                                            title="Edit"><i class=" text-warning bx bx-pencil"></i></a>
                                                    </li>


                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $sliders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
    </div>
@endsection
