<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><router-link class="nav-link active" :to="{ name: 'list' }">一覧</router-link></li>
      <li class="nav-item"><router-link class="nav-link active" :to="{ name: 'create' }">新規作成</router-link></li>
    </ul>
  </nav>
</template>

<style lang="sass">
.navbar
  position: fixed
  left: 0px
  right: 0px
  height: 100vh
  width: 100px
  background: #f5f5f5
  padding-top: 20px
  padding-left: 20px
  ul
    list-style: none
    padding: 0px
    li
      padding: 10px 10px
      cursor: pointer
      a
        color: #696969
        font-weight: bold
</style>