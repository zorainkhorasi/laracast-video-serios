<x-layout>
<x-slot:heading>
    Job Listing Page
</x-slot:heading>

<h1><strong>Job listing:</strong></h1>

<ul>
    @foreach ($jobs as $job )
      <li>  
    <a href="{{route('listing',$job->id)}}">{{$job['title']}}</a>
    </li>
    @endforeach    
</ul>

  <div>
      {{$jobs->links()}}
  </div>


</x-layout>