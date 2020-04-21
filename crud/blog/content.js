var head = new Vue({
    el: '#head',
    data: {
        user_manager: 'Quản Lý Người Dùng',
        post_manager: 'Quản Lý Bài Viết',
        title: 'WELCOME TO DEMO Vuejs',
        logout: 'Đăng Xuất',

        style_title: {
            color: '#6bdc5d',
            textAlign: 'center'
        },

        btn_user: {
            background: '#fffff3'
        },

        btn_post: {
            background: '#fff3fe'
        },

        btn_logout: {
        },
    },
});

var content = new Vue({
    el: '#content',
    data: {
        posts         : "",
        id            : "",
        title_post    : "",
        description   : "",
        author        : "",
        date_added    : "",
        showupdate    : false,
        showedit      : true,
        content : 'Đây Là Nội Dung Trang BLog',

        css_demo: {
            color: 'pink'
        },

        styleObject: {
            color     : '#6ac765',
            fontSize  : '30px',
            textAlign : 'center'
        },
    },
    methods: {
        listPost: function(){
            axios.post('request.php', {
                request: 5
            })
                .then(function (response) {
                    console.log(response.data);
                    content.posts = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
    created: function(){
        this.listPost();
    }
});
