<answer :answer="{{$answer}}" inline-template>
  <div class="media post">
    @include('shared._vote',[
      'model' => $answer,
    ])
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
                    @can('update',$answer)
                    <a @click.prevent="edit" class="btn btn-outline-success btn-sm mr-1">Edit</a>
                    @endcan
                    @can('delete',$answer)
                    
                    <button @click="destroy" class="btn btn-outline-danger btn-sm">Delete</button>
                    
                    @endcan
                </div>
            </div>
            <div class="col-4"></div>
             <div class="col-4 ">                                   
              <user-info :model="{{$answer}}" label="Answered"></user-info>
            </div>
        </div>
      </div>
     
    </div>
  </div>
</answer>