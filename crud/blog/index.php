<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Vuejs</title>
</head>
<body style="width: 80%;margin: auto;">
<!---->
<!--    <div id="home-component">-->
<!--        <home-component></home-component>-->
<!--    </div>-->
<!---->
<!--    <div id="components-demo">-->
<!--        <button-counter></button-counter>-->
<!--    </div>-->

    <div id="head">
<!--        <h1 :style="style_title">  {{ title }} </h1>-->

        <hr>
        <div style="text-align: right;">
            <a class="btn btn-outline-info" :style="btn_user" href="../user"><i class="fa fa-user"></i> {{ user_manager }}</a>

            <a class="btn btn-outline-info btn_post" :style="btn_post" href="../post"><i class="fa fa-book"></i>  {{ post_manager }}</a>

            <a class="btn btn-outline-secondary" href="../"><i class="fa fa-reply"></i>  {{ logout }}</a>
        </div>
    </div>

    <hr>

    <div id="content" style="width: 60%;margin: auto;">
<!--        <h1 :style="css_demo" style="text-align: center;"> {{ content }} </h1>-->

<!--        <hr>-->

        <div v-for='(post,index) in posts'>
            <h2 style="color: #222"> {{ post.title_post }}</h2>
            <h6><span style="color:#fb6c27;"> {{ post.author }} </span> - <span><i class="far fa-clock"></i> {{ post.date_added }} </span></h6>

            <img v-if="post.image" :src="post.image" style="max-width: 100%;">
            <h5> {{ post.description }}</h5>
            <br>
            <div> {{ post.content }}</div>
            <hr>

        </div>
    </div>

</body>
</html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Toastr -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!--<script src="./home.js"></script>-->
<script src="content.js"></script>

<!--<script>-->
<!--    new Vue({-->
<!--        el: '#components-demo'-->
<!--    });-->
<!---->
<!--    Vue.component('button-counter', {-->
<!--        data: function () {-->
<!--            return {-->
<!--                count: 0-->
<!--            }-->
<!--        },-->
<!--        template: '<button v-on:click="count++">You clicked me {{ count }} times.</button>'-->
<!--    });-->
<!---->
<!--</script>-->
<?php