@extends('dashbord.layouts.app')

@section('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <style>
        .filepond--credits {
            display: none;
        }

        .filepond--drop-label {
            border: 1.5px #9b9a9ad9 dashed;
            border-radius: 6px;
        }

    </style>
@endsection

@section('js')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        const productImage = document.querySelector('#image');
        const awardImage = document.querySelector('#award_image');

        FilePond.registerPlugin(
            FilePondPluginFilePoster,
            FilePondPluginImagePreview
        );
        const pondproduct = FilePond.create(productImage, {
            server: {
                url: '/dashbord/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            allowImagePreview: true,

        });

        const pond = FilePond.create(awardImage, {
            server: {
                url: '/dashbord/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            allowImagePreview: true,
            labelIdle: `{{ __('Drag & Drop your award image or') }}<span class="filepond--label-action"> {{ __('browser') }} <span/>`
        });
    </script>
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            @if ($errors->any())
                <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
            @endif

        </div>
        <!-- end page title -->

        <form method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ __('Product Information') }}</h4>
                            <p class="card-title-desc">{{ __('Fill all information below') }}</p>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="name_en">{{ __('English Product Name') }} </label>
                                        <input required placeholder="English Product Name" id="name_en"
                                            value="{{ old('name_en') ?? $product->name_en }}" name="name_en" type="text"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="productdesc">{{ __('English Product Description') }}</label>
                                        <textarea placeholder="English Product Description" name="description_en" class="form-control" id="productdesc"
                                            rows="4">{{ old('description_en') ?? $product->description_en }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price">{{ __('Price') }} <span
                                                class="font-size-10 text-muted">(aed)</span></label>
                                        <input required placeholder="{{ __('Price') }}" id="price"
                                            value="{{ old('price') ?? $product->price }}" name="price" type="text"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity">{{ 'quantity' }} </label>
                                        <input required placeholder="{{ 'quantity' }}" id="quantity"
                                            value="{{ old('quantity') ?? $product->quantity }}" name="quantity"
                                            type="number" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="old-image">{{ 'old image of product' }} </label>
                                        <img id="old-image" class="img-fluid d-block mx-auto"
                                            src="{{ asset($product->image) }}" data-holder-rendered="true" width="400">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="name_ar">{{ __('Arabic Product Name') }} </label>
                                        <input required placeholder="{{ __('Arabic Product Name') }}" id="name_ar"
                                            value="{{ old('name_ar') ?? $product->name_ar }}" name="name_ar" type="text"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="productdesc">{{ __('Arabic Product Description') }}</label>
                                        <textarea placeholder="{{ __('Arabic Product Description') }}" name="description_ar" class="form-control"
                                            id="productdesc"
                                            rows="4">{{ old('description_ar') ?? $product->description_ar }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="control-label">{{ __('Category') }}</label>
                                        <select value="{{ old('category_id') ?? $product->category_id }}"
                                            name="category_id" class="form-control select2">
                                            <option value="none" class="text-dark"> chose category ...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id == $product->product_category_id) selected="true" @endif>
                                                    {{ $category->{'name_' . app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="coupon_per_unit">{{ __('Coupon Per Unit') }}</label>
                                        <input required id="coupon_per_unit" placeholder="{{ __('Coupon Per Unit') }}"
                                            value="{{ old('coupon_per_unit') ?? $product->coupon_per_unit }}"
                                            name="coupon_per_unit" type="number" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="closing_at">{{ __('closing at') }}</label>
                                        <input required placeholder="{{ __('closing at') }}" id="closing_at"
                                            value="{{ old('closing_at') ?? $product->closing_at }}" name="closing_at"
                                            type="datetime-local" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <input type="file" id="image" name="image" class="my-pond" id="">
                                    </div>
                                </div>
                                <div class="col-sm-6 justify-content-center position-relative">

                                </div>
                            </div>




                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ __('award Information') }}</h4>
                            <p class="card-title-desc">{{ __('Fill all information below') }}</p>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="award_name_en">{{ __('English Award Name') }}</label>
                                        <input required placeholder="{{ __('English Award Name') }}" id="award_name_en"
                                            value="{{ old('award_name_en') ?? $product->award_name_en }}"
                                            name="award_name_en" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="metadescription_en"> {{ __('English Award Description') }}</label>
                                        <textarea placeholder="{{ __('English Award Description') }}" name="award_description_en" class="form-control"
                                            id="metadescription_en"
                                            rows="5">{{ old('award_description_en') ?? $product->award_description_en }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="old-image">{{ 'old image of product' }} </label>
                                        <img id="old-image" class="img-fluid d-block mx-auto"
                                            src="{{ asset($product->award_image) }}" data-holder-rendered="true"
                                            width="400">
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="award_name_ar">{{ __('Arabic Award Name') }}</label>
                                        <input required placeholder="{{ __('Arabic Award Name') }}" id="award_name_ar"
                                            value="{{ old('award_name_ar') ?? $product->award_name_ar }}"
                                            name="award_name_ar" type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="metadescription_ar"> {{ __('English Award Description') }}</label>
                                        <textarea placeholder="{{ __('English Award Description') }}" name="award_description_ar" class="form-control"
                                            id="metadescription_ar"
                                            rows="5">{{ old('award_description_ar') ?? $product->award_description_ar }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input type="file" id="award_image" name="award_image" class="my-pond" id="">
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-warning waves-effect waves-light">Save Changes</button>
                    </div>

                </div>
            </div>
        </form>
    </div> <!-- container-fluid -->
    </div>
@endsection
