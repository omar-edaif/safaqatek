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
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>
                        <div class="col d-flex justify-content-end mx-3">
                            <a type="button" href="{{ route('dashbord.products.create') }}"
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
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">{{ __('name') }}</th>
                                        <th scope="col">{{ __('award name') }}</th>
                                        <th scope="col">{{ __('price') }}
                                            <span class="font-size-10 text-muted">(aed)</span>
                                        </th>
                                        <th scope="col">{{ __('quantity') }}</th>
                                        <th scope="col">{{ __('close in') }}</th>
                                        <th scope="col">{{ __('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title avatar-sm rounded-circle">
                                                        <img class="avatar-sm rounded" src="{{ asset($product->image) }}"
                                                            alt="product image">
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                                                        class="text-dark">{{ $product->{'name_' . app()->getLocale()} }}</a>
                                                </h5>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);"
                                                        class="text-dark">{{ $product->{'award_name_' . app()->getLocale()} }}</a>
                                                </h5>
                                            </td>
                                            <td class="text-dark">{{ $product->price }}</td>
                                            <td class="text-dark">{{ $product->quantity }}</td>
                                            <td>
                                                <span
                                                    @if ($product->closing_at->gte(now())) class=" border  badge-soft-success px-1 rounded border-2 border-success "
                                                @else
                                                class=" border  badge-soft-danger px-1 rounded border-2 border-danger " @endif>
                                                    {{ $product->closing_at->format('d M y') }}
                                                </span>
                                            </td>
                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item px-2">
                                                        <a class="delete" href="/user/admins/delete/109"
                                                            title="Delete"><i class="bx bx-trash-alt "></i></a>
                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <a href="{{ route('dashbord.products.edit', ['id' => $product->id]) }}"
                                                            title="Edit"><i class=" bx bx-pencil"></i></a>
                                                    </li>


                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
    </div>
@endsection
