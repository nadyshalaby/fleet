@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card" x-data="FORMS.user({{ isset($user) ? $user->toJson() : 'undefined' }})"
                    x-init="initValidation" @input="handleValidation" @focusout="handleValidation">
                    <div class="card-header" x-text="title"></div>

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text"
                                        :class="{'form-control': true, 'is-invalid': hasErrors('name') && isTouched('name')}"
                                        id="name" name="name" placeholder="Name" x-model="form.name">
                                    <div class="invalid-feedback" x-html="getErrors('name')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email"
                                        :class="{'form-control': true, 'is-invalid': hasErrors('email') && isTouched('email')}"
                                        id="email" name="email" placeholder="Email" x-model="form.email">
                                    <div class="invalid-feedback" x-html="getErrors('email')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select
                                        :class="{'form-control': true, 'is-invalid': hasErrors('role') && isTouched('role')}"
                                        id="role" name="role" x-model="form.role">
                                        <option value="">-- Select --</option>
                                        <option value="admin">Admin</option>
                                        <option value="normal">Normal</option>
                                    </select>
                                    <div class="invalid-feedback" x-html="getErrors('role')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password"
                                        :class="{'form-control': true, 'is-invalid': hasErrors('password') && isTouched('password')}"
                                        id="password" name="password" placeholder="Password" x-model="form.password">
                                    <div class="invalid-feedback" x-html="getErrors('password')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row validated">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Password
                                    Confirmation</label>
                                <div class="col-sm-10">
                                    <input type="password"
                                        :class="{'form-control': true, 'is-invalid': hasErrors('password_confirmation') && isTouched('password_confirmation')}"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Password Confirmation" x-model="form.password_confirmation">
                                    <div class="invalid-feedback" x-html="getErrors('password_confirmation')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" :disabled="hasErrors()">Save
                                        Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
