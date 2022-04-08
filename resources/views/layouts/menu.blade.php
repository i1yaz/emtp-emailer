<li class="nav-item">
    <a href="{{ route('smtpSettings.index') }}"
       class="nav-link {{ Request::is('smtpSettings*') ? 'active' : '' }}">
        <p>Smtp Settings</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('emails.index') }}"
       class="nav-link {{ Request::is('emails*') ? 'active' : '' }}">
        <p>Emails</p>
    </a>
</li>


