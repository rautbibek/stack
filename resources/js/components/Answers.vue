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
            axios.patch(`/question/${this.question_id}/answer/${this.id}`,{
                body:this.body,
            })
                 .then(res=>{
                     console.log(res);
                     this.editing = false;
                     this.bodyHtml= res.data.body_html;

                 })
                 .catch(err =>{
                     console.log('something went wrong');
                 });
        }
    },
    computed:{
        isInvalid(){
            return this.body.length<10;
        }
    }
}
</script>