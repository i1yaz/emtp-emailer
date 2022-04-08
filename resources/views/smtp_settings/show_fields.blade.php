<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $smtpSetting->id }}</p>
</div>

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

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $smtpSetting->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $smtpSetting->updated_at }}</p>
</div>

