<template>
  <div class="media post">
     <vote :model="answer" name="answer"></vote>
    <div class="media-body">
      <form v-if="editing" @submit.prevent="update">
        <div class="fomr-grup">
          <textarea class="form-control" name="body" v-model="body" id="answer" rows="7" required></textarea>
        </div>
        <button type="submit" :disabled="isInvalid" class="btn btn-outline-primary btn-sm mt-2">update</button>
        <button class="btn btn-outline-danger btn-sm mt-2" @click.prevent="cancel" type="button">cancel</button>
      </form>
      <div v-else>
        <div v-html="bodyHtml"></div>
        <div class="row mt-5">
            <div class="col-4">
                <div class="btn-group">
                    <a v-if="authorize('modify',answer)" @click.prevent="edit" class="btn btn-outline-success btn-sm mr-1">Edit</a>                    
                    <button v-if="authorize('modify',answer)" @click="destroy" class="btn btn-outline-danger btn-sm">Delete</button>
                </div>
            </div>
            <div class="col-4"></div>
             <div class="col-4 ">                                   
              <user-info :model="answer" label="Answered"></user-info>
            </div>
        </div>
      </div>
     
    </div>
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
                         this.$emit('deleted');
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