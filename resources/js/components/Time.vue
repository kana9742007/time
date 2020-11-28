<template>
  <div>
    <div id="target" class="card_wrapp" v-if="item">
      <div id="output" class="card_body">
        <h1 class="card_title">{{item.title}}</h1>
        <div class="card_text">{{item.content}}</div>
        <div class="card_time">{{item.show_time}}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
          item: null,
        }
    },
    created() {
    },
    mounted() {
      this.getItem();
    },
    methods: {
      getItem() {
        axios.get('/api/topics/' + this.$route.params.id)
        .then( ( res ) => {
            this.item = res.data.data;
            this.countScroll();
        })
        .catch(error => {
          console.info(error)
        })
      },
      countScroll(){
        const target = document.getElementById("target");
        console.log(target);
        var x = target.scrollLeft;
        document.getElementById("output").innerHTML = x;
      }
    },
}
</script>

<style lang="sass">
#app
  margin: 0
  overflow: hidden
.card_wrapp
  width: 80%
  overflow-x: scroll
  max-width: 900px
  margin: 100px auto
  .card_body
    position: relative
    display: inline-block
    .card_title
      color: #696969
      font-size: 20px
      position: absolute
      right: 0px
      font-weight: bold
      letter-spacing: 1em
    .card_text
      padding-top: 60px
      writing-mode: vertical-rl
      text-orientation: upright
      white-space: pre-wrap
      line-height: 2
      color: #696969
      font-size: 16px
      font-weight: 300
      letter-spacing: .2em
    .card_time
      writing-mode: vertical-rl
      color: #696969
</style>
