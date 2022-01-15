<template>
    <div v-if="data.is_shown" :class="classObject">
        <p class="mb-0">
            <span v-if="Array.isArray(data.message)">
                <span v-for="(message, i) in data.message" :key="i" class="d-block">
                    {{ message }}
                </span>
            </span>
            <span v-else>
                {{ data.message }}
            </span>
        </p>
    </div>
</template>

<script>
export default {
    props: ["data"],
    watch: {
        data: {
            handler(error){
                if(error.is_shown)
                {
                    setTimeout(() => {
                        error.is_shown = false
                    },3000) // hide the error after 3s
                }
            },
            deep: true
        }
    },
    computed: {
        classObject: function () {
            return {
                'alert alert-success': this.data.status,
                'alert alert-danger': !this.data.status
            }
        }
    }
}
</script>
