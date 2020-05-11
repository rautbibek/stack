<template>
    <div class="mt-5">
        <a v-if="canAccept" @click.prevent="accept" title="Mark this as a best answer" :class="classes">
            <i class="fas fa-check fa-2x"></i><br>
        </a>
        <a v-if="isBest" title="question author Mark this answer as a best answer" :class="classes">
            <i class="fas fa-check fa-2x"></i><br>
                      
        </a>
    </div>
</template>
<script>
export default {
    props:['answer'],
    data(){
        return{
            is_best: this.answer.is_best,
            id: this.answer.id,
        }
    },
    computed:{
        canAccept(){
            return this.authorize('accept',this.answer);
        },

        isBest(){
            return !this.canAccept && this.is_best;
        },

        classes(){
            return [
                'mt-5',
                this.is_best ?'vote-accept':''
            ];
        },
        url(){
            return `/accept/${this.id}/answer`;
        }

    },

    methods:{
        accept(){
            
            axios.post(this.url)
                 .then(res => {
                        this.is_best = true;
                        this.$toast.success(res.data.message,'success',{
                        timeout:3000,
                        position: 'topRight',
                    });
                 })
        }
    },

}
</script>