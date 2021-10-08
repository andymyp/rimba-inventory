import axios from "axios";

export const apiUrl = "http://127.0.0.1:8000";

const api = axios.create({
  baseURL: apiUrl,
  headers: {
    "Content-type": "application/json",
  },
});

export default api;
