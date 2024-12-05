@extends('layouts.app')
@section('content')
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 border col-xl-6">

                <!-- Menampilkan pesan error jika ada -->
                <div class="mb-3 text-center">
                    <i class="bi-person-circle fs-1"></i>
                    <h4>Edit Employee</h4>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input class="form-control @error('firstname') is-invalid @enderror" type="text" name="firstname"
                            id="firstname" value="{{ old('firstname', $employee->firstname) }}"
                            placeholder="Enter First Name">
                        @error('firstname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname"
                            id="lastname" value="{{ old('lastname', $employee->lastname) }}" placeholder="Enter Last Name">
                        @error('lastname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                            id="email" value="{{ old('email', $employee->email) }}" placeholder="Enter Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input class="form-control @error('age') is-invalid @enderror" type="text" name="age"
                            id="age" value="{{ old('age', $employee->age) }}" placeholder="Enter Age">
                        @error('age')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="position" class="form-label">Position</label>
                        <select name="position" id="position" class="form-control @error('position') is-invalid @enderror">
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}"
                                    {{ old('position', $employee->position_id) == $position->id ? 'selected' : '' }}>
                                    {{ $position->code . ' - ' . $position->name }}</option>
                            @endforeach
                        </select>
                        @error('position')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i
                                class="bi-arrow-left-circle me-2"></i> Cancel</a>
                    </div>
                    <div class="col-md-6 d-grid">
                        <button type="submit" class="btn btn-dark btn-lg mt-3"><i class="bi-check-circle me-2"></i>
                            Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
