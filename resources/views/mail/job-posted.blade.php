<h2>
    {{ $job->title }}
</h2>

<p>
    Congrats! Your job is now live on our website.
</p>

<p>
    {{-- //always use url() in mail blade so that it can be accesible in local as well as production --}}
    <a href="{{ url('/listing/' . $job->id) }}">View Your Job Listing</a>
</p>