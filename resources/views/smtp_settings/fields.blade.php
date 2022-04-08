<!-- Host Field -->
<div class="form-group col-sm-6">
    {!! Form::label('host', 'Host:') !!}
    {!! Form::text('host', null, ['class' => 'form-control']) !!}
</div>

<!-- Port Field -->
<div class="form-group col-sm-6">
    {!! Form::label('port', 'Port:') !!}
    {!! Form::text('port', null, ['class' => 'form-control']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div>

<!-- Encryption Field -->
<div class="form-group col-sm-6">
    {!! Form::label('encryption', 'Encryption:') !!}
    {!! Form::text('encryption', null, ['class' => 'form-control']) !!}
</div>

<!-- From Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from_address', 'From Address:') !!}
    {!! Form::text('from_address', null, ['class' => 'form-control']) !!}
</div>