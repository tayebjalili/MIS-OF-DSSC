@extends('panel.layouts.app')

@section('content')

<div class="pagetitle">
  <h1>@lang('messages.edit_user')</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-9">

      <h5 class="mb-4">@lang('messages.edit_user')</h5>

      <form action="" method="post">
        {{ csrf_field() }}

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.name')</label>
          <div class="col-sm-12">
            <input type="text" name="name" value="{{ $getRecord->name }}" required class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.email')</label>
          <div class="col-sm-12">
            <input type="email" name="email" value="{{ $getRecord->email }}" readonly class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.password')</label>
          <div class="col-sm-12">
            <input type="text" name="password" class="form-control">
            <small class="text-muted">@lang('messages.change_password')</small>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.role')</label>
          <div class="col-sm-12">
            <select class="form-control" name="role_id" required>
              <option value="">@lang('messages.select')</option>
              @foreach($getRole as $value)
                <option value="{{ $value->id }}" {{ $getRecord->role_id == $value->id ? 'selected' : '' }}>
                  {{ $value->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
          </div>
        </div>

      </form>

    </div>
  </div>
</section>

@endsection
