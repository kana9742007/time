<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav mr-auto">
      <li :class="{active: activeMenu==='list'}"><router-link class="nav-link" :to="{ name: 'list' }">一覧</router-link></li>
      <li :class="{active: activeMenu==='create'}"><router-link class="nav-link" :to="{ name: 'create' }">新規作成</router-link></li>
    </ul>
  </nav>
</template>

<style lang="sass">
.navbar
  position: fixed
  left: 0px
  right: 0px
  height: 100vh
  width: 200px
  background: #f5f5f5
  padding-top: 20px
  ul
    list-style: none
    padding: 0px
    li
      cursor: pointer
      display: inline-block
      width: 100%
      a
        display: block
        width: calc(100% - 50px)
        padding: 10px 0px 10px 50px
        color: #696969
        font-weight: bold
        transition: .3s
        &:hover
          background-color: #ffffff
          color: #DBDBDB
      .router-link-active
        background-color: #ffffff
        color: #DBDBDB
</style>