<div class="mb-3">
    <label>First Name</label>
    <input type="text" name="first_name" value="{{ old('first_name', $participant->first_name ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Last Name</label>
    <input type="text" name="last_name" value="{{ old('last_name', $participant->last_name ?? '') }}" class="form-control">
</div>

<div class="mb-3">
    <label>Gender</label>
    <select name="gender" class="form-control">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
</div>

<div class="mb-3">
    <label>Focus</label>
    <select name="focus" class="form-control">
        <option value="Healthcare">Healthcare</option>
        <option value="Finance">Finance</option>
    </select>
</div>

<div class="mb-3">
    <label>Class</label>
    <input type="number" name="class" value="{{ old('class', $participant->class ?? '') }}" class="form-control">
</div>
