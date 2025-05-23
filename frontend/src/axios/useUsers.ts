import axiosInstance from "@/axios/axios";

export default function useUsers() {
  const indexUsers = async () => {
    try {
      const response = await axiosInstance.get('/api/users');

      return response.data;
    } catch (e) {
      console.error(e);
      return [];
    }
  }

  const showUser = async (id: number | undefined) => {
    try {
      const response = await axiosInstance.get(`/api/users/${id}`);
      return response.data;
    } catch (e) {
      console.error(e);
      return null;
    }
  }

  const updateUser = async (data: FormData) => {
    try {
      const response = await axiosInstance.post(`/api/users/${data.get("id")}`, data, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      console.log(response);

      return response.data;
    } catch (e) {
      console.log("Ошибки", e.response.data);

      return e.response.data;
    }
  }

  return {
    indexUsers,
    showUser,
    updateUser,
  }
}
