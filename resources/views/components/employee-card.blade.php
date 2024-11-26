<div class="employee-card">
    <div class="card-header">
        <span class="badge badge-info">{{ $workerRole ?? 'No Role' }}</span>
    </div>
    <div class="card-body text-center">
        <img src="{{ $profileImage ?? 'https://bootdey.com/img/Content/avatar/avatar1.png' }}" alt="{{ $name }}" class="rounded-circle mb-3" width="100" height="100">
        <h5 class="card-title">{{ $name }}</h5>
        <p class="card-text">
            <strong>Job Role:</strong> {{ $jobRole }}<br>
            <strong>Position:</strong> {{ $position }}<br>
            <strong>Email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a>
        </p>
    </div>
</div>
