<template>
  <div>
    <div class="card" v-if="item">
      <div class="card-body">
        <div>
          <h1 class="card-title">{{item.title}}</h1>
          <div class="card-text">{{item.content}}</div>
          <div class="card-text">{{item.show_time}}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            item: null,
            timeflag: false,
            updated: false,
        }
    },
    mounted() {
        this.getItem();
    },
    methods: {
      getItem() {
          axios.get('/api/topics/' + this.$route.params.id)
          .then( ( res ) => {
              this.item = res.data.data;
          })
          .catch(error => {
            console.info(error)
          })
      },
    }
}
</script>

<style lang="sass">
.card-text
  white-space: pre-wrap
</style>
