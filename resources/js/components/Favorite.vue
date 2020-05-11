<template>
    <div class="mt-5">
        <a title="click again to make it favouit" @click.prevent="toggle" :class="classes">
            <i class="fas fa-star fa-2x"></i><br>
        <span class="favorites-count" >{{count}}</span>
        </a> 
    </div>
</template>
<script>
export default {
    props:['question'],
    data(){
        return{
            is_favorite:this.question.is_favorite,
            count: this.question.favorite_count,
            id: this.question.id,
        }
    },
    computed:{
        classes(){
            return[
                'mt-5',
                !this.loggedIn ? 'off': (this.is_favorite?'fav-ans':'')
            ]
        },
        url(){
            return `/question/${this.id}/favorites`;
        },
        loggedIn(){
            return window.Auth.loggedIn;
        }
    },
    methods:{
        toggle(){
            if(!this.loggedIn){
                this.$toast.warning('Please login to favorite this question','warning',{
                    timeout:3000,
                    position: 'topRight',
                });
                return;
            }
            this.is_favorite? this.destroy() : this.create();
        },

        destroy(){

            axios.delete(this.url)
                 .then(res=>{
                     this.count--;
                     this.is_favorite = false;
                     this.$toast.success(res.data.message,'success',{
                         timeout:3000,
                         position: 'topRight',
                         });
                 })
                 .catch();
        },

        create(){
            axios.post(this.url)
                 .then(res=>{
                     this.count++;
                     this.is_favorite= true;
                     this.$toast.success(res.data.message,'success',{
                         timeout:3000,
                         position: 'topRight',
                    });
                 })
            .catch();
        }
    }
}
</script>