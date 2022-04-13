<div class="table-responsive">
    <table class="table" id="emails-table">
        <thead>
        <tr>
            <th>Email</th>
            <th>Exception</th>
            {{-- <th>payload</th> --}}
            {{-- <th colspan="3">Action</th> --}}
        </tr>
        </thead>
        <tbody>
        @foreach($failedJobs as $job)
        @php
            $jsonpayload = json_decode($job->payload);
            $payloadCommand = unserialize($jsonpayload->data->command);
            $user = $payloadCommand->data['user'];
            $exception  = explode("\n", $job->exception);
        @endphp
            <tr>
                <td>{{ $user->email }}</td>
                <td style="color: red;">{{ $exception[0] }}</td>
                {{-- <td>{{ $payloadCommand }}</td> --}}
                {{-- <td width="120">
                    {!! Form::open(['route' => ['emails.destroy', $job->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('emails.show', [$job->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('emails.edit', [$job->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td> --}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
