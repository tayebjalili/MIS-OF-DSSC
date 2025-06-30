@extends('panel.layouts.app')

@section('content')

<div class="pagetitle">
  <h1>@lang('messages.edit_role')</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-9">

      <h5 class="mb-4">@lang('messages.edit_role')</h5>

      <form action="{{ route('roles.update', $getRecord->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('POST') }}

        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">@lang('messages.name')</label>
          <div class="col-sm-12">
            <input type="text" name="name" value="{{ $getRecord->name }}" required class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <label style="display: block; margin-bottom: 20px;" for="inputText" class="col-sm-12 col-form-label">
            <b>@lang('messages.permission')</b>
          </label>

          @foreach($getPermission as $groupName => $permissions)
            <div class="row mb-4">
              <div class="col-md-3">
                <strong>{{ ucfirst($groupName) }}</strong>  <!-- Group Name -->
              </div>

              <div class="col-md-9">
                <div class="row">
                  @foreach($permissions as $permission)
                    @php
                      $checked = '';
                      foreach ($getRolePermission as $rolePermission) {
                          if ($rolePermission->permission_id == $permission->id) {
                              $checked = 'checked';
                              break;
                          }
                      }
                    @endphp
                    <div class="col-md-3">
                      <label>
                        <input type="checkbox" {{ $checked }} value="{{ $permission->id }}" name="permission_id[]">
                        {{ $permission->name }}
                      </label>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <hr>
          @endforeach
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
