

var app = new Vue({
    el: '#user',
    data: {
        users: "",
        username: "",
        name: "",
        email: "",
        password: "",
        user_manager: 'Quản Lý Người Dùng',
        post_manager: 'Quản Lý Bài Viết',
        logout: 'Đăng Xuất',
        home_manager  : 'Blog Home',
        styleObject: {
            color: '#6ac765',
            fontSize: '30px',
            textAlign: 'center'
        },
        button: {
            width: '75px',
        },
        dis_none: {
            display: 'none',
        }
    },
    methods: {
        allRecords: function(){
            axios.post('request.php', {
                request: 1
            })
                .then(function (response) {
                    app.users = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        addRecord: function(){

            if(this.username != '' && this.name != '' && this.email != ''){
                axios.post('request.php', {
                    request: 2,
                    username: this.username,
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                    .then(function (response) {

                        // Fetch records
                        app.allRecords();

                        // Empty values
                        app.username = '';
                        app.name = '';
                        app.email = '';
                        app.password = '';

                        toastr.success('','Thêm mới thành công');
                    })
                    .catch(function (error) {
                        toastr.error('',error);
                    });
            }else{
                alert('Fill all fields.');
            }
        },
        updateRecord: function(index,id){
            // Read value from Textbox
            var name = this.users[index].name;
            var username = this.users[index].username;
            var email = this.users[index].email;
            var password = this.users[index].password;

            if(name !='' && email !=''){
                axios.post('request.php', {
                    request: 3,
                    id: id,
                    name: name,
                    username: username,
                    email: email,
                    password: password,
                })
                    .then(function (response) {
                        $('#update'+index).hide();
                        $('#edit'+index).show();
                        $('.input'+index).prop('readonly',true);

                        toastr.success('','Cập nhật thành công');
                    })
                    .catch(function (error) {
                        toastr.error('',error);
                    });
            }
        },
        deleteRecord: function(index,id){
            axios.post('request.php', {
                request: 4,
                id: id
            })
                .then(function (response) {

                    // Remove index from users
                    app.users.splice(index, 1);
                    toastr.success('','Đã xóa thành công');
                })
                .catch(function (error) {
                    toastr.error('',error);
                });

        },

        showupdate: function (index) {
            $('#edit'+index).hide();
            $('.input'+index).prop('readonly', false);
            $('#update'+index).show();
        },

        backHome() {
            this.$router.push('../blog');
        }
    },
    created: function(){
        this.allRecords();
    }
});
