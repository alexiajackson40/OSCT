<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Edit Admin Schedule Page -->
<body>
    <div id="header"></div>
    <div class="main-content">
        <div class="schedule-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Edit Schedule</h1>
                    <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="school_name">School Name</label>
                            <input type="text" class="form-control" id="school_name" name="school_name" value="{{ $schedule->school_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="visit_date">Visit Date</label>
                            <input type="date" class="form-control" id="visit_date" name="visit_date" value="{{ $schedule->visit_date }}" required>
                        </div>
                        <div class="form-group">
                            <label for="visit_time">Visit Time</label>
                            <input type="time" class="form-control" id="visit_time" name="visit_time" value="{{ $schedule->visit_time }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
