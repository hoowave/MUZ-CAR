<template>
    <TransitionRoot as="template" :show="isOpen">
      <Dialog as="div" class="relative z-10" @close="closeModal">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        </TransitionChild>
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-6 py-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <Dialog.Title as="h3" class="text-lg leading-6 font-medium text-gray-900">차량 상세 정보</Dialog.Title>
                <div class="mt-3">
                  <p class="mt-2 text-sm text-gray-900">
                      <strong>차량 정보</strong>
                    </p>
                  <ul class="mt-3 list-disc list-inside text-sm text-gray-500">
                    <li><strong>제조사:</strong> {{ carInfo.brand }}</li>
                    <li><strong>모델:</strong> {{ carInfo.model }}</li>
                    <li><strong>외형:</strong> {{ carInfo.type }}</li>
                    <li v-if="carInfo.year"><span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ carInfo.year }}연식</span></li>
                    <li v-if="carInfo.fuel"><span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ carInfo.fuel }}</span></li>
                    <li v-if="carInfo.seats"><span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">{{ carInfo.seats }}인승</span></li>
                    <li v-if="carInfo.gear"><span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">{{ carInfo.gear }}기어</span></li>
                    <li><strong>소개</strong><br><span v-html="formattedIntroduction"></span></li>
                </ul>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                  <button type="button" @click="closeModal" class="text-sm font-semibold leading-6 text-gray-900">취소</button>
                  <button type="submit" @click="showModal(carInfo.id)" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">바로 예약하기</button>
                  <ReservationModal :carId="selectedCarId" ref="reservationModal"/>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>

<script setup>
import { ref, nextTick, computed } from 'vue'
import { Dialog, DialogPanel, TransitionRoot, TransitionChild } from '@headlessui/vue'
import ReservationModal from './ReservationModal.vue'

const props = defineProps({
  carId: Number
})

const isOpen = ref(false)
const carInfo = ref({})
const selectedCarId = ref(null)
const reservationModal = ref(null)

function showModal(carId) {
  selectedCarId.value = carId
  reservationModal.value.openModal()
}

async function openModal() {
  isOpen.value = true
  await nextTick()
  fetchCarInfo()
}

function closeModal() {
    isOpen.value = false;
}

async function fetchCarInfo() {
  const response = await fetch('http://localhost:8000/api/info', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id: props.carId })
  })
  const data = await response.json()
  if (data.status === 'success') {
    carInfo.value = data.data
  }
}

const formattedIntroduction = computed(() => {
  if (carInfo.value.introduction) {
    return carInfo.value.introduction.replace(/\n/g, '<br>');
  }
  return '';
});

defineExpose({ openModal, closeModal })
</script>