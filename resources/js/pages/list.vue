<template>
  <Layout>
    <template v-slot:title>차량목록</template>
    <template v-slot:content>
      <Form />
    </template>
  </Layout>
</template>

<script>
import Layout from '../components/commons/Layout.vue'
import Form from '../components/contents/ListForm.vue'

export default {
  components: {
    Layout,
    Form
  }
}
</script>