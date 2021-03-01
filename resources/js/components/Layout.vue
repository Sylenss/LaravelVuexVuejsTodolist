<template>
    <div>
        <div class="pt-10">
            <add-todo></add-todo>
        </div>


        <div class="container mx-auto">
            <show-todo></show-todo>
        </div>


    </div>


</template>

<script>

import AddTodo  from './AddTodo';
import ShowTodo from './ShowTodo';


export default {
    name       : "Layout",
    components : {
        AddTodo,
        ShowTodo,
    },
};

</script>

<style scoped>

</style>
