@push('third_party_stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

<!-- To Field -->
<div class="form-group col-sm-12">
    {!! Form::label('to', 'To:') !!}
    {!! Form::select('to', $contact, null,['class' => 'form-control s2-multiple-select','multiple'=>'multiple','name'=>'to[]']) !!}
</div>
{{-- <livewire:fetch-user-email/> --}}
<!-- Subject Field -->
<div class="form-group col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-11">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'compose-email']) !!}
</div>

<!-- Placeholders Field -->
<div class="form-group col-sm-12 col-lg-1">
    {!! Form::label('tags', 'Tags:') !!}

    <div  style="display: block" >

        <span style="font-size: small;">
            <a href="javascript:replaceTag('@first_name')">@first_name</a>
            <br>
            <a href="javascript:replaceTag('@last_name')">@last_name</a>
            <br>
            <a href="javascript:replaceTag('@recipient_name')">@recipient_name</a>
            <br>
            <a href="javascript:replaceTag('@email')">@email</a>
            <br>
            <a href="javascript:replaceTag('@phone')">@phone</a>
        </span>
    </div>
</div>

<!-- Attachment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attachment', 'Attachment:') !!}
    {!! Form::file('attachments[]',['multiple'=>true,'class'=>'']); !!}
</div>
@push('third_party_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.s2-multiple-select').select2();
            $('#compose-email').summernote({
                height: 100
            });

        });
        function replaceTag(tag) {
                console.log(tag);
                $("#compose-email").summernote('insertText', tag)
            }
        </script>

@endpush

