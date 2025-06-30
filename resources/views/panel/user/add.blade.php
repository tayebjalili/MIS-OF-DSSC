@extends('panel.layouts.app')

@section('content')

<div class="pagetitle">
  <h1>@lang('messages.add_new_user')</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-9">

      <h5 class="mb-4">@lang('messages.add_new_user')</h5>

      <form action="" method="post">
        {{ csrf_field() }}

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.name')</label>
          <div class="col-sm-12">
            <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.email')</label>
          <div class="col-sm-12">
            <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
            <div style="color:red">{{ $errors->first('email') }}</div>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.password')</label>
          <div class="col-sm-12">
            <input type="password" name="password" required class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.role')</label>
          <div class="col-sm-12">
            <select class="form-control" name="role_id" required>
              <option value="">@lang('messages.select')</option>
              @foreach($getRole as $value)
                <option value="{{ $value->id }}">{{ $value->name }} ({{ $value->id }})</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
          </div>
        </div>

      </form>

    </div>
  </div>
</section>

@endsection
