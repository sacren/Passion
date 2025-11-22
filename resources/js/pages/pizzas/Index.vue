<script setup lang="ts">
import { ref, onMounted } from 'vue'

interface Pizza {
  id: number
  name: string
  description: string
  price: number
}

const pizzas = ref<Pizza[]>([])

onMounted(async () => {
  try {
    // Fetch pizzas from your API endpoint
    const response = await fetch('/api/pizzas')
    if (response.ok) {
      pizzas.value = await response.json()
    } else {
      // Fallback with sample data if API call fails
      pizzas.value = [
        { id: 1, name: 'Margherita', description: 'Classic pizza with tomato and mozzarella', price: 12.99 },
        { id: 2, name: 'Pepperoni', description: 'Pepperoni with extra cheese', price: 14.99 },
        { id: 3, name: 'Vegetarian', description: 'Fresh vegetables and cheese', price: 13.99 },
      ]
    }
  } catch (error) {
    console.error('Error fetching pizzas:', error)
    // Fallback with sample data on error
    pizzas.value = [
      { id: 1, name: 'Margherita', description: 'Classic pizza with tomato and mozzarella', price: 12.99 },
      { id: 2, name: 'Pepperoni', description: 'Pepperoni with extra cheese', price: 14.99 },
      { id: 3, name: 'Vegetarian', description: 'Fresh vegetables and cheese', price: 13.99 },
    ]
  }
})
</script>

<template>
  <div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm rounded-lg">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Pizzas</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your pizza menu</p>
          </div>
          <div class="flex items-center space-x-3">
            <button
              type="button"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Add Pizza
            </button>
          </div>
        </div>

        <!-- Pizza List -->
        <div class="p-6">
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div
              v-for="pizza in pizzas"
              :key="pizza.id"
              class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200"
            >
              <div class="p-6">
                <div class="flex items-start">
                  <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-medium text-gray-900">{{ pizza.name }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ pizza.description }}</p>
                    <div class="mt-4 flex items-center justify-between">
                      <span class="text-lg font-semibold text-indigo-600">${{ pizza.price }}</span>
                      <div class="flex space-x-2">
                        <button
                          type="button"
                          class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                          Edit
                        </button>
                        <button
                          type="button"
                          class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div
            v-if="pizzas.length === 0"
            class="text-center py-12"
          >
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No pizzas</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new pizza.</p>
            <div class="mt-6">
              <button
                type="button"
                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add your first pizza
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
