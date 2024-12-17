<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprints Report</title>
</head>
<body>

    <h1>Sprints Report</h1>

    @foreach($sprints as $sprint)
        <div>
            <p><strong>Created By:</strong> {{ $sprint->created_by ?? 'Unknown' }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($sprint->created_at)->format('Y.m.d') }}</p>
            <p><strong>Duration:</strong> {{ $sprint->duration_weeks }} weeks</p>
            <p><strong>Title:</strong> {{ $sprint->title }}</p>
            <p><strong>Project:</strong> {{ $sprint->project->name ?? 'Unknown' }}</p>
            <p><strong>Description:</strong> {{ $sprint->description }}</p>
            <p><strong>Start Date:</strong> {{ $sprint->start_date }}</p>
            <p><strong>End Date:</strong> {{ $sprint->end_date }}</p>
            <hr>
        </div>
    @endforeach

</body>
</html>