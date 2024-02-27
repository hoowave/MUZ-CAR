<template>
  <Layout>
    <template v-slot:title>차량등록</template>
    <template v-slot:content>
      <Form />
    </template>
  </Layout>
</template>

<script>
import Layout from '../components/commons/Layout.vue'
import Form from '../components/contents/CreateForm.vue'

export default {
  components: {
    Layout,
    Form
  }
}
</script>