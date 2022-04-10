<!-- Host Field -->
<div class="col-sm-12">
    {!! Form::label('host', 'Host:') !!}
    <p>{{ $smtpSetting->host }}</p>
</div>

<!-- Port Field -->
<div class="col-sm-12">
    {!! Form::label('port', 'Port:') !!}
    <p>{{ $smtpSetting->port }}</p>
</div>

<!-- Username Field -->
<div class="col-sm-12">
    {!! Form::label('username', 'Username:') !!}
    <p>{{ $smtpSetting->username }}</p>
</div>

<!-- Password Field -->
<div class="col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $smtpSetting->password }}</p>
</div>

<!-- Encryption Field -->
<div class="col-sm-12">
    {!! Form::label('encryption', 'Encryption:') !!}
    <p>{{ $smtpSetting->encryption }}</p>
</div>

<!-- From Address Field -->
<div class="col-sm-12">
    {!! Form::label('from_address', 'From Address:') !!}
    <p>{{ $smtpSetting->from_address }}</p>
</div>
<!-- From Address Field -->
<div class="col-sm-12">
    {!! Form::label('from_name', 'From Name:') !!}
    <p>{{ $smtpSetting->from_name }}</p>
</div>


