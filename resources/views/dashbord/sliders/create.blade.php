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
            FilePondPluginImagePreview,
            FilePondPluginFilePoster
        );
        const pondproduct = FilePond.create(productImage, {
            server: {
                url: '/dashbord/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            allowImagePreview: true,
            labelIdle: `{{ __('Drag & Drop your slider image or') }}<span class="filepond--label-action"> {{ __('browser') }} <span/>`
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

                            <h4 class="card-title">{{ __('Slider Information') }}</h4>
                            <p class="card-title-desc">{{ __('Fill all information below') }}</p>

                            <div class="row">
                                <div class=>
                                    <div class="mb-3">
                                        <label for="title">{{ __('title of slider') }} </label>
                                        <input required placeholder="slider title" id="title" value="{{ old('title') }}"
                                            name="title" type="text" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <input type="file" id="image" name="image" class="my-pond">
                                    </div>
                                    <div class="mb-3">

                                        <div class="form-check form-switch form-switch-md mb-3">
                                            <label class="form-check-label" for="SwitchCheckSizemd">active slider</label>
                                            <input class="form-check-input" type="checkbox" id="SwitchCheckSizemd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-light">{{ __('Save Slider') }}</button>
                    </div>
                </div>
        </form>
    </div> <!-- container-fluid -->
    </div>
@endsection
