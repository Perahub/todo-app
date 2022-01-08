<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                   <div class="card px-5 py-5" >
                        <div class="form-data">
                            <div class="forms-inputs mb-4"> <span>Email or username</span> <input autocomplete="off" type="text" v-model="form.email" v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(form.email) && emailBlured}" v-on:blur="emailBlured = true">
                                <div class="invalid-feedback">A valid email is required!</div>
                            </div>
                            <div class="forms-inputs mb-4"> <span>Password</span> <input autocomplete="off" type="password" v-model="form.password" v-bind:class="{'form-control':true, 'is-invalid' : !validPassword(form.password) && passwordBlured}" v-on:blur="passwordBlured = true">
                                <div class="invalid-feedback">Password must be 8 character!</div>
                            </div>
                            <div class="mb-3"> 
                                <button v-on:click.stop.prevent="login()" class="btn btn-dark w-100">Login</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                form: {
                    email : "sample@sample.com",
                    password: "sample123",
                },
                emailBlured : false,
                valid : false,
                passwordBlured:false
            }
        },

        methods: {
            login(){
                this.validate();
                if(this.valid){
                    axios.post('/api/auth/login',this.form)
                    .then(res => {
                        User.responseAfterLogin(res)
                        this.$router.push({ name: 'todo'})
                    })
                    .catch(error =>this.errors = error.response.data.errors)
                }
            },
            validate(){
                this.emailBlured = true;
                this.passwordBlured = true;
                if( this.validEmail(this.form.email) && this.validPassword(this.form.password)){
                    this.valid = true;
                }
            },

            validEmail(email) {
                var re = /(.+)@(.+){2,}\.(.+){2,}/;
                if(re.test(email.toLowerCase())){
                    return true;
                }
            },

            validPassword(password) {
                if (password.length > 6) {
                    return true;
                }
            },
        },
        created() {
            if (User.loggedIn()) {
                this.$router.push({name: 'todo'})
            }
        }
    }
</script>
