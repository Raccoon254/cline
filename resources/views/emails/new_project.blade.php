@component('mail::message')
# {{ $title }}

@component('mail::table')
|                       |               |
| --------------------- |:-------------:|
| Project Name          | {{ $project->name }} |
| Description           | {{ $project->description }} |
| Start Date            | {{ $project->start_date }} |
| End Date              | {{ $project->end_date }} |
| Price                 | {{ $project->price }} |
| Assigned Freelancer   | {{ $user->name }} |
| Client                | {{ $client->name }} |
@endcomponent

@component('mail::button', ['url' => $url])
View Project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
