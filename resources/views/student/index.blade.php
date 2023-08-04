@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Students</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2"></i>Add New Student</button>
          </div>
          <div class="card-body" id="show_all_employees">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form  id="add_employee_form" enctype="multipart/form-data">
      @csrf
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="fname">Name</label>
            <input type="text" name="fname" class="form-control" required>
          </div>
        </div>
        <div class="my-2">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control"  required>
        </div>
        <div class="my-2">
          <label for="phone">Phone</label>
          <input type="tel" name="phone" class="form-control" required>
        </div>
        <div class="my-2">
          <label for="post">Course</label>
          <input type="text" name="course" class="form-control"  required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary add_student">Add Staff</button>
      </div>
    </form>
  </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    // jqdocReady
    // jqon
    $(document).ready(function () {
        $(document).on('click', '.add_student', function (e) {
            e.preventDefault();
            alert('yes');
        });
    });
</script>
@endsection

