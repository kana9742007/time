<template lang="">
  <div class="container">
    <table class="list-group">
      <router-link v-for="( item, key, index ) in items" :key="key" :to="{ name: 'detail', params: { id: item.id } }" class="list-group-item">
        <th>{{item.title}}</th>
        <th><button class="btn" @click.stop.prevent="onDelete(item.id, key)">削除</button></th>
      </router-link>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: null
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
    onDelete(id, key) {
      axios.delete('/api/topics/' + id)
      .then( () => {
        this.$delete(this.items, key);
      })
    }
  }
}
</script>
<style lang="sass">
.list-group
  width: 100%
.list-group-item
  width: 80%
  padding: 10px 0px
  display: flex
  border-bottom: 1px solid #f5f5f5
  th
    width: 200px
    text-align: left
  .btn
    border: none
    background: inherit
</style>

