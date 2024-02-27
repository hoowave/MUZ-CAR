<template>
  <Layout>
    <template v-slot:title>예약하기</template>
    <template v-slot:content>
      <Form />
    </template>
  </Layout>
</template>

<script>
import Layout from '../components/commons/Layout.vue'
import Form from '../components/contents/ReservationForm.vue'

export default {
  components: {
    Layout,
    Form
  }
}
</script>