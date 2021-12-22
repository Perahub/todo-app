<template>
    <app-layout title="Roles" :role="role_id">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles Management
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4">
                    <div class="main">
                        <table class="data-table" v-show="checkRoles">
                            <tr>
                                <th width="25%">Display Name</th>
                                <th width="30%">Description</th>
                                <th width="20%">Created At</th>
                                <th></th>
                            </tr>
                            <tr
                            v-for="role in roles"
                            :key="'k0'+role.id"
                            @click.prevent="EditModal(role)"
                            class="table-row"
                            >
                                <td> {{ role.name }} </td>
                                <td> {{ role.description }} </td>
                                <td> {{ role.created_at }} </td>
                                <td>
                                    <jet-button @click.stop="EditModal(role)" class="md-12 px-3 py-2 mx-2"><i class="fas fa-edit" style="font-size:12px"></i></jet-button>
                                    <jet-button @click.stop="DeleteRole(role.id)" class="md-12 px-3 py-2"><i class="fas fa-trash-alt" style="font-size:12px"></i></jet-button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="main">
                        <jet-button @click.stop="StoreModal" class="md-12 px-4 py-2">Add Role</jet-button>
                    </div>
                </div>
            </div>
        </div>


        <!-- modal update ##### -->
        <form-dialog :show="show_modal" :form="form" @close="closeModal()" @submit="SubmitForm()" >
            <template #title>
                <div>
                    {{ form.id ? "Update Role" : " Add Role " }}
                </div>
            </template>
            <form @submit.prevent="EditSubmit">
                <div>
                    <jet-label for="role_name" value="Role Name" />
                    <jet-input id="role_name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
                </div>
                <div>
                    <jet-label for="description" value="Description" />
                    <jet-input id="description" type="text" class="mt-1 block w-full" v-model="form.description" required  />
                </div>
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
    props: ['roles', 'role_id'],
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
            form: {
                name: '',
                description:'',
            }
        }
    },
    computed:{
        checkRoles(){
            if(this.roles.length >= 1 ) return true
            else return false
        }
    },
    methods: {
        EditModal(role){
            this.form = role;
            this.show_modal = !this.show_modal;
        },
        SubmitForm(){
            if(this.form.id){
                this.$inertia.put('/role/' + this.form.id, this.form);
            }else{
                this.$inertia.post('/role/store', this.form);
            }
            this.form = {};
            this.show_modal = false;
        },
        DeleteRole(id){
            this.$inertia.delete('/role/' + id);
            this.show_modal = false;
        },
        closeModal(){
            // console.log('modal close');
            this.show_modal = !this.show_modal;
        },
        StoreModal(){
            this.form = {};
            this.show_modal = !this.show_modal;
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
