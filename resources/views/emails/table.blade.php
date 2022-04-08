<div class="table-responsive">
    <table class="table" id="emails-table">
        <thead>
        <tr>
            <th>From</th>
        <th>To</th>
        <th>Subject</th>
        <th>Body</th>
        <th>Attachment</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($emails as $email)
            <tr>
                <td>{{ $email->from }}</td>
            <td>{{ $email->to }}</td>
            <td>{{ $email->subject }}</td>
            <td>{{ $email->body }}</td>
            <td>{{ $email->attachment }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['emails.destroy', $email->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('emails.show', [$email->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('emails.edit', [$email->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
