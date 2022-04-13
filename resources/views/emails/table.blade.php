@push('third_party_stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jsonview/1.2.3/jquery.jsonview.min.css" integrity="sha512-aM9sVC1lVWwuuq38iKbFdk04uGgRyr7ERRnO990jReifKRrYGLugrpLCj27Bfejv6YnAFW2iN3sm6x/jbW7YBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('third_party_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jsonview/1.2.3/jquery.jsonview.min.js" integrity="sha512-ff/E/8AEnLDXnTCyIa+l80evPRNH8q5XnPGY/NgBL645jzHL1ksmXonVMDt7e5D34Y4DTOv+P+9Rmo9jBSSyIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endpush
<div class="table-responsive">
    <table class="table" id="emails-table">
        <thead>
        <tr>
            <th>uuid</th>
            <th>Failed At</th>
            <th>Actions</th>
            {{-- <th colspan="3">Action</th> --}}
        </tr>
        </thead>
        <tbody>
        @foreach($failedJobs as $job)
            <tr>
                <td>{{ $job->uuid }}</td>
                <td > {{ $job->failed_at }} </td>
                <td width="120">
                    {!! Form::open(['route' => ['emails.destroy', $job->uuid], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('emails.show', [$job->uuid]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        {{-- <a href="{{ route('emails.edit', [$job->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

