@extends('layouts.app')
@section('content')
    <div class="container-sm my-5">
        <div class="row justify-content-center">
            <form action="{{ route('employees.update', ['employee' => $employee->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row justify-content-center">
                    <div class="p-5 bg-light rounded-3 col-xl-6">
                        <div class="mb-3 text-center">
                            <i class="bi-person-circle fs-1"></i>
                            <h4>Edit Employee</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input class="form-control @error('firstName') is-invalid @enderror" type="text"
                                    name="firstName" id="firstName"
                                    value="{{ $errors->any() ? old('firstName') : $employee->firstname }}"
                                    placeholder="Enter First Name">
                                @error('firstName')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input class="form-control @error('lastName') is-invalid @enderror" type="text"
                                    name="lastName" id="lastName"
                                    value="{{ $errors->any() ? old('lastName') : $employee->lastname }}"
                                    placeholder="Enter Last Name">
                                @error('lastName')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text"
                                    name="email" id="email"
                                    value="{{ $errors->any() ? old('email') : $employee->email }}"
                                    placeholder="Enter Email">
                                @error('email')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input class="form-control @error('age') is-invalid @enderror" type="text" name="age"
                                    id="age" value="{{ $errors->any() ? old('age') : $employee->age }}"
                                    placeholder="Enter Age">
                                @error('age')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="position" class="form-label">Position</label>
                                <select name="position" id="position" class="form-select">
                                    @php
                                        $selected = '';
                                        if ($errors->any()) {
                                            $selected = old('position');
                                        } else {
                                            $selected = $employee->position_id;
                                        }
                                    @endphp
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}"
                                            {{ $selected == $position->id ? 'selected' : '' }}>
                                            {{ $position->code . ' - ' . $position->name }}</option>
                                    @endforeach
                                </select>
                                @error('position')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="cv" class="form-label">Curriculum Vitae (CV)</label>

                                <h6 class="text-dark" id="tv_exist">
                                    {{ $employee->original_filename ? $employee->original_filename : 'Tidak ada' }}
                                </h6>

                                <input type="hidden" value="0" name="file-deleted" id="file-deleted">
                                <div id="wrap-exist">
                                    @if ($employee->original_filename)
                                        <a class="btn btn-primary btn-sm mb-2" target="_blank"
                                            href="{{ route('employees.downloadFile', $employee->id) }}">Download</a>
                                        <a class="btn btn-danger btn-sm mb-2" onclick="deleteFile()">Delete</a>
                                    @endif
                                </div>

                                <input type="file" class="form-control" name="cv" id="cv">
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
                                    Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function deleteFile() {
            document.getElementById('file-deleted').value = 1;
            document.getElementById('wrap-exist').innerHTML = '';
            document.getElementById('tv_exist').innerHTML = '';
        }
    </script>
@endsection
