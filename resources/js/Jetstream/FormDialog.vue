<template>
    <div>
        <modal-view :show="show" :closeable="true" @close="closeModal()">
            <template #title>
                <div><span><slot name="title" ></slot></span></div>
            </template>
            <template #content>
                <div>
                    <slot></slot>
                </div>
            </template>
            <template #footer>
                <div>
                    <jet-button
                      @click="SubmitModal"
                      class="ml-4"
                    > Submit </jet-button>
                    <jet-button
                      @click="closeModal"
                      class="ml-4"
                    > Cancel </jet-button>
                </div>
            </template>
        </modal-view>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import ModalView from '@/Jetstream/DialogModal.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
export default defineComponent({
    props:['show', 'form'],
    emits: ['close', 'submit'],
    components: {
        ModalView,
        JetInput,
        JetButton,
        JetLabel
    },
    data(){
        return{
            show_modal: false,
            // form: {
            //     name: '',
            //     description:'',
            // },
        }
    },
    methods: {
        SubmitModal(){
            // this.$inertia.put('/role/' + this.form.id, this.form);
            this.$emit('submit');
        },
        closeModal(){
            // console.log('modal close');
            this.$emit('close');
        }
    }
})
</script>

<style>

</style>
