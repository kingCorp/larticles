<template>
  <div>
    <!-- As a heading -->
    <nav class="navbar navbar-dark bg-info mb-2">
      <a class="navbar-brand" href="#">Articles</a>
    </nav>
    <hr>

    <div class="container">
      <router-link to="/">Home</router-link> 
      <router-link to="/login">Login</router-link>
      <hr>
      <router-view></router-view>
    </div>
  </div>
</template>
