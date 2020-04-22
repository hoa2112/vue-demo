<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Vuejs</title>
</head>
<body style="width: 50%;margin: auto;">
    <div id="login-form" style="margin-top: 5%">
        <h2 :style="style_title">{{ title }}</h2>

        <label for="">Email</label>
        <input type="text" id="email" v-model='email' class="form-control" autocomplete="off">

        <br>

        <label for="">Password</label>
        <input type="password" id="password" v-model='password' class="form-control" autocomplete="off">

        <br>

        <input type='button' value='Submit' @click='submitLogin()' class="btn btn-outline-info">
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

<script>
    var head = new Vue({
        el: '#login-form',
        data: {
            title : 'Login Blog Vuejs',
            email : '',
            password : '',

            style_title : {
                color         : '#1cd21c',
                textAlign     : 'center',
                textTransform : 'uppercase'
            }

        },
        methods : {
            submitLogin : function () {
                if (this.email != '' && this.password != '') {
                    axios.post('post_login.php', {
                        email      : this.email,
                        password   : this.password,
                    })
                    .then(function (response) {
                        if (response.data == 1) {
                            toastr.success('','Đăng nhập thành công');

                            var interval_obj = setInterval(function(){
                                window.location.href = './user/';
                            }, 2000);
                        } else {
                            toastr.error('','Email hoặc Password không đúng');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                } else {
                    toastr.error('','Email hoặc Password không đúng');
                }
            } ,
        }
    });
</script>
<?php