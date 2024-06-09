import axios from "axios";

class ApiService {

    constructor() {
        this.api = axios.create({
            baseURL: "http://localhost:8000/api",
            timeout: 10000,
            headers: {
                "Content-Type": "application/json",
            },
        });
    }
    
    async getAll(endpoint, params) {

        if (!params) {
            params = {};
        }

        return await this.api.get(endpoint, { params });
    }

    async getById(endpoint, id) {
        return await this.api.get(`${endpoint}/${id}`);
    }

    async post(endpoint, data) {
        return await this.api.post(endpoint, data);
    }

    async put(endpoint, id, data) {
        return await this.api.put(`${endpoint}/${id}`, data);
    }

    async delete(endpoint, id) {
        return await this.api.delete(`${endpoint}/${id}`);
    }

}

export default new ApiService();