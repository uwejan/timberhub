<template>
<b-container >
<!--  <b-navbar toggleable="sm" type="dark" variant="info">-->
<!--    <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>-->

<!--    <b-navbar-brand class="h-100">TimberHub</b-navbar-brand>-->

<!--    <b-collapse id="nav-text-collapse" is-nav>-->
<!--      <b-navbar-nav class="ml-auto">-->
<!--        <b-nav-item class="text-white">Navbar text</b-nav-item>-->
<!--      </b-navbar-nav>-->
<!--    </b-collapse>-->
<!--  </b-navbar>-->

<toast-component></toast-component>
  <div class="mt-2">
  <nuxt/>
  </div>
</b-container>
</template>

<script>
export default {
  name: "MainLayout"
}
</script>

<style >
/*html,*/
/*body {*/
/*  height: 100%;*/
/*}*/

/*.container {*/
/*  height: 100%;*/
/*  display: flex;*/
/*  justify-content: center;*/
/*  align-items: center;*/
/*}*/
</style>
