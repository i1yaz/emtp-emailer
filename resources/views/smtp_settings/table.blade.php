<div class="table-responsive">
    <table class="table" id="smtpSettings-table">
        <thead>
        <tr>
            <th>Host</th>
        <th>Port</th>
        <th>Username</th>
        <th>Password</th>
        <th>Encryption</th>
        <th>From Address</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($smtpSettings as $smtpSetting)
            <tr>
                <td>{{ $smtpSetting->host }}</td>
            <td>{{ $smtpSetting->port }}</td>
            <td>{{ $smtpSetting->username }}</td>
            <td>{{ $smtpSetting->password }}</td>
            <td>{{ $smtpSetting->encryption }}</td>
            <td>{{ $smtpSetting->from_address }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['smtpSettings.destroy', $smtpSetting->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('smtpSettings.show', [$smtpSetting->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('smtpSettings.edit', [$smtpSetting->id]) }}"
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
