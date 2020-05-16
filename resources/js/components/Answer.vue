<template>
 <div class="card mt-3" v-cloak v-if="count">
    <div class="card-body">
        <h3>
            {{title}}
            <!-- {{$answerCount ." ".str_plural('Answer',$answerCount)}} -->
        </h3>
        <hr>
        <answer @deleted="remove(index)" v-for="(answer,index) in answers" :answer='answer' :key="answer.id"></answer>   
    </div>
    <div class="text-center py-5" v-if="nextUrl">
        <button @click.prevent="fetch(nextUrl)" class="btn btn-outline-secondary">Load More</button>
    </div>
  </div>
</template>
<script>
import Answers from './Answers';
export default {
    props:['question'],
    data(){
        return{
            questionId : this.question.id,
            count: this.question.answers,
            answers:[],
            nextUrl : null,
        }
    },
    computed:{
        title(){
            return this.count +" "+ (this.count> 1? 'Answers':'Answer');
        },

    },
    created(){
        this.fetch(`/question/${this.questionId}/answer`);
    },
    methods:{
        remove(index){
            this.count --;
            this.answers.splice(index,1);
            
        },
        fetch(url){
            axios.get(url)
                 .then(({data}) =>{
                     this.answers.push(...data.data);
                     this.nextUrl = data.next_page_url
                     console.log(this.answers);
                 })

        }
    },
    components:{Answers}
}
</script>