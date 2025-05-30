// src/stores/todo.js
import { defineStore } from "pinia";
import axios from "axios";

const API = "http://localhost:3100/tasks";

export const useTodoStore = defineStore("todo", {
  state: () => ({
    todos: [],
  }),

  actions: {
    async fetchTodos() {
      try {
        const res = await axios.get(API);
        this.todos = res.data;
      } catch (err) {
        console.error("Failed to fetch todos:", err);
      }
    },

    async createTodo(taskName) {
      try {
        const taskData = {
          name: taskName,
          description: null,
          completedAt: null,
          userId: 1,
        };

        const res = await axios.post(`${API}/create`, taskData);
        this.todos.push(res.data);
      } catch (err) {
        console.error("Failed to create todo:", err);
        throw err;
      }
    },

    async toggleStatus(id) {
      try {
        const todo = this.todos.find((t) => t.id === id);
        const updatedData = {
          completedAt: todo.completedAt ? null : new Date().toISOString(),
        };

        await axios.put(`${API}/${id}`, updatedData);
        await this.fetchTodos();
      } catch (err) {
        console.error("Failed to toggle todo status:", err);
      }
    },
    async clearAll() {
      try {
        // Only delete completed tasks
        const completed = this.todos.filter((todo) => todo.completedAt);
        await Promise.all(
          completed.map((todo) =>
            axios.delete(`http://localhost:3100/tasks/${todo.id}`)
          )
        );
        await this.fetchTodos();
      } catch (error) {
        console.error("Failed to clear completed todos:", error);
      }
    },
  },

  getters: {
    countTodos() {
      return this.todos.filter((todo) => !todo.completedAt).length;
    },
  },
});
