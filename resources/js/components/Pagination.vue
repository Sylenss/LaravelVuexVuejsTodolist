<template>
  <div class="bg-white rounded shadow flex items-center justify-center mt-6 p-4"
       v-if="pagination.total > pagination.per_page">
    <ul class=" flex flex-wrap gap-1">
      <li v-if="pagination.current_page > 1">
        <a class="bg-white block px-4 py-3 text-sm border rounded hover:bg-gray-100"
           href="javascript:void(0)"
           aria-label="Previous"
           v-on:click.prevent="changePage(pagination.current_page - 1)">
          <span aria-hidden="true">«</span>
        </a>
      </li>
      <li v-for="page in pagesNumber">
        <a :class="{'bg-gray-900 text-white hover:bg-gray-800 hover:text-white': page == pagination.current_page}"
           class="bg-white block px-4 py-3 text-sm border rounded hover:bg-gray-100"
           href="javascript:void(0)"
           v-on:click.prevent="changePage(page)">{{ page }}</a>
      </li>
      <li v-if="pagination.current_page < pagination.last_page">
        <a class="bg-white block px-4 py-3 text-sm border rounded hover:bg-gray-100"
           href="javascript:void(0)"
           aria-label="Next"
           v-on:click.prevent="changePage(pagination.current_page + 1)">
          <span aria-hidden="true">»</span>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
/**
 * @TODO: We need to add the first two pages to the start of the page numbers, if we are deeper than 2
 * @TODO: We need to add the last two pages to the end of the page numbers, if we are deeper than 2
 * @TODO: After first two page numbers and before the last two page numbers, add "..." non-clickable "button"
 */
export default {
  name  : "Pagination",
  props : {
    url            : {
      type     : String,
      required : false,
    },
    pagination     : {
      type     : Object,
      required : true
    },
    offset         : {
      type    : Number,
      default : 4
    },
    method         : {
      type    : String,
      default : 'get'
    },
    only           : {
      type    : Array,
      default : function () {
        return [];
      }
    },
    additionalData : {
      type    : Object,
      default : function () {
        return {};
      }
    },
    handler        : {
      default : null,
    }
  },
  mounted()
  {
  },
  data()
  {
    return {};
  },
  computed : {
    pagesNumber()
    {
      if (!this.pagination.to) {
        return [];
      }
      let from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      let to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      let pagesArray = [];
      for (let page = from; page <= to; page++) {
        pagesArray.push(page);
      }
      return pagesArray;
    }
  },
  methods  : {

    changePage(page)
    {
      this.pagination.current_page = page;
      if (this.handler) {
        this.handler(page);
        return;
      }

      this.$emit('paginate');

            this.pagination.url.replace(this.url || this.pagination.path, {
              method        : this.method,
              only          : this.only,
              data          : {...{page : page}, ...this.additionalData},
              preserveState : false,
            });
    },
  }
};
</script>

<style scoped>

</style>
