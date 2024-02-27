<template>
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @close="closeModal">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 transition-opacity md:block" />
        </TransitionChild>
  
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="text-center">
                  <Dialog.Title as="h3" class="text-lg leading-6 font-medium text-gray-900">
                    {{ title }}
                  </Dialog.Title>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">
                      {{ message }}
                    </p>
                  </div>
                </div>
                <div class="mt-5 sm:mt-6">
                  <button type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" @click="closeModal">
                    닫기
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>
  
  <script setup>
  import { ref, defineProps, defineExpose } from 'vue'
  import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot
  } from '@headlessui/vue'
  
  const props = defineProps({
    title: String,
    message: String
  })
  
  const open = ref(false)
  
  function openModal() {
    open.value = true
  }
  
  function closeModal() {
  open.value = false
  }
  
  defineExpose({ openModal, closeModal })
  </script>  