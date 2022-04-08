<!-- From Field -->
<div class="form-group col-sm-12">
    {!! Form::label('from', 'From:') !!}
    {!! Form::text('from', null, ['class' => 'form-control']) !!}
</div>

<!-- To Field -->
<div class="form-group col-sm-12">
    {!! Form::label('to', 'To:') !!}
    {!! Form::text('to', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Field -->
<div class="form-group col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Attachment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attachment', 'Attachment:') !!}
    {!! Form::text('attachment', null, ['class' => 'form-control']) !!}
</div>
