<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="todo-container">
                    <div class="card-header"><h5 class="mb-0"><strong>Todo App</strong></h5></div>

                    <div class="card-body">
                        <alert-message :data="errors"></alert-message>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control"
                                        placeholder="Title"
                                        v-model="form.title"
                                    />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="date"
                                        class="form-control"
                                        v-model="form.date"
                                    />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button @click="storeTodo" type="button" class="btn btn-primary w-100">Add</button>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Action</strong>
                                        <button class="btn btn-sm btn-info d-inline-block"
                                            :disabled="multipleSelectionOnly == 0"
                                            @click="actionAllSelectedItems('/home/ajax/mark-as-complete')">
                                            Mark as complete
                                        </button>
                                        <button class="btn btn-sm btn-info d-inline-block"
                                            :disabled="oneSelectionOnly == 0"
                                            @click="onEdit">
                                            Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger d-inline-block"
                                            :disabled="multipleSelectionOnly == 0"
                                            @click="actionAllSelectedItems('/home/ajax/delete')">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                                <table class="table w-100 table-sm table-hover table-borderless table-stripped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;"></th>
                                            <th>Title</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(item, i) in list">
                                            <tr :key="i"
                                                :class="((item.is_finished == 1) ? 'completed table-light' : '')">
                                                <td>
                                                    <div class="form-check">
                                                        <input v-model="selectedItems"
                                                            class="form-check-input"
                                                            :disabled="item.is_finished == 1"
                                                            type="checkbox"
                                                            :value="i"
                                                            :id="`inlineFormCheck-${i}`">
                                                        <label class="form-check-label" :for="`inlineFormCheck-${i}`"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ item.title }}
                                                </td>
                                                <td class="text-truncate">
                                                    {{ item.date }}
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div v-if="links != null" v-html="links"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AlertMessage from '../components/pages/Message.vue'
export default {
    components: {
        AlertMessage
    },
    data() {
        return {
            list: [],
            links: null,
            form: {
                id: null,
                title: null,
                date: null,
                is_finished: 0
            },
            selectedItems: [],
            errors: {
                is_shown: false,
                status: false,
                message: null
            },
            urls: {
                fetch: '/home/ajax/all'
            }
        }
    },
    mounted(){
        this.fetchAll(this.urls.fetch)
    },
    methods: {
        fetchAll(url){
            axios.get(url)
            .then(response => {
                let result = response.data;
                this.list = result.response.data
                this.links = result.links
                this.initPaginate();
            })
        },
        initPaginate(){
            var self = this
            $(function(){
                $("#todo-container .pagination .page-item a.page-link").on("click", function(e){
                    e.preventDefault()
                    self.fetchAll($(this).attr('href'))
                })
            })
        },
        storeTodo(e){
            axios.post('/home/ajax/store', this.form)
            .then(response => {
                this.fetchAll(this.urls.fetch)
                let data = response.data
                this.errors.is_shown = true
                this.errors.status = true
                this.errors.message = data.message
                this.clearForm();
            })
            .catch(errors => {
                e.target.disabled = false
                if(errors.response)
                {
                    this.errors.status = false
                    this.errors.is_shown = true
                    this.errors.message = errors.response.data.message
                    if(Object.keys(errors.response.data.errors) != undefined)
                    {
                        this.errors.message = []
                        Object.keys(errors.response.data.errors).forEach(err => {
                            this.errors.message.push(errors.response.data.errors[err][0]) // push the error message
                        })
                    }
                }
            })
        },
        onEdit(){
            this.form.id = this.list[this.selectedItems[0]].id
            this.form.title = this.list[this.selectedItems[0]].title
            this.form.date = this.list[this.selectedItems[0]].date
        },
        actionAllSelectedItems(url){
            let ids = [];

            // Get all ids
            this.selectedItems.forEach(item => {
                ids.push(
                    this.list[item].id
                );
            })

            let form = {
                ids: ids
            };

            axios.post(url, form)
            .then(response => {
                this.fetchAll(this.urls.fetch)
                let data = response.data
                this.errors.is_shown = true
                this.errors.status = true
                this.errors.message = data.message
                this.clearForm();
            })
            .catch(errors => {
                e.target.disabled = false
                if(errors.response)
                {
                    this.errors.status = false
                    this.errors.is_shown = true
                    this.errors.message = errors.response.data.message
                    if(Object.keys(errors.response.data.errors) != undefined)
                    {
                        this.errors.message = []
                        Object.keys(errors.response.data.errors).forEach(err => {
                            this.errors.message.push(errors.response.data.errors[err][0]) // push the error message
                        })
                    }
                }
            })

        },
        clearForm(){
            this.form.title = null
            this.form.date = null
            this.form.id = null
            this.selectedItems = []
        }
    },
    computed: {
        oneSelectionOnly(){
            return this.selectedItems.length == 1
        },
        multipleSelectionOnly(){
            return this.selectedItems.length >= 1
        }
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
}
</style>
