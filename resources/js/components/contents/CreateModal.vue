<template>
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @close="closeModal">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 transition-opacity md:block" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
              <div>
                <div class="mt-3 sm:mt-5">
                  <Dialog.Title as="h3" class="text-lg leading-6 font-medium text-gray-900">
                    차량 정보 확인
                  </Dialog.Title>
                  <div class="mt-2">
                    <p class="text-sm text-gray-900">
                      <strong>차량 정보 확인</strong>
                    </p>
                    <ul class="mt-3 list-disc list-inside text-sm text-gray-500">
                  <li><strong>제조사:</strong> {{ car.brand }}</li>
                  <li><strong>모델:</strong> {{ car.model }}</li>
                  <li><strong>외형:</strong> {{ car.type }}</li>
                  <li><strong>소개</strong><br><span v-html="formattedIntroduction"></span></li>
                  </ul>
                  </div>
                  <p class="mt-2 text-sm text-gray-900">
                    <strong>상세정보도 더 입력하면 좋아요.</strong>
                  </p>
                  <div class="mt-4">
        <label for="year" class="block text-sm font-medium text-gray-700">연식</label>
        <select id="year" v-model="car.year" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option value="">선택 안함</option>
          <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
        </select>
      </div>
      <div class="mt-4">
        <label for="fuel" class="block text-sm font-medium text-gray-700">연료 유형</label>
        <select id="fuel" v-model="car.fuel" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option value="">선택 안함</option>
          <option value="휘발유">휘발유</option>
          <option value="경유">경유</option>
          <option value="LPG">LPG</option>
        </select>
      </div>
      <div class="mt-4">
        <label for="seats" class="block text-sm font-medium text-gray-700">인승</label>
        <select id="seats" v-model="car.seats" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option value="">선택 안함</option>
          <option v-for="seat in 8" :key="seat" :value="seat">{{ seat }}</option>
        </select>
      </div>
      <div class="mt-4">
        <label for="gear" class="block text-sm font-medium text-gray-700">기어</label>
        <select id="gear" v-model="car.gear" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option value="">선택 안함</option>
          <option value="수동">수동</option>
          <option value="자동">자동</option>
        </select>
      </div>
                </div>
              </div>
              <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" @click="closeModal" class="text-sm font-semibold leading-6 text-gray-900">취소</button>
                <button type="submit" @click="create" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">확인</button>
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
  import { ref, defineExpose, defineProps, onMounted, computed } from 'vue'
  import ResponseModal from '../commons/ResponseModal.vue'
  import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
  } from '@headlessui/vue'
  
  const props = defineProps({
    car: Object
  })

  const years = ref([])
  const open = ref(false)
  const responseModal = ref(null);
  const responseTitle = ref('');
  const responseMessage = ref('');

  onMounted(() => {
  for (let year = 2010; year <= 2024; year++) {
    years.value.push(year.toString())
  }
  })
  
  function openModal() {
    open.value = true;
  }
  
  function closeModal() {
    open.value = false;
  }

  async function create() {
    const response = await fetch('http://localhost:8000/api/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(props.car)
    });
    const data = await response.json();

    responseTitle.value = data.status;
    responseMessage.value = data.message;
    responseModal.value.openModal();
  }

  const formattedIntroduction = computed(() => {
    if (props.car.introduction) {
      return props.car.introduction.replace(/\n/g, '<br>');
    }
    return '';
  });

  defineExpose({ openModal, closeModal })

  </script>