<template>
    <div>
        <div class="d-flex flex-column vote-controls">
            <a :title="title('up')" @click="voteUp(name)" class="vote-up" :class="classes">
                <i class="fas fa-caret-up fa-3x"></i>
            </a>
            <span class="votes-count">
                {{count}}
            </span>
            <a :title="title('down')" @click="voteDown(name)" class="vote-down" :class="classes">
                <i class="fas fa-caret-down fa-3x"></i>
            </a>

            <favorite v-if="name === 'question'" :question="model"></favorite>

            <accept v-else :answer="model"></accept>

        </div>
    </div>
</template>
<script>
import Favorite from './Favorite.vue';
import Accept from './Accept.vue';
export default {
    props:['name','model'],
    data(){
        return{
            //count
        }
    },
    computed:{
        classes(){
            return this.loggedIn? '':'off';
        },
        count(){
            if(this.name=='question'){
                return this.model.votes;
            }else{
                return this.model.votes_count;
            }
        },
        url(){
            return `/${this.name}/${this.model.id}/vote`;
        }
    },
    methods:{
        title(voteType){
            let titles={
                up: `the ${this.name} is useful`,
                down: `the ${this.name} is not userful`,
            }
            return titles[voteType]; 
        },
        voteUp (name) {
            if(name =='question'){
                this.model.votes++;
            }
            this._vote(1);
            
        },
        voteDown (name) {
            this._vote(-1);
            
        },
        _vote (vote) {
            if (! this.loggedIn) {
                this.$toast.warning(`Please login to vote the ${this.name}`, "Warning", {
                    timout: 3000,
                    position: 'bottomLeft'
                });
                return; 
            }
            axios.post(this.url, { vote })
            .then(res => {
                this.$toast.success(res.data.message, "Success", {
                    timeout: 3000,
                    position: 'bottomLeft'
                });
                
            })
        }

    }

}
</script>