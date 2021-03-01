import axios from 'axios';
import Vue   from 'vue';


export const state = {
    strict : true,
    //The object that holds our app's data
    todos      : {},
    creating   : false,
    loading    : false,
    pagination : {
        page : Number
    },
    handler    : {
        default : null,
    }
};

export const getters = {
    getTodos : state => state.todos,
};

export const mutations = {
    SET_LOADING    : (state, flag) => {
        state.loading = flag;
    },
    SET_PAGINATION : (state, pagination) => {
        state.pagination = pagination;
    },
    SET_PAGE       : (state, page) => {
        state.pagination.page = page;
    },
    SET_CREATING   : (state, flag) => {
        state.creating = flag;
    },
    SET_TODOS      : (state, todos) => {
        state.todos = todos;
    },
    SET_HANDLER    : (state, handler) => {
        state.handler = handler;
    },
    ADD_TODOS      : (state, payload) => {
        state.todos.data.push(payload);
    },
    DELETE_TODO    : (state, payload) => {
        const index = state.todos.findIndex(todo => todo.id === payload);
        state.todos.splice(index, 1);
    },
    CLEAR_NEW_TODO : (state) => {
        state.title       = '';
        state.description = '';
    },
    
};

export const actions = {
    
    addTodos     : ({commit}, {title, description}) => {
        commit('SET_CREATING', true);
        
        const newTask = {
            title       : title,
            description : description,
            completed   : false
        };
        
        axios.post('/api/tasks', newTask)
            .then(() => {
                commit('ADD_TODOS', newTask);
                commit('SET_CREATING', false);
            });
    },
    changePage   : ({commit}, page) => {
        axios.get('/api/tasks?page=' + page)
            .then(response => {
                commit('SET_PAGINATION', response.data.meta);
            });
    },
    loadTodos    : ({commit}) => {
        commit('SET_LOADING', true);
        
        axios.get('/api/tasks')
            .then(response => {
                commit('SET_TODOS', response.data);
                commit('SET_LOADING', false);
            });
    },
    clearNewTodo : ({commit}) => {
        commit('CLEAR_NEW_TODO');
    },
    
    deleteTodos : ({commit}, todo) => {
        axios.delete(`/api/tasks/${todo.id}`)
            .then(() => {
                commit('DELETE_TODO', todo);
            });
    }
    
};
