<template>
    <div>
        
    </div>
</template>
<script>
export default {
    props:['answer'],
    data(){
        return{
            editing : false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            question_id : this.answer.question_id,
            beforeEditCache: null
        }
    },
    methods:{
        edit(){
            this.beforeEditCache = this.body;
            this.editing = true;
        },
        cancel(){
            this.body=this.beforeEditCache ;
            this.editing = false;
        },
        update(){
            axios.patch(this.endpoint,{
                body:this.body,
            })
                 .then(res=>{
                     console.log(res);
                     this.editing = false;
                     this.bodyHtml= res.data.body_html;
                     this.$toast.success(res.data.message,'success',{timeout:3000});

                 })
                 .catch(err =>{
                     this.$toast.error(err.response.data.message,'success',{timeout:300});
                     
                 });
        },
        destroy(){
            if(confirm('are you suer ?')){
                axios.delete(this.endpoint)
                     .then(res=>{
                         $(this.$el).fadeOut(500,()=>{
                             this.$toast.success(res.data.message,'success',{timeout:3000});
                         })
                     })
                     .catch();
            }
        }

    },
    computed:{
        isInvalid(){
            return this.body.length<10;
        },
        endpoint(){
            return `/question/${this.question_id}/answer/${this.id}`;
        }

    }
}
</script>