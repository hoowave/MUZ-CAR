<template>
    <div class="flex flex-col">
      <div class="my-4">
        <h2 class="text-lg font-semibold">예약 정보 목록</h2>
      </div>
      <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full">
              <thead class="bg-white border-b">
                <tr>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">번호</th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">모델</th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">시작시간</th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">종료시간</th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">예약 등록일</th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">기타</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(prop, index) in props" :key="index" :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-white'">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ index + 1 }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ prop.carName }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ prop.startAt }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ prop.endAt }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ prop.created_at }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded" @click="showPage(prop.id)">예약정보</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </template>

<script setup>
import { ref, onMounted } from 'vue'

const props = ref([])

onMounted(async () => {
  const response = await fetch('http://localhost:8000/api/show', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
  const data = await response.json()
  props.value = data.data
})
</script>

<script>
import { Inertia } from '@inertiajs/inertia'

export default {
  methods: {
    showPage(reservationId) {
      Inertia.visit(`/show/${reservationId}`);
    }
  }
}
</script>