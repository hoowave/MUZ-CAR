<template>
  <div class="min-h-full">
    <Disclosure as="nav" class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <a href="/">
                <img class="h-8 w-8" src="../../../images/muz-car.jpg"/>
              </a>
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-600 hover:bg-gray-700 hover:text-white', 'rounded-md px-3 py-2 text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Disclosure>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const { url } = usePage();
const currentUrl = computed(() => url.value);

const navigation = computed(() => [
  { name: '차량목록', href: '/', current: currentUrl.value === '/' },
  { name: '차량등록', href: '/create', current: currentUrl.value === '/create' },
  { name: '예약하기', href: '/reservation', current: currentUrl.value === '/reservation' },
  { name: '예약정보', href: '/show', current: currentUrl.value === '/show' },
]);
</script>