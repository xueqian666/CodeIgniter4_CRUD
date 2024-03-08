<!DOCTYPE html>
<html lang="en">

<head>
    <title>Users Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
</head>

<body>
    <div class="container"><br /><br />
        <div class="row">
            <div class="col-lg-10">
                <h2>Users Management</h2>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Add New user
                </button>
            </div>
        </div>

        <hr />
        <br />

        <table class="table table-bordered table-striped" id="userTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users_detail as $row) {
                ?>
                    <tr id="<?php echo $row['id']; ?>">
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td>
                            <a data-id="<?php echo $row['id']; ?>" class="btn btn-primary btnEdit">Edit</a>
                            <a data-id="<?php echo $row['id']; ?>" class="btn btn-danger btnDelete">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Add New user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="adduser" name="adduser" action="<?php echo site_url('user/store'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="txtName">Name:</label>
                                <input type="text" class="form-control" id="txtName" placeholder="Enter name" name="txtName">
                            </div>
                            <div class="form-group">
                                <label for="txtuserName">User Name:</label>
                                <input type="text" class="form-control" id="txtuserName" placeholder="Enter User Name" name="txtuserName">
                            </div>
                            <div class="form-group">
                                <label for="txtPassword">Password:</label>
                                <textarea class="form-control" id="txtPassword" name="txtPassword" rows="10" placeholder="Enter Password"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Update user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="updateuser" name="updateuser" action="<?php echo site_url('user/update'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="hdnuserId" id="hdnuserId" />
                            <div class="form-group">
                                <label for="txtName">Name:</label>
                                <input type="text" class="form-control" id="txtName" placeholder="Enter name" name="txtName">
                            </div>
                            <div class="form-group">
                                <label for="txtuserName">User Name:</label>
                                <input type="text" class="form-control" id="txtuserName" placeholder="Enter User Name" name="txtuserName">
                            </div>
                            <div class="form-group">
                                <label for="txtPassword">Password:</label>
                                <textarea class="form-control" id="txtPassword" name="txtPassword" rows="10" placeholder="Enter Password"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();

            $("#adduser").validate({
                rules: {
                    txtName: "required",
                    txtuserName: "required",
                    txtPassword: "required"
                },
                messages: {},

                submitHandler: function(form) {
                    var form_action = $("#adduser").attr("action");
                    $.ajax({
                        data: $('#adduser').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function(res) {
                            var user = '<tr id="' + res.data.id + '">';
                            user += '<td>' + res.data.id + '</td>';
                            user += '<td>' + res.data.name + '</td>';
                            user += '<td>' + res.data.username + '</td>';
                            user += '<td>' + res.data.password + '</td>';
                            user += '<td><a data-id="' + res.data.id +
                                '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' +
                                res.data.id +
                                '" class="btn btn-danger btnDelete">Delete</a></td>';
                            user += '</tr>';
                            $('#userTable tbody').prepend(user);
                            $('#adduser')[0].reset();
                            $('#addModal').modal('hide');
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnEdit', function() {
                var user_id = $(this).attr('data-id');
                $.ajax({
                    url: 'user/edit/' + user_id,
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {
                        $('#updateModal').modal('show');
                        $('#updateuser #hdnuserId').val(res.data.id);
                        $('#updateuser #txtName').val(res.data.name);
                        $('#updateuser #txtuserName').val(res.data.username);
                        $('#updateuser #txtPassword').val(res.data.password);
                    },
                    error: function(data) {}
                });
            });

            $("#updateuser").validate({
                rules: {
                    txtName: "required",
                    txtuserName: "required",
                    txtPassword: "required"
                },
                messages: {},
                submitHandler: function(form) {
                    var form_action = $("#updateuser").attr("action");
                    $.ajax({
                        data: $('#updateuser').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function(res) {
                            var user = '<td>' + res.data.id + '</td>';
                            user += '<td>' + res.data.name + '</td>';
                            user += '<td>' + res.data.username + '</td>';
                            user += '<td>' + res.data.password + '</td>';
                            user += '<td><a data-id="' + res.data.id +
                                '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' +
                                res.data.id +
                                '" class="btn btn-danger btnDelete">Delete</a></td>';
                            $('#userTable tbody #' + res.data.id).html(user);
                            $('#updateuser')[0].reset();
                            $('#updateModal').modal('hide');
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnDelete', function() {
                var user_id = $(this).attr('data-id');
                $.get('user/delete/' + user_id, function(data) {
                    $('#userTable tbody #' + user_id).remove();
                })
            });
        });
    </script>
</body>

</html>