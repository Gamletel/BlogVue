import axiosInstance from "@/axios/axios";
import type {User} from "@/types/User";

export default function useUsers() {
  const index = async () => {
    try {
      const response = await axiosInstance.get('/api/users');

      return response.data;
    } catch (e) {
      console.error(e);
    }
  }

  const show = async (id: number) => {
    try {
      const response = await axiosInstance.get(`/api/users/${id}`);
      return response.data;
    } catch (e) {
      console.error(e);
      return null;
    }
  }

  const update = async (data: FormData) => {
    try {
      const response = await axiosInstance.post(`/api/users/${data.get("id")}`, data, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });      console.log(response.data);
      return response.data;
    } catch (e) {
      console.error(e);
    }
  }

  return {
    index,
    show,
    update,
  }
}
