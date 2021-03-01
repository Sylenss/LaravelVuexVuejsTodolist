<template>
  <div class="max-w-md mx-auto bg-white rounded-xl shadow-xl overflow-hidden md:max-w-2xl">
    <div class="md:flex p-8">
      <div class="grid grid-flow-col grid-cols-7 gap-6">
        <div class="col-span-7 sm:col-span-7">

          <div class="font-bold leading-none tracking-wider text-3xl uppercase text-center pb-3">
            Add Todo
          </div>

          <div>
            <label for="title" class="block text-sm font-bold text-gray-800 mb-2">
              Title
            </label>
            <input type="text"
                   class="mt-1 focus:ring-gray-700 focus:border-gray-700 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                   id="title"
                   placeholder="Title of Task"
                   v-model="title">
          </div>
        </div>

        <div class="col-span-7 sm:col-span-7">
          <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
            Description
          </label>
          <textarea name="description"
                    id="description"
                    cols="30"
                    rows="10"
                    placeholder="What's up doc?"
                    class="mt-1 rounded-md focus:ring-gray-700 focus:border-gray-700 block w-full border-gray-300 shadow-sm sm:text-sm"
                    v-model="description">
        </textarea>
        </div>

        <!--        <div class="col-span-7 sm:col-span-7">-->
        <!--          <label for="completed" class="block text-sm font-bold text-gray-800 mb-2">-->
        <!--            Completed-->
        <!--          </label>-->
        <!--          <input type="text"-->
        <!--                 class="mt-1 focus:ring-gray-700 focus:border-gray-700 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"-->
        <!--                 id="completed"-->
        <!--                 placeholder="Completed">-->
        <!--        </div>-->

        <div class="px-4 py-3 text-right sm:px-6 row-start-4 col-start-6">
          <button @click="addTodos"
                  type="button"
                  class="inline-flex text-base whitespace-nowrap justify-center py-2 px-4 border border-transparent shadow-sm text-sm
                         font-bold rounded-md text-white bg-gray-700 hover:bg-gray-800
                         hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">

            <svg class="animate-spin h-6 w-5 mr-3 text-white"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 v-if="creating">

              <circle class="opacity-25"
                      cx="12"
                      cy="12"
                      r="10"
                      stroke="currentColor"
                      stroke-width="4">
              </circle>
              <path class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
              </path>
            </svg>
            Add Todo
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {
  name     : "AddTodo",
  data     : function () {
    return {
      title       : '',
      description : ''
    };
  },
  computed : {
    creating()
    {
      return this.$store.state.creating;
    },

  },
  methods  : {
    addTodos : function () {
      this.$store.dispatch('addTodos', {title : this.title, description : this.description});
      this.$store.dispatch('clearNewTodo');
      this.title       = '';
      this.description = '';
    },

  }
};
</script>

<style scoped>

</style>