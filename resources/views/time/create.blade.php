<div class="container">
    <form action="{{ route('time.store') }}" method="post">
    {{ csrf_field() }}
        <div>
            <label for="project">Project: </label>
            <select id="project" name="projectselect">
                <option>Select</option>
                @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label for="task">Task: </label>
            <select id="task" name="task_id">
                <option>Select</option>
                @foreach ($tasks as $task)
                <option value="{{ $task->id }}">{{ $task->name }}</option>
                @endforeach
            </select>
            {{ $errors->first('task_id') }}
        </div>
        <br>
        <div>
            <label for="Activity">Activity Name: </label>
            <select id="Activity" name="activity_id">
                <option>Select</option>
                @foreach ($activities as $activity)
                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                @endforeach
            </select>
            {{ $errors->first('name') }}
        </div>
        <br>
        <div>
            <label>I started my work: </label>
            <input type="time" id="hms" name="started" min="00:00" max="24:59" required>
            {{ $errors->first('started') }}
        </div>
        <br>
        <div>
            <label>I finished my work: </label>
            <input type="time" id="hmf" name="finished" min="00:00" max="24:59" required>
            {{ $errors->first('finished') }}
        </div>
        <br>
        <div>
            <button type="submit">Create </button>
        </div>
    </form>
</div>