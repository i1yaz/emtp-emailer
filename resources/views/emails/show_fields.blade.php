<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $failedJob->id }}</p>
</div>

<!-- From Field -->
<div class="col-sm-12">
    {!! Form::label('uuis', 'UUID:') !!}
    <p>{{ $failedJob->uuid }}</p>
</div>

<!-- To Field -->
<div class="col-sm-12">
    {!! Form::label('exception', 'Exception:') !!}
    <p style="color: red" >{{ $failedJob->exception }}</p>
</div>

