<template>
  <div class="min-h-full">
    <Navbar>
      <template v-slot:title>타이틀내용</template>
    </Navbar>
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900"><slot name="title">Title</slot></h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <slot name="content">Content</slot>
      </div>
    </main>
  </div>
</template>

<script>
import Navbar from './Navbar.vue';

export default {
  components: {
    Navbar
  },
};
</script>