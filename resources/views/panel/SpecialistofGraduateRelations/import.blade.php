@extends('panel.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>{{ __('messages.import_graduate_relations') }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            @include('_message')

            <h5 class="mb-3">{{ __('messages.import_data') }}</h5>

            <div class="alert alert-info">
                <h6><i class="bi bi-info-circle"></i> {{ __('messages.import_instructions') }}</h6>
                <ul>
                    <li>{{ __('messages.import_instruction1') }}</li>
                    <li>{{ __('messages.import_instruction2') }}</li>
                    <li>{{ __('messages.import_instruction3') }}</li>
                </ul>
                <a href="{{ route('relations.download-template') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-download"></i> {{ __('messages.download_template') }}
                </a>
            </div>

            {{-- NEW CUSTOM INSTRUCTIONS --}}
            <div class="alert alert-info">
                <h6><i class="bi bi-info-circle"></i> Import Instructions</h6>
                <ul>
                    <li>For Excel: Download the template file and fill in the data</li>
                    <li>For Word: Create a table with the same columns as the Excel template</li>
                    <li>First row should contain headers</li>
                    <li>Ensure all required fields are filled</li>
                </ul>
            </div>

            <form action="{{ route('relations.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">{{ __('messages.select_file') }}</label>
                    <div class="col-sm-9">
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv,.doc,.docx" required>
                        <small class="text-muted">{{ __('messages.allowed_formats') }}</small>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-upload"></i> {{ __('messages.import') }}
                    </button>
                    <a href="{{ route('relations.list') }}" class="btn btn-secondary">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
            </form>

            @if(session('import_errors'))
                <div class="mt-4 border border-danger rounded p-3">
                    <h5 class="text-danger mb-3">{{ __('messages.import_errors') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.row') }}</th>
                                    <th>{{ __('messages.field') }}</th>
                                    <th>{{ __('messages.error') }}</th>
                                    <th>{{ __('messages.value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('import_errors') as $failure)
                                    @foreach($failure->errors() as $error)
                                        <tr>
                                            <td>{{ $failure->row() }}</td>
                                            <td>{{ $failure->attribute() }}</td>
                                            <td>{{ $error }}</td>
                                            <td>{{ $failure->values()[$failure->attribute()] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>
@endsection
