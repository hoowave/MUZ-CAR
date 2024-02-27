<template>
    <TransitionRoot as="template" :show="isOpen">
      <Dialog as="div" class="relative z-10" @close="handleClose">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        </TransitionChild>
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-6 py-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <Dialog.Title as="h3" class="text-lg leading-6 font-medium text-gray-900">차량 상세 정보 - {{ reservationData.carName }}</Dialog.Title>
                <div class="mt-2">
                    <p class="mt-2 text-sm text-gray-900">
                    <strong>예약 정보를 확인해주세요.</strong>
                  </p>
                  <ul class="mt-3 list-disc list-inside text-sm text-gray-500">
                  <li><strong>차량:</strong> {{ reservationData.carName }}</li>
                  <li><strong>예약 시작 시간:</strong> {{ reservationData.startAt }}</li>
                  <li><strong>예약 종료 시간:</strong> {{ reservationData.endAt }}</li>
                  <li><strong>예약 시간:</strong> {{ reservationData.minutes }} 분</li>
                  <li><strong>예상 비용:</strong> {{ reservationData.cost }} 원</li>
                  <p class="text-red-500" v-if="reservationData.reservation_yn === 'N'">해당 시간대에 다른 예약건이 포함되어 있습니다. 다른 시간대를 이용해주세요.</p>
                </ul>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                  <button type="button" @click="closeModal" class="text-sm font-semibold leading-6 text-gray-900">취소</button>
                  <div v-if="reservationData.reservation_yn === 'Y'">
                    <button type="submit" @click="reservation" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">예약하기</button>
                  </div>
                  <div v-else>
                    <button type="button" disabled class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm">예약불가</button>
                  </div>
                    <div @click.stop>
                        <ResponseModal
                  ref="responseModal"
                  :title="responseTitle"
                  :message="responseMessage" />
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>
  
  <script setup>
  import { ref, defineProps } from 'vue'
  import { Dialog, DialogPanel, TransitionRoot, TransitionChild } from '@headlessui/vue'
  import ResponseModal from '../commons/ResponseModal.vue'
  
  const props = defineProps({
    carId: Number,
    startAt: String,
    endAt: String
  })
  
  const isOpen = ref(false)
  const reservationData = ref({})
  
  async function openModal() {
    const response = await fetch('http://localhost:8000/api/reservation/intro', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        carId: props.carId,
        startAt: props.startAt,
        endAt: props.endAt,
      }),
    })
    const data = await response.json()
    if (data.status === 'success') {
      reservationData.value = data.data
    } else {
      console.error('Failed to fetch reservation info:', data.message)
    }
    isOpen.value = true
  }
  
  function closeModal() {
    isOpen.value = false
  }
  
  function handleClose(event) {
    closeModal()
  }

  const responseModal = ref(null);
  const responseTitle = ref('');
  const responseMessage = ref('');

  async function reservation() {
    const reservationRequest = {
    carId: props.carId,
    startAt: props.startAt,
    endAt: props.endAt,
  };

  const response = await fetch('http://localhost:8000/api/reservation', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(reservationRequest)
  });

  const data = await response.json();

    responseTitle.value = data.status;
    responseMessage.value = data.message;
    responseModal.value.openModal();
  }

  defineExpose({ openModal, closeModal })
  </script>
  