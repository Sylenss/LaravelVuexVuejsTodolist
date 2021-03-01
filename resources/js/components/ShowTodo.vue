<template>


  <div v-if="!loading" class="grid grid-cols-3 gap-4 pl-5 mt-20">
    <div class="grid max-w-md bg-white rounded-xl shadow-xl overflow-hidden md:max-w-2xl "
         v-for="todo in todos.data"
         :key="todo.id"
         :todo="todo">
      <div class="md:flex">
        <div class="p-8">
          <div class="uppercase tracking-wide text-sm text-blue-600 font-semi" :title-="todo.title">
            {{ todo.title }}
          </div>
          <p class="mt-2 text-gray-600" :description="todo.description">{{ todo.description }}</p>
          <p class="mt-2 text-gray-600" :completed="todo.completed">{{ todo.completed }}</p>
        </div>
      </div>

    </div>

    <pagination :pagination="todos.meta"></pagination>

  </div>

</template>

<script>


import Pagination from './Pagination';


export default {
  name       : "ShowTodo",
  components : {Pagination},
  created()
  {
    this.$store.dispatch('loadTodos');
  },
  computed : {
    loading()
    {
      return this.$store.state.loading;
    },
    todos()
    {
      return this.$store.getters.getTodos;
      //Some how the pagination needs to be linked to the todos array
    }

  },
};
</script>

<style scoped>

</style>