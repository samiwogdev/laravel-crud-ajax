@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <div id="success_message"></div>
                <div class="card shadow">
                    <div class="card-header bg-info d-flex justify-content-between align-items-center">
                        <h3 class="text-light">Manage Students</h3>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#add_student_Modal"><i
                                class="bi-plus-circle me-2"></i>Add New Student</button>
                    </div>
                    <div class="card-body" id="show_all_students">
                        <table class="table table-striped text-center" id="stud_table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h1 class="text-center text-secondary my-5" id="loading">Loading...</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add new student modal start --}}

    <div class="modal fade" id="add_student_Modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data">
                    <div class="modal-body p-4 bg-light">

                        <div id="saveform_err_div">
                            <ul id="saveform_errorlist"> </ul>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <label for="fname">Name</label>
                                <input type="text" name="fname" class="form-control name" required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control email" required>
                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" class="form-control phone" required>
                        </div>
                        <div class="my-2">
                            <label for="post">Course</label>
                            <input type="text" name="course" class="form-control course" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <but ton type="submit" class="btn btn-primary add_student">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit new student modal start --}}

    <div class="modal fade" id="edit_student_Modal" tabindex="-1" aria-labelledby="editModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        <input type="hidden" id="student_id" class="form-control name">

                        <div id="update_err_div">
                            <ul id="update_errorlist"> </ul>
                        </div>

                        <div class="my-2">
                            <label for="fname">Name</label>
                            <input type="text" id="edit_name" name="fname" class="form-control name" required>
                        </div>
                        <div class="my-2">
                            <label for="email">Email</label>
                            <input type="email" id="edit_email" name="email" class="form-control email" required>
                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" id="edit_phone" name="phone" class="form-control phone" required>
                        </div>
                        <div class="my-2">
                            <label for="post">Course</label>
                            <input type="text" id="edit_course" name="course" class="form-control course" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <but ton type="submit" class="btn btn-primary update_student">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


     {{-- delete student modal start --}}
     <div class="modal fade" id="delete_student_Modal" tabindex="-1" aria-labelledby="deleteModalLabel"
     data-bs-backdrop="static" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="deleteModalLabel">Delete Student</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form enctype="multipart/form-data">
                 <div class="modal-body p-4 bg-light">
                     <input type="hidden" id="delete_stud_id" class="form-control name">

                    <h6>Are you sure ? want to delete this data</h6>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <but ton type="submit" class="btn btn-danger del_student_btn">Yes Delete</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
  {{-- delete student modal start --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            fetchStudents();

            //fetch all students data
            function fetchStudents() {
                var count = 1;
                $.ajax({
                    type: "GET",
                    url: "/fetch_students",
                    success: function(response) {
                        // console.log(response.students);
                        $('tbody').html('');
                        $.each(response.students, function(student_key, student_list) {
                           $('tbody').append('<tr>\
                           <td>' + count + '</td>\
                           <td>' + student_list.name + '</td>\
                           <td>' + student_list.email + '</td>\
                           <td>' + student_list.phone + '</td>\
                           <td>' + student_list.course + '</td>\
                           <td>\
                           <button type="button" value=' + student_list.id + ' class="btn btn-primary btn-sm edit_student_btn" ></i>Edit</button>\
                           <button type="button" value=' + student_list.id + ' class="btn btn-danger btn-sm delete_student_btn" ></i>Delete</button>\
                           </td>\
                           </tr>\
                           ');
                            count++;
                        });
                        $('#loading').html('');

                    }
                });
            }

            //display delete confirmation
            $(document).on('click', '.delete_student_btn', function (e) {
                e.preventDefault(e);
                var stud_id = $(this).val();
                $('#delete_stud_id').val(stud_id);
                $('#delete_student_Modal').modal('show');
                $('#success_message').hide();
            });

            //delete student data
             $(document).on('click', '.del_student_btn', function (e) {
                student_id = $('#delete_stud_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: "/delete_stud/"+student_id,
                    success: function (response) {
                        if(response.status == 404){
                            $('#success_message').show();
                            $('#success_message').addClass('alert alert-danger p-2');
                            $('#success_message').text(response.error);
                            $('#delete_student_Modal').modal('hide');
                            fetchStudents();
                        }else{
                            $('#success_message').show();
                            $('#success_message').addClass('alert alert-success p-2');
                            $('#success_message').text(response.message);
                            $('#delete_student_Modal').modal('hide');
                            fetchStudents();
                        }

                    }
                });
             });


            //edit student data
            $(document).on('click', '.edit_student_btn', function(e) {
                e.preventDefault();
                var stud_id = $(this).val();
                $('#success_message').hide();
                $('#update_errorlist').hide();
                $('#update_err_div').hide();
                // console.log(stud_id);
                $.ajax({
                    type: "GET",
                    url: "/edit_student/" + stud_id,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 404) {
                            $('#success_message').show();
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.error);
                        } else {
                            $('#edit_student_Modal').modal('show');
                            $('#edit_name').val(response.student.name);
                            $('#edit_email').val(response.student.email);
                            $('#edit_phone').val(response.student.phone);
                            $('#edit_course').val(response.student.course);
                            $('#student_id').val(stud_id);
                        }
                    }
                });
            });


            //update student data
            $(document).on('click', '.update_student', function(e) {
                e.preventDefault();
                $('.update_student').text('Updating..');
                var student_id = $('#student_id').val();
                var data = {
                    'name': $('#edit_name').val(),
                    'email': $('#edit_email').val(),
                    'phone': $('#edit_phone').val(),
                    'course': $('#edit_course').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: "/update_student/" + student_id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $('#update_err_div').show();
                            $('#update_errorlist').show();
                            $('#update_err_div').addClass('alert alert-danger p-2');
                            $.each(response.errors, function(key,
                                error_value) { //loop through errors
                                $('#update_errorlist').append('<li>' + error_value +
                                    '</li>');
                            });
                             $('.update_student').text('Update');

                        } else if (response.status == 404) {
                            // $('#update_err_div').html('');
                            // $('#update_errorlist').html('');
                            $('#success_message').show();
                            $('#success_message').addClass('alert alert-danger p-2');
                            $('#success_message').text(response.error);
                             $('.update_student').text('Update');
                        } else {
                            // $('#update_err_div').html('');
                            $('#success_message').show();
                            $('#success_message').addClass('alert alert-success p-2');
                            $('#success_message').text(response.message);
                            $('.update_student').text('Update');
                            $('#edit_student_Modal').modal('hide');
                            fetchStudents();
                        }
                    }
                });

            });


            //save student data
            $(document).on('click', '.add_student', function(e) {
                e.preventDefault();
                // alert('yes');
                var data = {
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'phone': $('.phone').val(),
                    'course': $('.course').val(),
                }
                // console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "students",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            // $('#saveform_err_div').html('');
                            // $('#saveform_errorlist').html('');
                            $('#saveform_err_div').show();
                            $('#saveform_err_div').addClass('alert alert-danger p-2');
                            $.each(response.errors, function(key,
                                err_values) { //loop through errorsx
                                $('#saveform_errorlist').append('<li>' + err_values +
                                    '</li>');
                            });
                        } else {
                            $('#saveform_err_div').hide();
                            $('#success_message').addClass('alert alert-success p-2');
                            $('#success_message').text(response.message);
                            $('#add_student_Modal').modal('hide'); //hide modal
                            $('#add_student_Modal').find('input').val(
                                ''); //clear modal input form
                            fetchStudents();
                        }
                    }
                });
            });
        });
    </script>
@endsection
