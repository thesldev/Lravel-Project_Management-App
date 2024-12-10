<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="mb-4">Project Report</h1>
        
        <!-- Display the report title and description -->
        <div class="mb-4">
            <h2>{{ $report->title }}</h2>
            <p>{{ $report->description }}</p>
        </div>

        @if (count($columns) > 0 && $projects->isNotEmpty())
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            @foreach ($columns as $column)
                                <td>
                                    @if (isset($project->$column))
                                        {{ $project->$column }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning" role="alert">
                No project data available or no columns selected.
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
