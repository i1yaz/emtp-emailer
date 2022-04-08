<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $email->id }}</p>
</div>

<!-- From Field -->
<div class="col-sm-12">
    {!! Form::label('from', 'From:') !!}
    <p>{{ $email->from }}</p>
</div>

<!-- To Field -->
<div class="col-sm-12">
    {!! Form::label('to', 'To:') !!}
    <p>{{ $email->to }}</p>
</div>

<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{{ $email->subject }}</p>
</div>

<!-- Body Field -->
<div class="col-sm-12">
    {!! Form::label('body', 'Body:') !!}
    <p>{{ $email->body }}</p>
</div>

<!-- Attachment Field -->
<div class="col-sm-12">
    {!! Form::label('attachment', 'Attachment:') !!}
    <p>{{ $email->attachment }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $email->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $email->updated_at }}</p>
</div>

