<template>
    <app-layout title="Dashboard" :role="role_id">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Todo List
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4">
                    <div class="main">
                        <table class="data-table" v-show="checkTodos">
                            <tr>
                                <th width="5%"></th>
                                <th width="30%">Title</th>
                                <!-- <th width="30%">Description</th> -->
                                <th width="30%">Date</th>
                                <th></th>
                            </tr>
                            <tr
                            v-for="todo in todos"
                            :key="'k0'+todo.id"
                            @click.prevent="toggleTodo(todo)"
                            class="table-row"
                            >
                                <td><input type="checkbox" :checked="todo.isFinished"></td>
                                <td> {{ todo.title }} </td>
                                <!-- <td> {{ role.description }} </td> -->
                                <td> {{ todo.date }} </td>
                                <td>
                                    <jet-button @click.stop="EditModal(todo)" class="md-12 px-3 py-2 mx-2"><i class="fas fa-edit" style="font-size:12px"></i></jet-button>
                                    <jet-button @click.stop="DeleteTodo(todo.id)" class="md-12 px-3 py-2"><i class="fas fa-trash-alt" style="font-size:12px"></i></jet-button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="main">
                        <jet-button @click.stop="showDeleteAllModal" class="md-12 mx-2 px-4 py-2">Delete All</jet-button>
                        <jet-button @click.stop="StoreModal" class="md-12 px-4 py-2">Add To do</jet-button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal update ##### -->
        <form-dialog :show="show_modal" :form="form" @close="closeModal()" @submit="SubmitForm()" >
            <template #title>
                <div>
                    {{ form.id ? "Update To do" : " Add To do " }}
                </div>
            </template>
            <form @submit.prevent="EditSubmit">
                <div>
                    <jet-label for="todo_title" value="Title" />
                    <jet-input id="todo_title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />
                </div>
                <div>
                    <jet-label for="date" value="Date" />
                    <jet-input id="date" type="date" class="mt-1 block w-full" v-model="form.date" required  />
                </div>
            </form>
        </form-dialog>
        <!-- modal delete all ##### -->
        <form-dialog :show="show_delete_modal" :form="form" @close="closeDeleteModal()" @submit="DeleteAll()" >
            <template #title>
                <div>
                    Delete Todo
                </div>
            </template>
            <form @submit.prevent="DeleteAll">
                <span>Are you sure you want to delete all Todo data?</span>
            </form>
        </form-dialog>

    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import ModalView from '@/Jetstream/DialogModal.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import FormDialog from '@/Jetstream/FormDialog.vue'

export default defineComponent({
    props: ['todos', 'role_id'],
    components: {
        AppLayout,
        ModalView,
        JetInput,
        JetButton,
        JetLabel,
        FormDialog
    },
    data(){
        return{
            show_modal: false,
            show_delete_modal: false,
            form: {
                name: '',
                description:'',
            }
        }
    },
    computed:{
        checkTodos(){
            if(this.todos.length >= 1 ) return true
            else return false
        }
    },
    methods: {
        EditModal(data){
            this.form = data;
            this.show_modal = !this.show_modal;
        },
        SubmitForm(){
            if(this.form.id){
                this.$inertia.put('/todo/' + this.form.id, this.form);
            }else{
                this.$inertia.post('/todo/store', this.form);
            }
            this.form = {};
            this.show_modal = false;
        },
        toggleTodo(data){
            this.form = data;
            this.form.isFinished = !data.isFinished;
            this.$inertia.put('/todo/toggle/' + this.form.id, this.form);
        },
        DeleteTodo(id){
            this.$inertia.delete('/todo/' + id);
            this.show_modal = false;
        },
        closeModal(){
            // console.log('modal close');
            this.show_modal = !this.show_modal;
        },
        closeDeleteModal(){
            this.show_delete_modal = !this.show_delete_modal;
        },
        StoreModal(){
            this.form = {};
            this.show_modal = !this.show_modal;
        },
        showDeleteAllModal(){
            this.show_delete_modal = !this.show_delete_modal;
        },
        DeleteAll(){
            this.$inertia.delete('/todo/deleteAll');
        }
    },
    mounted(){
        console.log(this.role_id);
    }
})
</script>

<style scope>
.footer-content{
    display: block;
    width: 100%;
}
.table-row{
    margin: 15px;
    cursor: pointer;
}
.main{
    display: flex;
    justify-content: center;
    align-items: center;
}
.data-table{
    width: 70%;
    padding: 15px;
    margin: 15px;
}
.data-table th{
    color: #6875f5;
    /* text-align: center; */
}
.data-table tr{
    padding: 8px;
    text-align: center;
}
</style>
