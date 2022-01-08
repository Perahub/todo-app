<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row mt-5">
                    <div class="col-sm-12 mb-2">
                        <button href="#" class="btn btn-secondary btn-sm btn-right" @click.prevent="logout()">Logout</button>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <h5 class="card-title">Add todo</h5>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" class="form-control" v-model="form.title" id="exampleFormControlInput1"
                                placeholder="Sample Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Date</label>
                            <input type="date" class="form-control" v-model="form.date_of_todo"
                                id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <button href="#" class="btn btn-primary btn-sm" @click.prevent="saveTodo()">Save</button>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(todo, index) in todos.data" :key="todo.id"> 
                                    <th scope="row">{{++index}}</th>
                                    <td>{{todo.title}}</td>
                                    <td>{{format_date(todo.date_of_todo)}}</td>
                                    <td v-if="todo.is_finished == 0">Not finish</td>
                                    <td v-else>Finished</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" v-if="todo.is_finished == 0" @click="finishedTodo(todo.id)" type="button" title="">Finished</a>
                                        <router-link :to="{name: 'edit-todo', params: {id: todo.id}}" class="btn btn-primary btn-sm" type="button">Edit</router-link>
                                        <a class="btn btn-danger btn-sm" @click="deleteTodo(todo.id)" type="button" title="">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        data: function () {
            return {
                form: {
                    title: null,
                    date_of_todo: null
                },
                todos: {}
            }
        },

        methods: {
            format_date(value){
                if (value) {
                    return moment(String(value)).format('MMMM/DD/YYYY')
                }
            },
            getTodos() {
                axios.get('/api/todo')
                    .then(({
                        data
                    }) => (this.todos = data))
                    .catch()
            },

            saveTodo() {
                axios.post('/api/todo', this.form)
                    .then(res => {
                        Reload.$emit('AfterAdd');
                        alert('Todo successfully saved')
                    })
                    .catch(error)
            },

            deleteTodo(id) {
                Swal.fire({
                    title: 'Are you sure',
                    text: "You wont be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/todo/' + id)
                            .then(() => {
                                this.todos = this.todos.filter(todo => {
                                    return todo.id != id
                                })
                            })
                            .catch(() => {
                                Reload.$emit('AfterAdd');
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted',
                            'success'
                        )
                    }
                })
            },

            finishedTodo(id) {
                axios.post('/api/finishedTodo/' + id)
                .then(res => {
                        Reload.$emit('AfterAdd');
                        alert('Todo finished');
                    })
                    .catch(error)
            },

            logout() {
                localStorage.removeItem('token');
                window.location.href = "/";
            },
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }

            this.getTodos();

            Reload.$on('AfterAdd', () => {
                this.getTodos();
            })
        }
    }

</script>

<style scoped>
    .btn-right {float: right}
</style>
