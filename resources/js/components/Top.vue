<template lang="">
  <div class="top_container">
    <h1>TIME</h1>
    <p>公開記事はありません</p>
  </div>
</template>

<script>
export default {
  data() {
      return {
        items: [],
        timeflag: false,
        updated: false,
        item: null,
      }
  },
  mounted() {
      this.getItems();
  },
  methods: {
    getItems() {
      axios.get('/api/topics/')
      .then( (res) => {
        this.items = res.data.data;
      });
    },
  },
  created(){
    console.log(this.items);
  },
}
</script>

<style lang="sass">
.top_container
  text-align: center
  h1
    margin-top: 10rem
    font-size: 15rem
    color: #DBDBDB
  p
    color: #696969
</style>
