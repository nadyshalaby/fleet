@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card" x-data="FORMS.station({{ isset($station) ? $station->toJson() : 'undefined' }})"
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
                                <label for="name" class="col-sm-2 col-form-label">Notes</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="notes" name="notes" placeholder="Notes"
                                        x-model="form.notes"></textarea>
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
