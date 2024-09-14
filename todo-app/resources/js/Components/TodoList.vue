<template>
    <div class="todo-container">
        <h1 class="todo-header">To-Do List</h1>

        
        <div class="todo-form">
            <input
                v-model="newTodo"
                @keyup.enter="addTodo"
                placeholder="Add a new todo"
                class="todo-input"
            />
            <button @click="addTodo" class="todo-submit-btn">Add</button>
        </div>

       
        <ul class="todo-list">
            <li v-for="todo in todos" :key="todo.id" class="todo-item">
                <input
                    type="checkbox"
                    v-model="todo.completed"
                    @change="updateTodo(todo)"
                    class="todo-checkbox"
                />
                <span :class="{ completed: todo.completed }">{{ todo.title }}</span>
                <button @click="editTodo(todo)" class="todo-btn edit-btn">Edit</button>
                <button @click="deleteTodo(todo.id)" class="todo-btn delete-btn">Delete</button>
            </li>
        </ul>

        
        <div v-if="editingTodo" class="edit-form">
            <input
                v-model="editingTodo.title"
                placeholder="Edit todo"
                class="todo-input"
            />
            <button @click="updateTodo(editingTodo)" class="todo-btn save-btn">Save</button>
            <button @click="cancelEdit" class="todo-btn cancel-btn">Cancel</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import './TodoList.css';

export default {
    data() {
        return {
            todos: [],
            newTodo: '',
            editingTodo: null
        };
    },
    mounted() {
        this.fetchTodos();
    },
    methods: {
        async fetchTodos() {
            try {
                const response = await axios.get('/todos');
                this.todos = response.data;
            } catch (error) {
                console.error("Error fetching todos:", error);
            }
        },
        async addTodo() {
            if (this.newTodo.trim() === '') return;
            try {
                const response = await axios.post('/todos', { title: this.newTodo });
                this.todos.push(response.data);
                this.newTodo = '';
            } catch (error) {
                console.error("Error adding todo:", error);
            }
        },
        async updateTodo(todo) {
            try {
                const response = await axios.put(`/todos/${todo.id}`, todo);
                const index = this.todos.findIndex(t => t.id === todo.id);
                if (index !== -1) {
                    this.todos[index] = response.data;
                }
                if (this.editingTodo && this.editingTodo.id === todo.id) {
                    this.cancelEdit();
                }
            } catch (error) {
                console.error("Error updating todo:", error);
            }
        },
        async deleteTodo(id) {
            try {
                await axios.delete(`/todos/${id}`);
                this.todos = this.todos.filter(todo => todo.id !== id);
            } catch (error) {
                console.error("Error deleting todo:", error);
            }
        },
        editTodo(todo) {
            this.editingTodo = { ...todo };
        },
        cancelEdit() {
            this.editingTodo = null;
        }
    }
};
</script>
