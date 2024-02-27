<template>
  <Layout>
    <template v-slot:title>예약정보</template>
    <template v-slot:content>
      <Form />
    </template>
  </Layout>
</template>

<script>
import Layout from '../components/commons/Layout.vue'
import Form from '../components/contents/ShowForm.vue'

export default {
  components: {
    Layout,
    Form
  }
}
</script>