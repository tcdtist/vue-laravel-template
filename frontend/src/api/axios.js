import axios from "axios";

const api = axios.create({
  baseURL: "http://127.0.0.1:8000/api",
  headers: {
    "Content-Type": "application/json",
  },
});

api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 422) {
      // Handle validation errors
      console.error("Validation error:", error.response.data.errors);
    } else if (error.response?.status === 429) {
      // Handle rate limiting
      console.error("Too many requests");
    } else {
      // Handle other errors
      console.error("An error occurred:", error.message);
    }
    return Promise.reject(error);
  }
);

export default api;
