<template>
  <div class="flex flex-col">
    <div class="my-4">
      <h2 class="text-lg font-semibold">예약 가능 차량</h2>
    </div>
    <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <table class="min-w-full">
            <thead class="bg-white border-b">
              <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">번호</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">제조사</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">모델</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">외형</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">차량 등록일</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">기타</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(prop, index) in props" :key="index" :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-white'">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ prop.brand }}</td>
                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ prop.model }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ prop.type }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ prop.created_at }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded" @click="showModal(prop.id)">예약하기</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <ReservationModal :carId="selectedCarId" ref="reservationModal"/>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import ReservationModal from './ReservationModal.vue'

const props = ref([])
const selectedCarId = ref(null)
const reservationModal = ref(null)

function showModal(carId) {
  selectedCarId.value = carId
  reservationModal.value.openModal()
}

onMounted(async () => {
  const response = await fetch('http://localhost:8000/api/list', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  })
  const data = await response.json()
  props.value = data.data
})
</script>
