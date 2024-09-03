<x-layout>
    <x-slot:heading>
        Job Detail Page
    </x-slot:heading>
    
    <h1><strong>{{$findJob->title}}</strong></h1>
    <h2>Salaray:</h2>
    <ul>
        <li>{{$findJob->salary}}</li>
    </ul>

    {{-- @can('user-edit',$findJob)  // for gates
    <p class="mt-6">
        <a href="{{route('jobs.edit',$findJob->id)}}"><x-button >Edit Job</x-button></a>

     </p>    
    @endcan
     --}}
    
        {{-- for policy --}}
        {{-- it will search for update function in JobPolicy class  --}}
       @can('update',$findJob)  
    <p class="mt-6">
        <a href="{{route('jobs.edit',$findJob->id)}}"><x-button >Edit Job</x-button></a>
     </p>    
    @endcan
    
    </x-layout>