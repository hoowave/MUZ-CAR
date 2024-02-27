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
                    <strong>차량 정보를 확인해주세요.</strong>
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
              <p class="mt-2 text-sm text-gray-900">
                    <strong>예약 날짜를 정해주세요.</strong>
                  </p>

              <div class="mt-4">
      <label for="startAt" class="block text-sm font-medium text-gray-700">시작 일시</label>
      <input
        type="datetime-local"
        id="startAt"
        v-model="startAt"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        :min="minStartTime"
        :step="stepMinutes"
      />
    </div>
    
    <div class="mt-4">
      <label for="endAt" class="block text-sm font-medium text-gray-700">종료 일시</label>
      <input
        type="datetime-local"
        id="endAt"
        v-model="endAt"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        :min="minEndTime"
        :step="stepMinutes"
      />
    </div>

              <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" @click="closeModal" class="text-sm font-semibold leading-6 text-gray-900">취소</button>
                <button type="submit" @click="showModal" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">확인</button>
                <ReservationIntro ref="reservationIntroRef" :carId="props.carId" :startAt="startAt" :endAt="endAt"/>
                                        <ResponseModal
                  ref="responseModal"
                  :title="responseTitle"
                  :message="responseMessage" />
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref, computed, nextTick } from 'vue'
import { Dialog, DialogPanel, TransitionRoot, TransitionChild } from '@headlessui/vue'
import ReservationIntro from './ReservationIntro.vue'
import ResponseModal from '../commons/ResponseModal.vue'

const props = defineProps({
  carId: Number
})

const isOpen = ref(false)
const carInfo = ref({})

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

const startAt = ref(getInitialStartTime());
const endAt = ref(getInitialEndTime());

function getInitialStartTime() {
  const now = new Date();
  now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
  return now.toISOString().slice(0, 16);
}

function getInitialEndTime() {
  const startTime = new Date();
  startTime.setMinutes(startTime.getMinutes() - startTime.getTimezoneOffset() + 60);
  return startTime.toISOString().slice(0, 16);
}

const stepMinutes = ref(15);

const minStartTime = computed(() => startAt.value);
const minEndTime = computed(() => {
  const minimumEndTime = new Date(startAt.value);
  minimumEndTime.setMinutes(minimumEndTime.getMinutes() + 60);
  return minimumEndTime.toISOString().slice(0, 16);
});

const reservationIntroRef = ref(null)

const responseModal = ref(null);
  const responseTitle = ref('');
  const responseMessage = ref('');

async function showModal() {
  const response = await fetch('http://localhost:8000/api/reservation/intro', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        carId: props.carId,
        startAt: startAt.value,
        endAt: endAt.value,
      }),
    })
    const data = await response.json()
    if (data.status === 'success') {
      reservationIntroRef.value.openModal();
    } else {
      responseTitle.value = data.status;
      responseMessage.value = data.message;
      responseModal.value.openModal();
    }
}

defineExpose({ openModal, closeModal })
</script>