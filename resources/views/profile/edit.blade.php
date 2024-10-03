@extends('layouts.master')

@section('title', 'TAC PRESS | Profile')

@section('content')

    <x-breadcrumb>My Profile</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"> <i class="bi bi-person"></i> {{ __('Profile Information') }}</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> <i class="bi bi-passport"></i> {{ __('Update Credentials') }}</button>
{{--                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>--}}
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                {{-- Profile Information --}}
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

                    <div class="p-3" style="background: #fff"> <!--begin::Form-->
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 20px">#</th>
                                <th>Item</th>
                                <th>Information</th>
                                <th style="width: 40px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="align-middle">
                                <td>1.</td>
                                <td>{{__('Staff ID')}}</td>
                                <td>{{ $staff->staff_number }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>2.</td>
                                <td>{{__('Full Name')}}</td>
                                <td>{{ $staff->full_name }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>3.</td>
                                <td>{{__('Gender')}}</td>
                                <td>{{ $staff->gender_name }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>4.</td>
                                <td>{{__('Date of Birth')}}</td>
                                <td>{{ $staff->date_of_birth }} (Age: {{ $staff->age }})</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>5.</td>
                                <td>{{__('Mobile Number')}}</td>
                                <td>{{ $staff->phone }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>6.</td>
                                <td>{{__('Email')}}</td>
                                <td>{{ $staff->email }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>7.</td>
                                <td>{{__('Address')}}</td>
                                <td>{{ $staff->address }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>8.</td>
                                <td>{{__('Position')}}</td>
                                <td>{{ $staff->position_name }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>9.</td>
                                <td>{{__('Banker')}}</td>
                                <td>{{ $staff->banker }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>10.</td>
                                <td>{{__('Bank Account')}}</td>
                                <td>{{ $staff->bank_account }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>11.</td>
                                <td>{{__('Bank Branch')}}</td>
                                <td>{{ $staff->bank_branch }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>12.</td>
                                <td>{{__('Bank Sort Code')}}</td>
                                <td>{{ $staff->bank_sort_code }}</td>
                                <td></td>
                            </tr>
                            <tr class="align-middle">
                                <td>13.</td>
                                <td>{{__('Ghana Card')}}</td>
                                <td>{{ $staff->ghana_card }}</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                {{-- Update Credentials --}}
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

                    <div class="p-3" style="background: #fff"> <!--begin::Form-->
                        <form method="post" action="{{ route('profile.update') }}"> <!--begin::Body-->
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <h4>Profile Information</h4>
                                <div class="row mb-3">
                                    <label class="col-sm-12 col-form-label">{{ __("Update your account's profile information and email address.") }}</label>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ get_logged_staff_name() }}" id="exampleInputEmail1" aria-describedby="emailHelp" readonly >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}" id="exampleInputEmail1" aria-describedby="emailHelp" autofocus required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Current Password') }}</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="current_password" class="form-control" id="update_password_current_password" aria-describedby="update_password_current_passwordFeedback" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">{{ __('New Password') }}</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" id="update_password_password" aria-describedby="update_password_passwordFeedback" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password_confirmation" class="form-control" id="update_password_password_confirmation" aria-describedby="update_password_password_confirmationFeedback" required>
                                    </div>
                                </div>

                            </div> <!--end::Body--> <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div> <!--end::Footer-->
                        </form> <!--end::Form-->
                    </div>

                </div>
{{--                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">Contact</div>--}}
            </div>
            <!--begin::Profile Form-->
{{--            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->--}}
{{--                <div class="card-header">--}}
{{--                    <div class="card-title"><h4> <i class="bi bi-person"></i> {{ __('Profile Information') }}</h4></div>--}}
{{--                </div> <!--end::Header--> <!--begin::Form-->--}}
{{--                <form method="post" action="{{ route('profile.update') }}"> <!--begin::Body-->--}}
{{--                    @csrf--}}
{{--                    @method('patch')--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row mb-3">--}}
{{--                            <label class="col-sm-12 col-form-label">{{ __("Update your account's profile information and email address.") }}</label>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('Name') }}</label>--}}
{{--                            <div class="col-sm-10">--}}
{{--                                <input type="text" class="form-control" value="{{ get_logged_staff_name() }}" id="exampleInputEmail1" aria-describedby="emailHelp" readonly >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <label for="inputPassword3" class="col-sm-2 col-form-label">{{ __('Email') }}</label>--}}
{{--                            <div class="col-sm-10">--}}
{{--                                <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}" id="exampleInputEmail1" aria-describedby="emailHelp" autofocus required>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div> <!--end::Body--> <!--begin::Footer-->--}}
{{--                    <div class="card-footer">--}}
{{--                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>--}}
{{--                    </div> <!--end::Footer-->--}}
{{--                </form> <!--end::Form-->--}}
{{--            </div> <!--end::Profile Form-->--}}

        </div> <!-- /.container-fluid -->
    </div> <!--end::App Content-->

@endsection
{{-- </x-app-layout> --}}
