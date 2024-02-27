<template>
    <div class="border-b border-gray-900/10 pb-12">
      <div class="my-4">
        <h2 class="text-lg font-semibold">예약 차량 등록</h2>
      </div>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-2 sm:col-start-1">
              <label for="brand" class="block text-sm font-medium leading-6 text-gray-900">제조사</label>
              <div class="mt-2">
                <input type="text" v-model="car.brand" name="brand" id="brand" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
              </div>
            </div>
  
            <div class="sm:col-span-2">
              <label for="model" class="block text-sm font-medium leading-6 text-gray-900">모델</label>
              <div class="mt-2">
                <input type="text" v-model="car.model" name="model" id="model" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
              </div>
            </div>
  
            <div class="sm:col-span-2">
              <label for="type" class="block text-sm font-medium leading-6 text-gray-900">차종</label>
              <div class="mt-2">
                <input type="text" v-model="car.type" name="type" id="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
              </div>
            </div>

            <div class="col-span-full">
              <label for="introduction" class="block text-sm font-medium leading-6 text-gray-900">소개</label>
              <div class="mt-2">
                <textarea id="introduction" v-model="car.introduction" name="introduction" rows="5   " class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
              </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <p v-if="validationError" class="text-red-500">{{ validationError }}</p>
          <button type="button" @click="navigateToHome" class="text-sm font-semibold leading-6 text-gray-900">취소</button>
          <button type="submit" @click="showModal" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">확인</button>
          <CreateModal ref="createModal" :car="car" @close="handleModalClose" />
        </div>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import CreateModal from './CreateModal.vue';

const car = ref({
  brand: '',
  model: '',
  type: '',
  introduction: '',
  year: '',
  fuel: '',
  seats: '',
  gear: '',
})

const createModal = ref(null);
const validationError = ref('');

function showModal() {
  if (!car.value.brand || !car.value.model || !car.value.type || !car.value.introduction) {
    validationError.value = '모든 입력필드를 채워주세요.';
    return;
  }
  validationError.value = '';
  createModal.value.openModal();
}

function navigateToHome(){
  window.location.href = '/';
}
</script>