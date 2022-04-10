@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Smtp Setting Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('smtpSettings.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('smtp_settings.show_fields')
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('smtpSettings.activate',['id'=>$smtpSetting->id]) }}" class="btn btn-warning">Activate</a>
            </div>
        </div>
    </div>
@endsection
