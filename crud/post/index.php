<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Manager</title>
</head>
<body style="width: 80%;margin: auto;">

<div id='post' style="margin-top: 30px">
    <div :style="styleObject"> {{ post_manager }}</div>
    <div style="text-align: right;">
        <a class="btn btn-outline-info" href="../blog"><i class="fa fa-home"></i> {{ home_manager }}</a>
        <a class="btn btn-outline-info" href="../user"><i class="fa fa-user"></i> {{ user_manager }}</a>
        <a class="btn btn-outline-secondary" href="../"><i class="fa fa-reply"></i>  {{ logout }}</a>
    </div>
    <hr>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Content</th>
            <th>Image</th>
            <th>Author</th>
            <th>Date_added</th>
            <th>Action</th>
        </tr>

        <!-- Update/Delete -->
        <tr v-for='(post,index) in posts'>
            <td :style="middle" >
                <input v-if="showupdate != post.id" type='text' v-model='post.title_post' class="form-control" :class="'input'+index" readonly>
                <input v-else type='text' v-model='post.title_post' class="form-control" :class="'input'+index">
            </td>
            <td :style="middle">
                <textarea v-if="showupdate != post.id" v-model='post.description' class="form-control" :class="'input'+index" rows="6" readonly></textarea>
                <textarea v-else v-model='post.description' class="form-control" :class="'input'+index" rows="6"></textarea>
            </td>
            <td :style="middle">
                <textarea v-if="showupdate != post.id" v-model='post.content' class="form-control" :class="'input'+index" rows="6" readonly></textarea>
                <textarea v-else  v-model='post.content' class="form-control" :class="'input'+index" rows="6"></textarea>
            </td>

            <td :style="middle">
                <div>
                    <img v-if="image_change && showimage == post.id" :src="image_change" class="img-responsive" height="70" width="90" @click="showFile(index)" />
                    <img v-else-if="post.image" :src="post.image" class="img-responsive" height="70" width="90" @click="showFile(index)" />
                    <img v-else class="img-responsive" :src="img-update" height="70" width="90" @click="showFile(index)" />
                </div>

                <input v-if="image_change" v-model="post.image" type="hidden" />
                <input v-else="post.image" v-model="post.image" type="hidden" />


                <input v-if="showimage == post.id" type="file" :id="'file-update'+index" ref="file" @change="onFileChange" :style="dis_none" />
            </td>

            <td :style="middle">
                <input v-if="showupdate != post.id" type='text' v-model='post.author' class="form-control" :class="'input'+index" readonly>
                <input v-else type='text' v-model='post.author' class="form-control" :class="'input'+index">
            </td>
            <td :style="middle">
                <input v-if="showupdate != post.id" type='text' v-model='post.date_added' class="form-control" readonly>
                <input v-else type='text' v-model='post.date_added' class="form-control">
            </td>

            <td :style="middle">
                <input v-if="showupdate != post.id" type='button' value='Edit'  @click="onEditShow(post.id)" class="btn btn-outline-warning" :style="button" :id="'edit'+index">
                <input v-show="showupdate == post.id" type='button' value='Update' @click='updatePost(index,post.id);' class="btn btn-outline-primary updatePost" :style="[button , dis_none ]" :id="'update'+index">
                <input type='button' value='Delete' @click='deletePost(index,post.id)' class="btn btn-outline-danger" :style="button">
            </td>
        </tr>

        <!-- Add -->
        <tr>
            <td :style="middle"><input type='text' v-model='title_post' class="form-control"></td>
            <td :style="middle"><textarea type='text' v-model='description' class="form-control"></textarea></td>
            <td :style="middle"><textarea type='text' v-model='content' class="form-control"></textarea></td>
            <td :style="middle">
                <div id="preview">
                    <img v-if="image_add" :src="image_add" class="img-responsive" height="70" width="90" @click="showFileAdd"  />
                    <img v-else class="img-responsive" height="70" width="90" @click="showFileAdd" />
                </div>

                <input type="file" id="file-add" ref="fileAdd" @change="onFileAddChange" :style="dis_none" multiple="multiple" />
            </td>
            <td :style="middle"><input type='text' v-model='author' class="form-control"></td>
            <td :style="middle"><input type='text' v-model='date_added' class="form-control" readonly></td>
            <td :style="middle"><input type='button' value='Add' @click='addPost();' class="btn btn-outline-info"></td>
        </tr>
    </table>

</div>
</body>
</html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script src="https://unpkg.com/vue@2.6.11/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Toastr -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="./index.js"></script>