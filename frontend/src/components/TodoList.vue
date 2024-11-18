<template>
  <div class="flex items-center justify-center h-screen">
    <div
      class="max-w-md flex-1 mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg"
    >
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Todo List</h1>

      <!-- Loading state -->
      <div v-if="loading" class="text-center">
        <p class="text-gray-500">Loading...</p>
      </div>

      <!-- Error state -->
      <div v-if="error" class="bg-red-100 p-4 rounded mb-4">
        <p class="text-red-700">{{ error }}</p>
      </div>

      <!-- Form thêm todo -->
      <div class="flex mb-6">
        <input
          v-model="newTodo"
          @keyup.enter="addTodo"
          type="text"
          class="flex-1 p-2 border border-gray-300 rounded-l focus:outline-none focus:border-blue-500"
          placeholder="Add new todo..."
        />
        <button
          @click="addTodo"
          class="px-4 py-2 bg-blue-500 text-white rounded-r hover:bg-blue-600 focus:outline-none"
        >
          Add
        </button>
      </div>

      <!-- Danh sách todo -->
      <ul class="space-y-2">
        <li
          v-for="todo in todos"
          :key="todo.id"
          class="flex items-center justify-between p-3 bg-gray-50 rounded"
        >
          <div class="flex items-center">
            <input
              type="checkbox"
              :checked="todo.completed"
              @change="toggleTodo(todo)"
              class="mr-3"
            />
            <span :class="{ 'line-through': todo.completed }">
              {{ todo.title }}
            </span>
          </div>
          <button
            @click="deleteTodo(todo.id)"
            class="text-red-500 hover:text-red-700"
          >
            Delete
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../api/axios";

const todos = ref([]);
const newTodo = ref("");
const loading = ref(false);
const error = ref(null);

// Lấy danh sách todos
const fetchTodos = async () => {
  loading.value = true;
  error.value = null;
  try {
    const response = await api.get("/todos");
    if (response.data && Array.isArray(response.data)) {
      todos.value = response.data;
    } else {
      todos.value = [];
    }
  } catch (err) {
    error.value = "Failed to load todos";
  } finally {
    loading.value = false;
  }
};

// Thêm todo mới
const addTodo = async () => {
  if (!newTodo.value.trim()) return;

  try {
    const response = await api.post("/todos", {
      title: newTodo.value,
      completed: false,
    });
    todos.value.push(response.data);
    newTodo.value = "";
  } catch (error) {
    console.error("Error adding todo:", error);
  }
};

// Toggle trạng thái todo
const toggleTodo = async (todo) => {
  try {
    const response = await api.put(`/todos/${todo.id}`, {
      ...todo,
      completed: !todo.completed,
    });
    const index = todos.value.findIndex((t) => t.id === todo.id);
    todos.value[index] = response.data;
  } catch (error) {
    console.error("Error updating todo:", error);
  }
};

// Xóa todo
const deleteTodo = async (id) => {
  try {
    await api.delete(`/todos/${id}`);
    todos.value = todos.value.filter((todo) => todo.id !== id);
  } catch (error) {
    console.error("Error deleting todo:", error);
  }
};

onMounted(fetchTodos);
</script>
