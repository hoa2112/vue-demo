var app_post = new Vue({
    el: '#post',
    data: {
        posts         : "",
        showupdate    : null,
        id            : "",
        showimage     : "",
        title_post    : "",
        description   : "",
        content       : "",
        author        : "",
        date_added    : "",
        image         : '',
        image_change  : '',
        image_index   : '',
        image_add     : '',
        file          : '',
        user_manager  : 'Quản Lý Người Dùng',
        post_manager  : 'Quản Lý Bài Viết',
        home_manager  : 'Blog Home',
        logout: 'Đăng Xuất',
        styleObject: {
            color     : '#6ac765',
            fontSize  : '30px',
            textAlign : 'center'
        },
        button: {
            width: '75px'
        },
        dis_none: {
            display: 'none'
        },
        middle: {
            verticalAlign: 'middle'
        }
    },
    methods: {
        listPost: function(){
            axios.post('request.php', {
                request: 1
            })
                .then(function (response) {
                    app_post.posts = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        addPost:  function () {
            if(this.title_post != '' && this.description != '' && this.content != '') {
                this.file = this.$refs.fileAdd.files[0];

                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('request', 2);
                formData.append('title_post', this.title_post);
                formData.append('description', this.description);
                formData.append('content', this.content);
                formData.append('author', this.author);
                formData.append('image', this.image);

                axios.post('request.php', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(function (response) {
                        app_post.listPost();

                        app_post.title_post  = '';
                        app_post.description = '';
                        app_post.content     = '';
                        app_post.image       = '';
                        app_post.author      = '';
                        app_post.date_added  = '';

                        app_post.listPost();
                        toastr.success('','Thêm mới thành công');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                alert('Fill all fields.');
            }
        },

        updatePost:  function (index,id) {
            this.showupdate = null;
            this.showimage  = "";

            // Read value from Textbox
            var title_post   = this.posts[index].title_post;
            var description  = this.posts[index].description;
            var content      = this.posts[index].content;
            var image        = this.posts[index].image;
            var author       = this.posts[index].author;

            if(title_post !='' && description !='' && content !=''){
                if (this.$refs.file[0]) {
                    this.file = this.$refs.file[0].files[0];
                } else {
                    this.file = this.posts[index].image;
                }

                let formData = new FormData();
                    formData.append('file', this.file);
                    formData.append('post_id', id);
                    formData.append('request', 3);
                    formData.append('title_post', title_post);
                    formData.append('description', description);
                    formData.append('content', content);
                    formData.append('author', author);
                    formData.append('image', image);

                // upload images
                axios.post('request.php', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function (response) {
                    if(!response.data){
                        toastr.success('','Cập nhật thành công');
                        app_post.listPost();
                    }else{
                        toastr.error('',error);
                    }
                })

                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        deletePost : function (index, id) {
            axios.post('request.php', {
                request : 4,
                post_id : id
            })
                .then(function (response) {
                    app_post.posts.splice(index, 1);
                    toastr.success('','Xoa thanh cong');
                })
                .catch(function (error) {
                    toastr.error('',error);
                });
        },
        showFile(index) {
          $('#file-update'+index).click();
        },

        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) {
                return;
            }

            var reader = new FileReader();

            reader.onload = (e) => {
                this.image_change = e.target.result;
            };

            reader.readAsDataURL(files[0]);
        },

        showFileAdd() {
            $('#file-add').click();
        },
        onEditShow(id){
            this.showupdate = id;
            this.showimage = id;
            this.image_change = '';
        },

        onFileAddChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) {
                return;
            }

            // var image_add = new Image();
            var reader = new FileReader();

            reader.onload = (e) => {
                this.image_add = e.target.result;
            };
            reader.readAsDataURL(files[0]);
        },

        backHome() {
            this.$router.push('../blog');
        }

    },

    created: function(){
        this.listPost();
    }
});
