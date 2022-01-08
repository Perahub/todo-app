<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row mt-5">
                    <div class="col-sm-12 mb-2">
                        <h5 class="card-title">Edit todo</h5>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" class="form-control" v-model="form.title" id="exampleFormControlInput1"
                                >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Date</label>
                            <input type="date" class="form-control" v-model="form.date_of_todo"
                                id="exampleFormControlInput1">
                        </div>
                        <button href="#" class="btn btn-primary btn-sm" @click.prevent="updateTodo()">Update</button>
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
                    title: '',
                    date_of_todo: ''
                },
                todos: {}
            }
        },

        methods: {
             updateTodo() {
                let id = this.$route.params.id
                axios.patch('/api/todo/' + id, this.form)
                    .then(() => {
                        alert('Todo successfully update');
                        this.$router.push({
                            name: 'todo'
                        })
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },
        },

        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }

            let id = this.$route.params.id

            axios.get('/api/todo/' + id)
                .then(({
                    data
                }) => (this.form = data.data))
                .catch(console.log('error'))
        }
    }

</script>
