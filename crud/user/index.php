<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Manager</title>
</head>
<body style="width: 80%;margin: auto;">

<div id='user' style="margin-top: 30px">
    <div v-bind:style="styleObject"> {{ user_manager }} </div>
    <div style="text-align: right;">
        <a class="btn btn-outline-info" href="../blog"><i class="fa fa-home"></i> {{ home_manager }}</a>
        <a class="btn btn-outline-info" href="../post"><i class="fa fa-book"></i> {{ post_manager }}</a>
        <a class="btn btn-outline-secondary" href="../"><i class="fa fa-reply"></i>  {{ logout }}</a>
    </div>
    <hr>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>

        <!-- Update/Delete -->
        <tr v-for='(user,index) in users'>
            <td><input type='text' v-model='user.username' class="form-control" :class="'input'+index" readonly></td>
            <td><input type='text' v-model='user.name' class="form-control" :class="'input'+index" readonly></td>
            <td><input type='text' v-model='user.email' class="form-control" :class="'input'+index" readonly></td>
            <td><input type='password' v-model='user.password' class="form-control" :class="'input'+index" readonly></td>
            <td><input type='button' value='Edit' @click="showupdate(index);" class="btn btn-outline-warning" :id="'edit'+index" :style="button">
                <input type='button' value='Update' @click='updateRecord(index,user.id);' class="btn btn-outline-primary" :id="'update'+index" :style="[button, dis_none]">
                <input type='button' value='Delete' @click='deleteRecord(index,user.id)'  class="btn btn-outline-danger" :style="button"></td>
        </tr>

        <!-- Add -->
        <tr>
            <td><input type='text' v-model='username' class="form-control"></td>
            <td><input type='text' v-model='name' class="form-control"></td>
            <td><input type='text' v-model='email' class="form-control"></td>
            <td><input type='password' v-model='password' class="form-control"></td>
            <td><input type='button' value='Add' @click='addRecord();' class="btn btn-outline-info"></td>
        </tr>
    </table>

</div>
</body>
</html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Toastr -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="./index.js"></script>